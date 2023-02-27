<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $full_name;
    public $link;

    public function __construct($full_name, $link)
    {
        $this->full_name    = $full_name;
        $this->link         = $link;
    }


    public function build()
    {
        return $this->subject('Kích Hoạt Tài Khoản')->view('mail.chutro_active', [
            'link'      => $this->link,
            'full_name' => $this->full_name,
        ]);
    }
}
