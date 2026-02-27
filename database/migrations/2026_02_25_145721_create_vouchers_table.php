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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->integer('reward'); // Amount of coins
            $table->integer('uses')->default(0); // Times used
            $table->integer('max_uses')->nullable(); // Null = infinite
            $table->timestamps();
        });
    
        // Track who used which voucher to prevent double claiming
        Schema::create('voucher_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('voucher_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }    
};
