@props(['id', 'judul', 'col'])
<div {{ $attributes->merge(['class' => 'card-title-up '.$col]) }}>
    <h2>{{ $judul }}</h2>
    <div id="{{ $id }}"></div>
</div>
