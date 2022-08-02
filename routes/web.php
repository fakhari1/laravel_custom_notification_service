<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;
use App\Services\Notification\Notification;
use App\Mail\TopicCreated;
use App\Models\User;
use App\Http\Controllers\Notifications\EmailController;
use App\Http\Controllers\Notifications\SmsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    Mail::to('hosein.fakhari1998@gmail.com')->send(new UserRegistered());
//    return view('welcome');
//});

//Route::get('/email', function () {
//    SendEmail::dispatch();
//});

//Route::get('/', function () {
//    resolve(Notification::class)->sendEmail(User::find(1), new TopicCreated);
//    resolve(Notification::class)->sendSms(User::query()->findOrFail(1), 'این یک پیام تستی است.');
//});


Route::get('/', function () {
    return view('home');
});

Route::prefix('notifications')->group(function () {
    Route::get('email', [EmailController::class, 'showForm'])->name('notifications.form.email');
    Route::post('email', [EmailController::class, 'sendEmail'])->name('notifications.send.email');

    Route::get('sms', [SmsController::class, 'showForm'])->name('notifications.form.sms');
    Route::post('sms', [SmsController::class, 'sendSms'])->name('notifications.send.sms');
});
