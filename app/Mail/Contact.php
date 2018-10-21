<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $message;
    public $mailfrom;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message,$name,$mailfrom)
    {
        $this->name     = $name;
        $this->message  = $message;
        $this->mailfrom = $mailfrom;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->mailfrom)->markdown('emails.contact');
    }
}
