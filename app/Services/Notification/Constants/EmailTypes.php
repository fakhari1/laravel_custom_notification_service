<?php

namespace App\Services\Notification\Constants;

use App\Mail\ForgetPassword;
use App\Mail\TopicCreated;
use App\Mail\UserRegistered;

class EmailTypes
{
    const USER_REGISTERED = 1;
    const TOPIC_CREATED = 2;
    const FORGET_PASSWORD = 3;
    const POST_CREATED = 4;


    public static function toString()
    {
        return [
            self::USER_REGISTERED => 'کاربر ثبت نام کرده است',
            self::TOPIC_CREATED => 'تاپیک ایجاد شده است',
            self::FORGET_PASSWORD => 'فراموشی رمز عبور',
            self::POST_CREATED => 'پست ایجاد شده است',
        ];
    }

    public static function toMail($type)
    {
        try {
            return [
                self::USER_REGISTERED => UserRegistered::class,
                self::TOPIC_CREATED => TopicCreated::class,
                self::FORGET_PASSWORD => ForgetPassword::class
            ][$type];
        } catch (\Throwable $throwable) {
            throw new \InvalidArgumentException('Mailable class does not exists!');
        }
    }
}
