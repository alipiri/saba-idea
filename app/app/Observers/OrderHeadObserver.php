<?php

namespace App\Observers;

use App\Models\OrderHead;
use App\Http\FactoryMethod\NotificationFactory;

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
                $action = $type->sendNotification('sms', $user->mobile);
            }

            if ($user->email != null) {
                $action = $type->sendNotification('email', $user->email);
            }
            
            if ($action) 
            {
                $action->send($user->mobile);
            }
        }
    }

}
