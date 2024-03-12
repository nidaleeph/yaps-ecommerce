<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('watch_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('watch_id')->constrained('watches');
            $table->string('path', 255);
            $table->string('url', 255);
            $table->string('mime', 55);
            $table->integer('size');
            $table->integer('position')->nullable();
            $table->timestamps();
        });

        DB::table('watches')
            ->chunkById(100, function (Collection $watch) {
                $watch = $watch->map(function ($p) {
                    return [
                        'watch_id' => $p->id,
                        'path' => '',
                        'url' => $p->image,
                        'mime' => $p->image_mime,
                        'size' => $p->image_size,
                        'position' => 1,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ];
                });

                DB::table('watch_images')->insert($watch->all());

            });

        Schema::table('watches', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('image_mime');
            $table->dropColumn('image_size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watch_images');
    }
};
