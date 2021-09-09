<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class repMailSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $user_name, int $plus_count)
    {
        $this->user_name = $user_name;
        $this->plus_count = $plus_count;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails/rep_body')
                        ->from("koudoldk@icloud.com")
                        ->subject("【Submarine】リクエストが承認されました")
                        ->with([
                            "user_name" => $this->user_name,
                            "plus_count" => $this->plus_count
                        ]);
    }
}
