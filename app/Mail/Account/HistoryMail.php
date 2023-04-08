<?php

namespace App\Mail\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HistoryMail extends Mailable
{
    use Queueable, SerializesModels;
    public array $accounts;
    public float $sum;
    public string $savingDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $accounts, float $sum, string $savingDate)
    {
        $this->accounts=$accounts;
        $this->sum=$sum;
        $this->savingDate=$savingDate;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Данные по счетам по состоянию на '.$this->savingDate,
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
            markdown: 'mail.account.history',
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
}
