<?php

namespace App\Mail;

use App\Models\Bookings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;

class RideCancellationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $booking;
    public function __construct(Bookings $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Ride Cancellation Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.cancellationemail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    /**
     * Build the message.
     *
     * @param  Mailer  $mailer
     * @return void
     */
    public function build(Mailer $mailer)
    {
        return $this->from(env('MAIL_USERNAME'), 'LightWaterLimo')
                    ->view('email.cancellationemail')
                    ->with('booking', $this->booking);
    }
}
