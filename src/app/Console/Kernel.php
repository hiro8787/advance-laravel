<?php

namespace App\Console;

use App\Models\Date;
use App\Jobs\SendReservationReminderJob;
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
    $schedule->call(function () {
        $today = now()->toDateString();
        $reservations = Date::where('reservation_date', $today)->get();

        foreach ($reservations as $reservation) {
            SendReservationReminderJob::dispatch($reservation);
        }
    })->dailyAt('7:00');
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
