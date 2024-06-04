<?php
namespace App\Http\FactoryMethod;

use App\Http\FactoryMethod\SendSms;
use App\Http\FactoryMethod\SendEmail;


class NotificationFactory
{
    protected $send;

    public function sendNotification(string $type, string $address)
    {
        $type = strtolower($type);

        if ($type === 'sms')
        {
            
            $this->send = new SendSms($address);
        }
        elseIf($type === 'email')
        {
            $this->send = new SendEmail($address);
        }

        return $this->send;
    }
}
