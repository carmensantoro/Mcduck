<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RevisorRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $request_revisor;
    
    public function __construct($request_revisor)
    {
        $this->request_revisor = $request_revisor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('mc.duck@paperopoli.com')
        ->view('mail.revisor_request')
        ->with([
            'revisorRequest' => $this->request_revisor,
        ]);
    }
}
