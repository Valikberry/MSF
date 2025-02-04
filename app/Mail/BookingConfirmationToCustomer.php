<?php

namespace App\Mail;

use App\Enums\PaymentMethod;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class BookingConfirmationToCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public Booking $booking;
    public string $booking_id = '';
    public string $booking_url = '';
    public string $phone_no = '';
    public string $whatsapp_no = '';
    public string $name = '';
    public string $total = '';
    public string $moving_date = '';
    public string $moving_time = '';
    public string $payment_method = '';
    public string $email;
    public string $comment;
    public array $services;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
        $this->booking_id = $this->booking->id;
        $this->booking_url = route('booking.view', ['id' => $booking->uid]);
        $this->name = $this->booking->name;
        $this->email = $this->booking->email;
        $this->phone_no = $this->booking->phone_no;
        $this->whatsapp_no = $this->booking->whatsapp_no;
        $this->total = showPrice($this->booking->total);
        $this->moving_date = getReadableDate($this->booking->moving_date);
        $this->moving_time = getReadableTime($this->booking->moving_time);
        $this->comment = (string) $this->booking->description;
        $this->payment_method =  PaymentMethod::getName($this->booking->payment_method);
        $this->services = (array) $this->booking->services;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Booking Confirmed'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'frontend.booking.email.booking_confirmation_to_customer',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
