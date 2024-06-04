<?php

namespace App\Http\Traits;

use App\Models\User;
use App\Models\OrderHead;

trait OrderHeadTrait
{
    public function createOrderHead($request)
    {
        $user_id = $this->checkUser($request->email, $request->mobile, $request->name);

        return OrderHead::create([
            'seller_id' => $request->seller_id,
            'user_id' => $user_id,
            'total_price' => 0
        ]);
    }

    public function checkUser(string $email = null, string $mobile = null, string $name = '')
    {
        if ($email != '') {
            $user = User::firstOrCreate([
                'email' => $email,
            ], [
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
            ]);

            return $user->id;
        } elseif ($mobile != '') {
            $user = User::firstOrCreate([
                'mobile' => $mobile,
            ], [
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
            ]);

            return $user->id;
        }

        return null;
    }
}
