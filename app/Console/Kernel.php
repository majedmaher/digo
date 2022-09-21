<?php

namespace App\Console;

use App\Console\Commands\UploadBackup;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // $schedule->command('queue:work --tries=2')->everyMinute();
        // $schedule->command('queue:restart')->everyFiveMinutes();

        $schedule->command('backup:clean')->dailyAt('01:30');
        $schedule->command('backup:run')->dailyAt('01:35');
        // $schedule->command('backup:clean')->everyMinute();
        // $schedule->command('backup:run')->everyMinute();
        // $schedule->command('backup:clean')->everyMinute();
        // $schedule->command('backup:run')->mondays();
        // $schedule->command('queue:retry all')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
