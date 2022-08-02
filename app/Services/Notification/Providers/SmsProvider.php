<?php

namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Exceptions\UserDoesNotHavePhoneNo;
use App\Services\Notification\Providers\Contracts\Provider;
use Ghasedak\GhasedakApi;

class SmsProvider implements Provider
{
    private $user;
    private $message;

    public function __construct(User $user, string $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function send()
    {
        $this->havePhoneNumber();
        $receptor = $this->user->phone_number;
        try {
            $api = new GhasedakApi(env('GHASEDAKAPI_KEY'));
            $response = $api->SendSimple(
                $receptor, // receptor
                $this->message, // message
                env('SMS_GHASEDAK_LINE_NUMBER') // choose a line number from your account
            );

            return json_decode(json_encode($response), true)['result']['code'] == 200;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function havePhoneNumber()
    {
        if ($this->user->phone_number == null) {
            throw new UserDoesNotHavePhoneNo();
        }
    }

}
