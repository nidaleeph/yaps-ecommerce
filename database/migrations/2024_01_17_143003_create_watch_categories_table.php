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
        Schema::create('watch_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('watch_id')->constrained('watches');
            $table->foreignId('category_watch_id')->constrained('category_watches');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watch_categories');
    }
};
