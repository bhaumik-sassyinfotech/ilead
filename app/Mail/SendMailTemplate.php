<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $address = 'tejas.sassyinfotech@gmail.com';
        // $name = 'Ignore Me';
        // $subject = 'Email Template Found';
        // return $this->view('emailtemplate.create');
        // return $this->view('emailtemplate.sendmailtemplate')
        //         ->from($address, $name)
        //         ->cc($address, $name)
        //         ->bcc($address, $name)
        //         ->replyTo($address, $name)
        //         ->subject($subject);
    }
}
