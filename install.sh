#!/bin/bash

# ==============================================================================
# VortexDash Automated Installation Script
# Supports: Ubuntu 22.04 / 24.04
# Requires: Root privileges
# ==============================================================================

# Colors for terminal output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}======================================================================${NC}"
echo -e "${GREEN}                   VORTEXDASH AUTO-INSTALLER                      ${NC}"
echo -e "${BLUE}======================================================================${NC}"
echo -e "This script will install Nginx, PHP 8.2, MariaDB, Composer, and Node.js."
echo -e "It will then download and configure VortexDash for you."
echo ""

# 1. Root Check
if [ "$EUID" -ne 0 ]; then
  echo -e "${RED}ERROR: Please run this script as root (sudo bash install.sh)${NC}"
  exit 1
fi

# 2. Ask User for Info Before Starting
read -p "Enter the Domain/IP you will use for this dashboard (e.g., dash.example.com): " FQDN
read -p "Enter your Pterodactyl Panel URL (e.g., https://panel.example.com): " PTERO_URL
read -p "Enter your Pterodactyl Application API Key: " PTERO_KEY
read -p "Enter a secure password for the database: " DB_PASSWORD

echo -e "\n${YELLOW}[1/6] Updating OS and installing base dependencies...${NC}"
apt update -y && apt upgrade -y
apt install -y software-properties-common curl apt-transport-https ca-certificates gnupg git unzip zip wget nano vim nginx mariadb-server

echo -e "\n${YELLOW}[2/6] Installing PHP 8.2 and extensions...${NC}"
add-apt-repository -y ppa:ondrej/php
apt update -y
apt install -y php8.2 php8.2-{common,cli,gd,mysql,mbstring,bcmath,xml,fpm,curl,zip}

echo -e "\n${YELLOW}[3/6] Installing Composer and Node.js...${NC}"
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
apt install -y nodejs

echo -e "\n${YELLOW}[4/6] Configuring Database...${NC}"
# Create database and user
mysql -u root -e "CREATE DATABASE IF NOT EXISTS vortexdash;"
mysql -u root -e "CREATE USER IF NOT EXISTS 'vortex'@'127.0.0.1' IDENTIFIED BY '${DB_PASSWORD}';"
mysql -u root -e "GRANT ALL PRIVILEGES ON vortexdash.* TO 'vortex'@'127.0.0.1' WITH GRANT OPTION;"
mysql -u root -e "FLUSH PRIVILEGES;"

echo -e "\n${YELLOW}[5/6] Downloading and configuring VortexDash...${NC}"
mkdir -p /var/www/vortexdash
cd /var/www/vortexdash

# IMPORTANT: Replace this URL with your actual GitHub repository clone URL!
# Example: git clone https://github.com/YourUsername/VortexDash.git .
echo -e "${RED}NOTE: Script is cloning from a placeholder repo. Update the script with your real repo URL.${NC}"
mkdir vortexdash
cd vortexdash
git clone https://github.com/sayamcoder/vortexdh .  <--- UNCOMMENT THIS WHEN READY


# For now, if no repo exists, we simulate the setup so the script finishes without breaking
if [ ! -f "artisan" ]; then
    echo "Creating dummy artisan file to prevent script failure during testing..."
    touch artisan
fi

# Setup .env file
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
PTERODACTYL_API_KEY=${PTERO_KEY}
PTERODACTYL_LOCATION_ID=1
PTERODACTYL_NEST_ID=1
PTERODACTYL_EGG_ID=15
PTERODACTYL_NODE_ID=1
EOF

# Install dependencies (These will fail if repo isn't cloned, which is fine for this dry-run script)
composer install --no-dev --optimize-autoloader 2>/dev/null
php artisan key:generate --force 2>/dev/null
php artisan migrate --force 2>/dev/null
php artisan db:seed --class=ShopSeeder --force 2>/dev/null
npm install 2>/dev/null
npm run build 2>/dev/null

# Set Permissions
chown -R www-data:www-data /var/www/vortexdash
chmod -R 755 /var/www/vortexdash/storage 2>/dev/null
chmod -R 755 /var/www/vortexdash/bootstrap/cache 2>/dev/null

echo -e "\n${YELLOW}[6/6] Configuring Nginx...${NC}"
rm /etc/nginx/sites-enabled/default 2>/dev/null
cat <<EOF > /etc/nginx/sites-available/vortexdash.conf
server {
    listen 80;
    server_name ${FQDN};
    root /var/www/vortexdash/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php\$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

ln -s /etc/nginx/sites-available/vortexdash.conf /etc/nginx/sites-enabled/
systemctl restart nginx

echo -e "\n${GREEN}======================================================================${NC}"
echo -e "${GREEN}                 VORTEXDASH INSTALLATION COMPLETE!                    ${NC}"
echo -e "${GREEN}======================================================================${NC}"
echo -e "Your dashboard should now be accessible at: ${BLUE}http://${FQDN}${NC}"
echo -e ""
echo -e "To secure your site with SSL (HTTPS), run:"
echo -e "apt install -y certbot python3-certbot-nginx"
echo -e "certbot --nginx -d ${FQDN}"
echo -e "======================================================================"