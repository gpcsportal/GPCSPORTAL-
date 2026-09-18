<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('papers', function (Blueprint $table): void {
            $table->index(['status', 'created_at'], 'papers_status_created_index');
            $table->index(['paper_code', 'subject_code'], 'papers_codes_index');
        });

        Schema::table('notes', function (Blueprint $table): void {
            $table->index(['status', 'created_at'], 'notes_status_created_index');
            $table->index(['subject_code', 'branch', 'semester'], 'notes_lookup_index');
        });

        Schema::table('gallery_images', function (Blueprint $table): void {
            $table->index(['status', 'created_at'], 'gallery_status_created_index');
        });

    }

    public function down(): void
    {
        Schema::table('papers', function (Blueprint $table): void {
            $table->dropIndex('papers_status_created_index');
            $table->dropIndex('papers_codes_index');
        });

        Schema::table('notes', function (Blueprint $table): void {
            $table->dropIndex('notes_status_created_index');
            $table->dropIndex('notes_lookup_index');
        });

        Schema::table('gallery_images', function (Blueprint $table): void {
            $table->dropIndex('gallery_status_created_index');
        });

    }
};
