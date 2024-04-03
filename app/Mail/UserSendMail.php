<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class UserSendMail extends Mailable
{
    use Queueable, SerializesModels;
    public array $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $content)
    {
        $this->content=$content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() 
    {
        return $this->subject($this->content['subject'])
            ->view('mails.mail');
    }
}
