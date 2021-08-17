<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $user_name, int $user_id, string $remember)
    {
        $this->user_name = $user_name;
        $this->user_id = $user_id;
        $this->remember = $remember;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails/appro_body')
                    ->from("koudoldk@icloud.com")
                    ->subject("【Submarine】承認リクエスト")
                    ->with([
                        'user_name' => $this->user_name,
                        'user_id' => $this->user_id,
                        'remember' => $this->remember
                    ]);
    }
}
