<?php

namespace App\Helper;

use Illuminate\Support\Str;
use App\Models\Order;

class TokenService
{
    public function generateToken($tokenType)
    {
        $length = 32;

        switch ($tokenType) {
            case 'order':
                do {
                    $token = Str::random($length);
                } while (self::orderTokenExists($token));
                return $token; // Return the generated token
            default:
                return Str::random($length);
        }
    }

    public static function orderTokenExists($token)
    {
        return Order::where('uCode', $token)->exists();
    }
}
