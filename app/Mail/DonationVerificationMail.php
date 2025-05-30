<?php

namespace App\Mail;

use App\Models\Donatur;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonationVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $donation;
    public $paymentChannel;
    public $fundraising;
    public $amount;

    public function __construct(Donatur $donation, $paymentChannel, $fundraising, $amount)
    {
        $this->donation = $donation;
        $this->paymentChannel = $paymentChannel;
        $this->fundraising = $fundraising;
        $this->amount = $amount;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Donation Verification Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.verificationDonation',
            with: [
                'donation' => $this->donation,
                'payment' => $this->paymentChannel,
                'fundraising' => $this->fundraising,
                'amount' => $this->amount
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
