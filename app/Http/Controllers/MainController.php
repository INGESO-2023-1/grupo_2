<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        return view('main.index');
    }

    public function login(Request $request): RedirectResponse
    {
        $user = User::whereUsername($request->username)->firstOrCreate([
            'username' => $request->username,
        ]);

        Auth::login($user);

        return redirect()->route('chats');
    }

    public function chats(): View
    {
        return view('main.chats');
    }

    public function send(): RedirectResponse
    {
        return redirect()->route('chats');
    }
}
