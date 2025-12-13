<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    // Terima data booking saat class dipanggil
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Undangan Kegiatan: ' . $this->booking->purpose,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invitation', // Kita akan buat view ini sebentar lagi
        );
    }
}