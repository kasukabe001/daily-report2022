<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($maildata, $email)
    {
        $this->name = $maildata['name'];
        $this->affiliation = $maildata['affiliation'];
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email)
            ->subject('テストタイトル')
            ->from('no-reply@registration-mail.org')
            ->view('mail.mail')
            ->with([
                'name' => $this->name,
                'affiliation' => $this->affiliation,
        ]);
    }
}
