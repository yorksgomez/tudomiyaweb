@props(['id' => md5(Illuminate\Support\Str::random(8))])

<div class="flex">
    <input type="radio" id="{{ $id }}" {!! $attributes->merge(['class' => 'rounded-full border-gray-300 text-emerald-600 shadow-sm focus:border-emeral-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 mr-2']) !!}>
    <label for="{{ $id }}" class="leading-4">{{ $slot }}</label>
</div>