@extends('main.template.main')

@section('content')
  <x-base.layout.container>
    <div class="col-span-12">
      <x-base.form.errors />
    </div>
    <div class="col-span-12">
      <x-base.card header="Enviar como {{ Auth::user()->username }}">
        <x-base.form
          method="POST"
          action="/send"
          id="form-send"
        >
          <x-base.form.list>
            <x-base.form.list.item
              input="text"
              attribute="receiver_username"
              required
            />
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
    <div class="col-span-12">
      <x-base.card header="Chats">
        <x-base.list>
          @foreach ($chats as $chat)
            <x-base.list.item class="grid grid-cols-12 gap-8">
              <div class="col-span-2">
                <div class="h-6 w-full rounded">
                  {{ $chat->getOtherUser($user)->username }}
                </div>
              </div>
              <div class="col-span-9">
                <div class="h-6 w-full rounded">
                  {{ $chat->messages()->latest()->first()->content }}
                </div>
              </div>
              <div class="col-span-1">
                <div class="h-6 w-full rounded">
                  {{ $chat->messages()->count() }}
                </div>
              </div>
            </x-base.list.item>
          @endforeach
        </x-base.list>
      </x-base.card>
    </div>
  </x-base.layout.container>
@endsection
