@props(['active'])

<ul class="space-y-2">
    <li class="card p-4 cursor-pointer hover:bg-secondary {{ $active == 'penerimaan' ? 'bg-secondary' : 'bg-base-300' }}">
        <a href="#"> Penerimaan Harian </a>
    </li>
    <li class="card bg-base-300 p-4 cursor-pointer hover:bg-secondary">
        <a href="#"> Peneriman Pegawai </a>
    </li>
    <li>{{ $active }}</li>
</ul>
