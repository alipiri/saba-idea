<?php

namespace App\Http\FactoryMethod;

use App\Http\Interfaces\SendNotificationInterface;

class SendSms implements SendNotificationInterface
{

    protected $mobile;

    public function __construct(string $mobile)
    {
        $this->mobile = $mobile;
    }

    public function sendNotification()
    {
        
    }
}
