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
        Schema::create('youtube_flags', function (Blueprint $table) {
            $table->id();
            $table->string('channel_id', 255);
            $table->string('api_key', 255);
            $table->string('video_id', 255)->nullable();
            $table->boolean('live_flag')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('youtube_flags');
    }
};
