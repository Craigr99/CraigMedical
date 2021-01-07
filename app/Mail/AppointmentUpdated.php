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

    // Global variables
    public $user;
    public $visit;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Visit $visit)
    {
        // set user and visit
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
        // return the email view, attach a subject
        return $this->markdown('emails.visits.updated')->subject('Appointment Changed');
    }
}
