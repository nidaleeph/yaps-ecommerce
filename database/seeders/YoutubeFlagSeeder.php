<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\YoutubeFlag;

class YoutubeFlagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        YoutubeFlag::create([
            'channel_id' => 'UCRCxfb3MZA-EC5pOa_IOu2w',
            'api_key' => 'AIzaSyCtRE9FQz3Z39sodMk-Lp5OwDFQFQJOArU',
        ]);
    }
}
