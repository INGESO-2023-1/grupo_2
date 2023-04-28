{{--
  This component is used to display a list inside a card.

  @param boolean $divide If true, the list will have a divider between each item.

  For example:
  <x-student.card.card>
    <x-student.card.list>
      <x-student.card.list-item>
        A
      </x-student.card.list-item>
      <x-student.card.list-item>
        B
      </x-student.card.list-item>
    </x-student.card.list>
  </x-student.card.card>
--}}

@props([
  'divide' => 'divide-y divide-black dark:divide-white divide-opacity-5 dark:divide-opacity-5'
])

<div
  {{ $attributes->merge([
    'class' => "flex flex-col my-[-1rem]
                {$divide}"
  ]) }}
>
  @if($slot->isNotEmpty())
    {{ $slot }}
  @else
    <i>
      {{ __('there is no data to show') }}
    </i>
  @endif
</div>
