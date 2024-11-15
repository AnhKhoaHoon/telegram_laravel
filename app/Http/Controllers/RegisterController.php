<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\SendTelegramNotification;
use Telegram\Bot\Laravel\Facades\Telegram;

use Illuminate\Support\Facades\Notification;
class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
    

        // Tạo người dùng mới
        $user = User::create([
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        // Gửi thông báo qua Telegram
        $text = "Đăng ký thành công";


        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
            'parse_mode' => 'HTML',
            'text' => $text
        ]);

        return redirect()->back();
    }
}
