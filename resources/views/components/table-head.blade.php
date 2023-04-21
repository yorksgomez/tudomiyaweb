@props(['titles'])

<thead {!! $attributes->merge(['class' => 'bg-primary text-white w-full']) !!}>
    <tr>
        @foreach ($titles as $title)
            <th>{{ $title }}</th>
        @endforeach
    </tr>
</thead>