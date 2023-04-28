<input
  {{ $attributes->merge([
    'class' => "rounded h-10 px-2 w-full
                focus:border-blue-500 focus:border-2 focus:ring-0
                border-black border-opacity-20 border-1
                dark:border-white dark:border-opacity-20 dark:border-1
                bg-black bg-opacity-0
                dark:bg-white dark:bg-opacity-5",
    'type' => 'text'
  ]) }}
>
