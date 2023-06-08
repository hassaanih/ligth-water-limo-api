<?php

namespace App\Mail;

use App\Models\BookingDetails;
use App\Models\Bookings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * 
     * @return void
     */
    public $booking;
    public $booking_detail;
    public $card_number;
    public function __construct(Bookings $booking, BookingDetails $booking_detail, $card_number)
    {
        $this->booking = $booking;
        $this->booking_detail = $booking_detail;
        $this->card_number = $card_number;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Booking Confirmed',
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
            view: 'email.test',
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
                    ->subject('Booking Confirmation')
                    ->view('email.test')
                    ->with('booking', $this->booking)
                    ->with('booking_details', $this->booking_detail)
                    ->with('card_number', $this->card_number);
    }
}
