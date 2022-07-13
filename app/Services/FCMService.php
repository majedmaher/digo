<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FCMService
{
    public static function send($tokens, $notification)
    {
        return Http::acceptJson()->withToken(env('FCM_SERVER_KEY'))->post(
            'https://fcm.googleapis.com/fcm/send',
            [
                'registration_ids' => $tokens,
                // 'notification' => $notification,
                'data' => $notification,
            ]
        );
    }
}
