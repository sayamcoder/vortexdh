<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('coins')->default(500); // Give 500 starting coins
            $table->integer('max_servers')->default(1);
            $table->integer('max_ram')->default(2048); // 2GB
            $table->integer('max_cpu')->default(100);  // 100% (1 core)
            $table->integer('max_disk')->default(10240); // 10GB
        });

        Schema::table('servers', function (Blueprint $table) {
            // Add cpu and disk to servers if they don't exist
            $table->integer('cpu')->default(100)->after('memory');
            $table->integer('disk')->default(5120)->after('cpu');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['coins', 'max_servers', 'max_ram', 'max_cpu', 'max_disk']);
        });
        Schema::table('servers', function (Blueprint $table) {
            $table->dropColumn(['cpu', 'disk']);
        });
    }
};
