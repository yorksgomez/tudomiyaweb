@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-600 focus:border-indigo-300 focus:ring focus:ring-emerald-400 focus:ring-opacity-30 rounded-3xl shadow-sm text-sm py-1']) !!}>
    {{ $slot }}
</textarea>
