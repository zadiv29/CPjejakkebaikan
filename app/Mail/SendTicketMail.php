<?php

namespace App\Mail;

use App\Models\Volunteer;
use App\Models\VolunteerPayment;
use App\Models\Voluntrip;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $volunteer;
    public $voluntrip;
    public $payment;

    /**
     * Create a new message instance.
     */
    public function __construct(Volunteer $volunteer, Voluntrip $voluntrip, VolunteerPayment $payment)
    {
        $this->volunteer = $volunteer;
        $this->voluntrip = $voluntrip;
        $this->payment = $payment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tiket Voluntrip Jejak Kebaikan',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.send-ticket-mail',
            with: [
                'volunteer' => $this->volunteer,
                'voluntrip' => $this->voluntrip,
                'payment' => $this->payment,
            ]
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
