<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop_items', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // ram, cpu, disk, slot
            $table->string('name');
            $table->integer('cost');
            $table->integer('amount');
            $table->string('column_name'); // max_ram, max_cpu, etc.
            $table->string('icon_color'); // to keep the UI colorful
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_items');
    }
};
