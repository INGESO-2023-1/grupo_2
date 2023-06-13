<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can send messages', function () {
    $user = User::factory()->create();

    $receiver = User::factory()->create();

    $this->actingAs($user)
        ->post('/send', [
            'receiver_username' => $receiver->username,
            'content' => 'Hello World',
        ])
        ->assertRedirect(route('chat', 1));

    expect($user->getChats()->count())->toBe(1);
    expect($receiver->getChats()->count())->toBe(1);
    expect($user->getChats()->first()->messages->count())->toBe(1);
    expect($receiver->getChats()->first()->messages->count())->toBe(1);
    expect($user->getChats()->first()->messages->first()->content)->toBe('Hello World');
});
