<?php

namespace App\Http\FactoryMethod;

use Kavenegar\KavenegarApi;
use App\Http\Interfaces\SendNotificationInterface;

class SendSms implements SendNotificationInterface
{

    protected $mobile;

    public function __construct(string $mobile)
    {
        $this->mobile = $mobile;
    }

    public function send()
    {
        $sender = "1000689696";
        $receptor = "09361182258";
        $api = new KavenegarApi("486E724F57345431746C37644D7766554D61373664376A4A4B523349762B46306B4932556471554B6662673D");
        $api->Send($sender, $receptor, 'order registerd');
    }
}
