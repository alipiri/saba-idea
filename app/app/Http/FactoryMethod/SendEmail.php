<?php

namespace App\Http\FactoryMethod;

use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Interfaces\SendNotificationInterface;

class SendEmail implements SendNotificationInterface
{

    protected $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function send()
    {
        Mail::to($this->email)->send(new InvoiceMail());
    }
}
