<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Jobs\SendSms;
use App\Models\User;
use App\Services\Notification\Exceptions\UserDoesNotHavePhoneNo;
use App\Services\Notification\Notification;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;

class SmsController extends Controller
{
    public function showForm()
    {
        $users = User::all();
        return view('notifications.send-sms', compact('users'));
    }

    public function sendSms(Request $request)
    {
        $this->validate($request, [
            'user' => 'required|integer|exists:users,id',
            'sms_text' => 'required|string|max:100'
        ]);

        try {

            SendSms::dispatch(User::find($request->user), $request->sms_text);

            return $this->redirectBack('success_msg', 'پیام کوتاه به کاربر مورد نظر با موفقیت ارسال شد.');

        } catch (\Exception $e) {

            return $this->redirectBack('error_msg', 'مشکل در ارسال پیام کوتاه؛ لطفا بعدا دوباره تلاش کنید.');

        }
    }

    private function redirectBack(string $type, string $text)
    {
        return redirect()->back()->with([$type => $text]);
    }
}
