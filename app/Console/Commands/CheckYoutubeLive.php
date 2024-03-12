<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google_Client;
use Google_Service_YouTube;
use App\Models\YoutubeFlag;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CheckYoutubeLive extends Command
{
    protected $signature = 'command:check-live';
    protected $description = 'Check if there is a live stream on a specific YouTube channel.';

    public function handle()
    {
        try {

            // $metronorth_youtube_id = 'UCRCxfb3MZA-EC5pOa_IOu2w';

            // $kapamilya_youtube_id = 'UCstEtN0pgOmCf02EdXsGChw';

            // $test_live = 'UC3XaG-7UVi2vD8ZZEMNnnpw';

                        // $nbc_news = 'UCeY0bbntWzzVIaj2z3QigXg';

            Log::info('YouTube live check started.');
            // Initialize Google API client with disabled SSL verification
            $YoutubeFlag = YoutubeFlag::first();
            $client = new Google_Client();
            $client->setDeveloperKey($YoutubeFlag->api_key);
            $client->setHttpClient(new Client(['verify' => false]));

            // Initialize YouTube service
            $youtube = new Google_Service_YouTube($client);

            // Replace 'CHANNEL_ID' with the actual YouTube channel ID
            $channelId = $YoutubeFlag->channel_id;

            // Perform API request to check live broadcasts
            $response = $youtube->search->listSearch('id', [
                'type' => 'video',
                'eventType' => 'live',
                'channelId' => $channelId,
                'maxResults' => 1,
            ]);

            // Check if there is a live stream
            $isLive = count($response->getItems()) > 0;

            if($isLive > 0){
                $videoId = $response->getItems()[0]->id->videoId;
                YoutubeFlag::where('channel_id', $channelId)->update(['live_flag' => $isLive, 'video_id' => $videoId]);
            }
            else{
                YoutubeFlag::where('channel_id', $channelId)->update(['live_flag' => $isLive]);
            }
            // Update database flag

            Log::info('Live flag updated successfully.');

        } catch (\Exception $e) {
            $channelId = 'UCstEtN0pgOmCf02EdXsGChw';
            YoutubeFlag::where('channel_id', $channelId)->update(['live_flag' => 0]);
            $this->error('Error updating live flag: ' . $e->getMessage());
            Log::error('Error updating live flag: ' . $e->getMessage());
        }
    }
}
