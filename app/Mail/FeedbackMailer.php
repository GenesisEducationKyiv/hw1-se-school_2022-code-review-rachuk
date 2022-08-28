<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackMailer extends Mailable
{
    use Queueable;
    use SerializesModels;

    private int $rate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $rate)
    {
        $this->rate = $rate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->from('rachuki@ukr.net', 'Поточний курс BTC до UAH')
            ->subject('Поточний курс BTC до UAH')
            ->view('email.feedback', ['data' => $this->rate]);
    }
}
