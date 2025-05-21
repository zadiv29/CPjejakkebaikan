<?php

namespace App\Mail;

use App\Models\Volunteer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VolunteerVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $volunteer;
    public $paymentChannel;

    /**
     * Create a new message instance.
     */
    public function __construct(Volunteer $volunteer, $paymentChannel)
    {
        $this->volunteer = $volunteer;
        $this->paymentChannel = $paymentChannel;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Volunteer Verification Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.verificationEmail',
            with: [
                'volunteer' => $this->volunteer
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
