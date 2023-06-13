@extends('main.template.main')

@section('content')
  <x-base.layout.container>
    <div class="col-span-12">
      <x-base.form.errors />
    </div>
    <div class="col-span-12">
      <x-base.card :header="'Chat with ' . $receiver->username">
        <x-base.list>
          @foreach ($chat->messages as $message)
            <x-base.list.item :class="$message->sender_id == $user->id ? 'justify-end' : 'justify-start'">
              {{ $message->content }}
            </x-base.list.item>
          @endforeach
        </x-base.list>
      </x-base.card>
    </div>
    <div class="col-span-12">
      <x-base.card header="Enviar como {{ Auth::user()->username }}">
        <x-base.form
          method="POST"
          action="/send"
          id="form-send"
        >
          <x-base.form.list>
            <input
              type="text"
              value="{{ $receiver->username }}"
              hidden
              name="receiver_username"
              @class([
                  'rounded h-10 px-2 w-full focus:border-blue-500 focus:border-2 focus:ring-0 disabled:text-opacity-60 disabled:text-white border-black border-opacity-20 border-1 dark:border-white dark:border-opacity-10 dark:border-1 bg-dark bg-opacity-10 dark:bg-black dark:bg-opacity-30',
              ])
            >
            <x-base.form.list.item
              input="text"
              attribute="content"
              required
            />
          </x-base.form.list>
          <x-base.action
            type="submit"
            body="Enviar"
            form="form-send"
          />
        </x-base.form>
      </x-base.card>
    </div>
  </x-base.layout.container>
@endsection
