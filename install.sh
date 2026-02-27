#!/bin/bash

# ==============================================================================
# VortexDash Automated Installation Script (Production Ready)
# Supports: Ubuntu 22.04 / 24.04
# ==============================================================================

# Colors for terminal output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' 

echo -e "${BLUE}======================================================================${NC}"
echo -e "${GREEN}                   VORTEXDASH AUTO-INSTALLER                      ${NC}"
echo -e "${BLUE}======================================================================${NC}"

# 1. Root Check
if [ "$EUID" -ne 0 ]; then
  echo -e "${RED}ERROR: Please run this script as root (sudo bash install.sh)${NC}"
  exit 1
fi

# 2. Collect Information
read -p "Enter the Domain/IP for this dash (e.g., dash.example.com): " FQDN
read -p "Enter Pterodactyl Panel URL (e.g., https://panel.example.com): " PTERO_URL
read -p "Enter Pterodactyl Application API Key (ptla_...): " PTERO_APP_KEY
read -p "Enter Pterodactyl Admin Client API Key (ptlc_...): " PTERO_CLIENT_KEY
read -p "Enter a secure password for the database: " DB_PASSWORD

echo -e "\n${YELLOW}[1/6] Updating System & Installing Dependencies...${NC}"
apt update -y && apt upgrade -y
apt install -y software-properties-common curl apt-transport-https ca-certificates gnupg git unzip zip wget nano nginx mariadb-server

echo -e "\n${YELLOW}[2/6] Installing PHP 8.2...${NC}"
add-apt-repository -y ppa:ondrej/php
apt update -y
apt install -y php8.2 php8.2-{common,cli,gd,mysql,mbstring,bcmath,xml,fpm,curl,zip}

echo -e "\n${YELLOW}[3/6] Installing Composer & Node.js...${NC}"
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
apt install -y nodejs

echo -e "\n${YELLOW}[4/6] Configuring MariaDB Database...${NC}"
mysql -u root -e "CREATE DATABASE IF NOT EXISTS vortexdash;"
mysql -u root -e "CREATE USER IF NOT EXISTS 'vortex'@'127.0.0.1' IDENTIFIED BY '${DB_PASSWORD}';"
mysql -u root -e "GRANT ALL PRIVILEGES ON vortexdash.* TO 'vortex'@'127.0.0.1' WITH GRANT OPTION;"
mysql -u root -e "FLUSH PRIVILEGES;"

echo -e "\n${YELLOW}[5/6] Deploying VortexDash Source Code...${NC}"
mkdir -p /var/www/vortexdash
cd /var/www/vortexdash

# Clone the repo (Fixed syntax)
git clone https://github.com/sayamcoder/vortexdh .

# Setup Environment
cp .env.example .env 2>/dev/null || touch .env
cat <<EOF > .env
APP_NAME=VortexDash
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=http://${FQDN}

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vortexdash
DB_USERNAME=vortex
DB_PASSWORD=${DB_PASSWORD}

PTERODACTYL_URL=${PTERO_URL}
PTERODACTYL_API_KEY=${PTERO_APP_KEY}
PTERODACTYL_CLIENT_KEY=${PTERO_CLIENT_KEY}
PTERODACTYL_LOCATION_ID=1
PTERODACTYL_NEST_ID=1
PTERODACTYL_EGG_ID=15
EOF

echo -e "${BLUE}Running Composer & Migrations (This may take a minute)...${NC}"
composer install --no-dev --optimize-autoloader
php artisan key:generate --force
php artisan migrate --seed --force

echo -e "${BLUE}Compiling Assets...${NC}"
npm install
npm run build

# Set Permissions
chown -R www-data:www-data /var/www/vortexdash
chmod -R 775 /var/www/vortexdash/storage /var/www/vortexdash/bootstrap/cache

echo -e "\n${YELLOW}[6/6] Finalizing Nginx Webserver...${NC}"
cat <<EOF > /etc/nginx/sites-available/vortexdash.conf
server {
    listen 80;
    server_name ${FQDN};
    root /var/www/vortexdash/public;
    index index.php;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php\$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
    }
}
EOF

ln -s /etc/nginx/sites-available/vortexdash.conf /etc/nginx/sites-enabled/
rm /etc/nginx/sites-enabled/default 2>/dev/null
systemctl restart nginx

echo -e "\n${GREEN}======================================================================${NC}"
echo -e "${GREEN}                 VORTEXDASH DEPLOYMENT SUCCESSFUL!                    ${NC}"
echo -e "Access your dashboard at: ${BLUE}http://${FQDN}${NC}"
echo -e "======================================================================"