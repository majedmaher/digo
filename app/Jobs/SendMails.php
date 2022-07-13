<?php

namespace App\Jobs;

use App\Mail\NotifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $data;
    public $mail;
    public function __construct($data, $mail)
    {
        $this->data = $data;
        $this->mail = $mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $_data) {
            // Mail::To($_data->email)->send(new NotifyEmail($this->mail));
            Mail::To('majedmaher249@gmail.com')->send(new NotifyEmail($this->mail));

            // Mail::To()->send(new NotifyEmail());
        }
    }
}
