<?php

namespace App\Services\Notification;

use App\Services\Notification\Providers\Contracts\Provider;

/**
 * @method sendSms(App\Models\User $user, String $message)
 * @method sendEmail(App\Models\User $user, Illuminate\Mail\Mailable $mailable)
 */

class Notification
{
    public function __call(string $name, array $arguments)
    {
        // remove 'send' word
        $providerPath = __NAMESPACE__ . DIRECTORY_SEPARATOR . 'Providers' . DIRECTORY_SEPARATOR . substr($name, 4) . 'Provider';

        if (!class_exists($providerPath)) {
            throw new \Exception("Class {$providerPath} does not exist!");
        }

        $provider = new $providerPath(...$arguments);

        if (!is_subclass_of($provider, Provider::class)) {
            throw new \Exception("Class must implements App\Services\Notification\Providers\Contracts\Provider::class");
        }

        return $provider->send();
    }

}
