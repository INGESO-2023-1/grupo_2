<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('chats');
        }

        return view('main.index');
    }

    public function login(Request $request): RedirectResponse
    {
        $user = User::whereUsername($request->username)->firstOrCreate([
            'username' => $request->username,
        ]);

        \Auth::login($user);

        return redirect()->route('chats');
    }

    public function chats(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('index');
        }

        $chats = Auth::user()->getChats();

        return view('main.chats', [
            'user' => Auth::user(),
            'chats' => $chats,
        ]);
    }

    public function send(Request $request): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('index');
        }

        $user = Auth::user();
        $receiver = User::whereUsername($request->receiver_username)->first();

        if (!$receiver) {
            return redirect()->route('chats')->withErrors('User does not exist');
        }

        if ($user->id === $receiver->id) {
            return redirect()->route('chats')->withErrors('You cannot send messages to yourself');
        }

        if (Chat::whereUser1Id($user->id)->whereUser2Id($receiver->id)->exists()) {
            $chat = Chat::whereUser1Id($user->id)->whereUser2Id($receiver->id)->first();
        } elseif (Chat::whereUser1Id($receiver->id)->whereUser2Id($user->id)->exists()) {
            $chat = Chat::whereUser1Id($receiver->id)->whereUser2Id($user->id)->first();
        } else {
            $chat = Chat::create([
                'user1_id' => $user->id, // @phpstan-ignore-line
                'user2_id' => $receiver->id, // @phpstan-ignore-line
                'start_date' => now(),
            ]);
        }

        $chat->messages()->create([
            'sender_id' => $user->id, // @phpstan-ignore-line
            'content' => $request->content,
            'send_date' => now(),
        ]);

        return redirect()->route('chat', $chat);
    }

    public function chat(Chat $chat): View
    {
        return view('main.chat', [
            'chat' => $chat,
            'user' => Auth::user(),
            'receiver' => $chat->getOtherUser(Auth::user()),
        ]);
    }
}
