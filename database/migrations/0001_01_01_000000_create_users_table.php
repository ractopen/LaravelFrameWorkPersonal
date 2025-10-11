<?php

/**
 * USERS TABLE MIGRATION - POSTGRESQL
 * 
 * Simple users table with only email and password
 * For basic login/register system
 * 
 * To run: php artisan migrate
 * To rollback: php artisan migrate:rollback
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates users table in PostgreSQL database
     */
    public function up(): void
    {
        // USERS TABLE - Simple login/register
        Schema::create('users', function (Blueprint $table) {
            $table->id();                          // Auto-increment ID
            $table->string('email')->unique();     // Email (must be unique - prevents duplicate accounts)
            $table->string('password');            // Plain text password
            $table->timestamps();                  // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     * Drops the users table
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
