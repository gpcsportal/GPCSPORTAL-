<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->index(['role', 'created_at'], 'users_role_created_index');
        });

        Schema::table('contact_messages', function (Blueprint $table): void {
            $table->index(['status', 'created_at'], 'contact_status_created_index');
        });

        Schema::table('admin_activity_logs', function (Blueprint $table): void {
            $table->index('created_at', 'admin_logs_created_index');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropIndex('users_role_created_index');
        });

        Schema::table('contact_messages', function (Blueprint $table): void {
            $table->dropIndex('contact_status_created_index');
        });

        Schema::table('admin_activity_logs', function (Blueprint $table): void {
            $table->dropIndex('admin_logs_created_index');
        });
    }
};
