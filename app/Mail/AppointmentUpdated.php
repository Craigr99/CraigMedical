<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Visit;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $visit;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Visit $visit)
    {
        $this->user = $user;
        $this->visit = $visit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.visits.updated')->subject('Appointment Changed');
    }
}
