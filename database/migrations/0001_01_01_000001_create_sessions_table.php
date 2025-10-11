<?php

/**
 * SESSIONS TABLE MIGRATION - POSTGRESQL
 * 
 * This table stores user session data in the database
 * 
 * HOW DATABASE SESSIONS WORK:
 * 1. User logs in → Laravel creates a session ID (random string)
 * 2. Session data (user_id, email, etc.) is stored in this table
 * 3. Laravel sends session ID to browser as a cookie
 * 4. User visits another page → Browser sends cookie back
 * 5. Laravel looks up session ID in this table
 * 6. Retrieves user data → User stays logged in
 * 
 * WHY USE DATABASE SESSIONS:
 * ✓ Can see all active sessions in pgAdmin
 * ✓ Can manually delete sessions (force logout)
 * ✓ Can track user activity (last_activity timestamp)
 * ✓ Can see IP addresses and browser info
 * 
 * To run: php artisan migrate
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates sessions table in PostgreSQL
     */
    public function up(): void
    {
        // SESSIONS TABLE - Stores user login sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();                 // Session ID (random string sent to browser)
            $table->foreignId('user_id')->nullable()->index(); // Which user is logged in (NULL if guest)
            $table->string('ip_address', 45)->nullable();    // User's IP address
            $table->text('user_agent')->nullable();          // Browser and device info
            $table->longText('payload');                     // Session data (user_id, email, etc.)
            $table->integer('last_activity')->index();       // Last time user was active (timestamp)
        });
    }

    /**
     * Reverse the migrations.
     * Drops the sessions table
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
