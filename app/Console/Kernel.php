<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\YoutubeFlag;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Run the command every 30 minutes starting from 9:00 AM
        $schedule->command('command:check-live')
                ->everyThirtyMinutes()
                ->withoutOverlapping()
                ->runInBackground()  // Ensure the task doesn't overlap
                ->when(function () {
                    $currentHour = now()->hour;

                    // Stop running after 10:00 PM
                    if ($currentHour < 22) {
                        return true; // Run the command
                    } else {
                        // Update YoutubeFlag live_flag to 0 after 10:00 PM
                        $YoutubeFlag = YoutubeFlag::first();

                        YoutubeFlag::where('channel_id', $YoutubeFlag->channel_id)->update(['live_flag' => 0]);
                        return false; // Do not run the command
                    }
                });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
