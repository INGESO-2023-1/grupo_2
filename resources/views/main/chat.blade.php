@extends('main.template.main')

@section('content')
  <x-base.layout.container>
    <x-base.layout.title-bar
      title="Chateando con {{ $chat->getOtherUser($user)->username }}"
      :previus-route="route('chats')"
    >
    </x-base.layout.title-bar>
    <div class="col-span-12">
      <v-chats
        chat-id="{{ $chat->id }}"
        user-id="{{ $user->id }}"
      > </v-chats>
    </div>
  </x-base.layout.container>
@endsection
