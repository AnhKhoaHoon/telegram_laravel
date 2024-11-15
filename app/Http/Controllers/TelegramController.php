<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function updatedActivity()
    {
        $activity = Telegram::getUpdates();
        dd($activity);
    }
    public function contactForm()
    {
        return view('contact.contact_form');
    }
    public function storeMessage(Request $request)
    {
        $request->validate([
            'name'=>'required|name',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $text = "Đăng ký thành công";


        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
            'parse_mode' => 'HTML',
            'text' => $text
        ]);

        return redirect()->back();
    }
}
