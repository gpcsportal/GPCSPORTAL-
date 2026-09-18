<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('portal_notifications');
    }

    public function down(): void
    {
        // Intentionally irreversible: this retired feature must not be recreated.
    }
};
