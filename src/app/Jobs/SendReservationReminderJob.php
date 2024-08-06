<?php

namespace App\Jobs;

use App\Models\Date;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationReminder;

class SendReservationReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $today = now()->toDateString();
        $reservations = Date::join('stores', 'stores.id', '=', 'dates.store_id')
            ->where('reservation_date', $today)->get();

        foreach ($reservations as $reservation) {
            $userEmail = $reservation->user->email;
            Mail::to($userEmail)->send(new ReservationReminder($reservation));
        }
    }
}
