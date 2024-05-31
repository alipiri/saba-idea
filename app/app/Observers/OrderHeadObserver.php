<?php

namespace App\Observers;

use App\Http\FactoryMethod\NotificationFactory;
use App\Models\OrderHead;

class OrderHeadObserver
{
    /**
     * Handle the OrderHead "created" event.
     */
    public function created(OrderHead $orderHead): void
    {
        $type = new NotificationFactory();

        $user = $orderHead->user;
        if ($user) {

            if ($user->mobile != null) {
                $type->sendNotification('sms', $user->mobile);
            }

            if ($user->email != null) {
                $type->sendNotification('email', $user->email);
            }
            
        }
    }

}
