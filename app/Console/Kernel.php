<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Your existing command
        $schedule->command('export:students')->everyFiveMinutes();

        // Good Morning at 9 AM
        $schedule->job(new \App\Jobs\SendDailyUserWish("Good Morning 🌞"))->dailyAt('09:00');

        // Good Afternoon at 1 PM
        $schedule->job(new \App\Jobs\SendDailyUserWish("Good Afternoon ☀"))->dailyAt('13:00');

        // Good Evening at 6 PM
        $schedule->job(new \App\Jobs\SendDailyUserWish("Good Evening 🌙"))->dailyAt('18:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
