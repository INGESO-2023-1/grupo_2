<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function getChat(Chat $chat): Chat
    {
        return $chat->load('messages');
    }

    public function sendMessage(Chat $chat, Request $request): string
    {
        if (!Auth::check()) {
            return redirect()->route('index');
        }

        $user = Auth::user();

        $chat->messages()->create([
            'sender_id' => $user->id, // @phpstan-ignore-line
            'content' => $request->content,
            'send_date' => now(),
        ]);

        return 'OK';
    }
}
