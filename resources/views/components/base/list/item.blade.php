{{--
  This component is used to display a list item inside a list.

  For example:
  <x-base.card.list>
    <x-base.card.list.item>
      A
    </x-base.card.list.item>
    <x-base.card.list.item>
      B
    </x-base.card.list.item>
  </x-base.card.list>
--}}

@props([
  'body' => $slot ?? $body,
])

<div
  {{ $attributes->merge([
    'class' => "flex flex-row items-center gap-3 py-3",
  ]) }}
>
  {{ $body }}
</div>
