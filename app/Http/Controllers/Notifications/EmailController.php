<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Models\User;
use App\Services\Notification\Constants\EmailTypes;
use App\Services\Notification\Notification;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function showForm()
    {
        $users = User::all();
        $emailTypes = EmailTypes::toString();

        return view('notifications.send-email', compact('users', 'emailTypes'));
    }

    public function sendEmail(Request $request)
    {
        $this->validate($request, [
            'user' => 'required|integer|exists:users,id',
            'email_type' => 'required|integer'
        ]);

        try {

            $mailable = EmailTypes::toMail($request->email_type);
            SendEmail::dispatch(User::find($request->user), new $mailable);


            return redirect()->back()->with(['success_msg' => 'ایمیل مورد نظر با موفقیت ارسال شد.']);


        } catch (\Exception $e) {

            return redirect()->back()->with(['error_msg' => 'وجود خطا در سرویس ارسال ایمیل؛ لطفا لحظاتی دیگر دوباره تلاش کنید. ' . 'متن ارور: ' . $e->getMessage()]);

        }
    }
}
