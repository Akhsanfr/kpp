@props(['id', 'judul', 'col'])

<div {{ $attributes->merge(['class' => 'card bg-base-200 col-span-'.$col]) }}>
    <div class="bg-primary text-base-100 font-bold text-center p-2">{{ $judul }}</div>
    <div id="{{ $id }}"></div>
</div>
