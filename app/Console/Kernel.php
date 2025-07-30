<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        // Generate inventory report weekly on Sunday at midnight
        $schedule->command('library:inventory-report')->weekly()->sundays()->at('00:00');
        
        // Send overdue notifications daily at 8 AM
        $schedule->command('library:send-overdue-notifications')->dailyAt('08:00');
        
        // Check reservations daily at 6 AM
        $schedule->command('library:check-reservations')->dailyAt('06:00');
        
        // Check for expired reservations daily at 1 AM
        $schedule->command('library:check-reservations')->dailyAt('01:00');
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