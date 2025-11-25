<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('items', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('cart_items', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('announcements', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('inbox_messages', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('items', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('inbox_messages', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
