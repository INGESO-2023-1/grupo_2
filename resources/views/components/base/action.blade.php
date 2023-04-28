@props([
  'type' => 'a',
  'href',
  'method' => false,
  'form' => false,
  'body' => 'button',

  'padding' => 'p-3',
  'color' => 'bg-gray-300 text-black',
  'darkColor' => 'dark:bg-gray-300 dark:text-black',
  'icon' => false,
])

@if($type == 'form')
  <form action="{{ $href }}" method="POST" id="form-{{ $method }}" hidden>
    @csrf
    @METHOD($method)
  </form>
  <button type="submit" form="form-{{ $method }}"
    {{ $attributes->merge([
        'class' => "{$padding} {$color} {$darkColor} rounded flex items-center gap-1"
    ]) }}
  >
    @if ($icon)
      <span class="iconify text-lg" data-icon="{{ $icon }}"></span>
    @endif
    <div>
      {{ $body }}
    </div>
  </button>
@elseif($type == 'a')
  <a href="{{ $href }}"
    {{ $attributes->merge([
      'class' => "{$padding} {$color} {$darkColor} rounded flex items-center gap-1"
    ]) }}
  >
    @if ($icon)
      <span class="iconify text-lg" data-icon="{{ $icon }}"></span>
    @endif
    <div>
      {{ $body }}
    </div>
  </a>
@elseif($type == 'submit')
  <button type="submit" form="{{ $form }}"
    {{ $attributes->merge([
      'class' => "{$padding} {$color} {$darkColor} rounded flex items-center gap-1"
    ]) }}
  >
    @if ($icon)
      <span class="iconify text-lg" data-icon="{{ $icon }}"></span>
    @endif
    <div>
      {{ $body }}
    </div>
  </button>
@endif
