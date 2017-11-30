<?php

namespace App\Console;

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
        Commands\ImapCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->call(function () {
        //         })
        //         ->everyFiveMinutes()
        //         ->appendOutputTo($filePath);
        $schedule->command('custom:email')
                 ->everyMinute();
                //  ->twiceDaily(1, 13)
                //  ->hourly()
                //  ->daily()
                //  ->dailyAt("07:00")
                //  ->weekly()
                //  ->monthly();   
                //  ->when(Closure);
    }

    public function commands()
    {
        // require base_path('routes')
    }
}
