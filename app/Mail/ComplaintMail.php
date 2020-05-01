<?php

namespace App\Mail;

use App\Complaint;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintMail extends Mailable
{
    use Queueable, SerializesModels;
    private $data;


    /**
     * Create a new message instance.
     *
     * @param Complaint $complaint
     */
    public function __construct($data)
    {

        $this->data = $data;






    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.mail',['data'=> $this->data]);
    }
}
