<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminApproveWithdrawalRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $requested_data;
    public function __construct($user, $requested_data)
    {
        $this->user = $user;
        $this->requested_data = $requested_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.withdrawal-request-approval')->with('user', $this->user)->with('requested_data', $this->requested_data);
    }
}
