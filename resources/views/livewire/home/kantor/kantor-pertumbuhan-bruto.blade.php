<div class="card-title-up col-span-3">
    <h2>Pertumbuhan Bruto <small class="badge badge-info">Harian</small></h2>
    <div class="p-4">
        @if ($bruto)
            <div class="radial-progress text-primary border-4 border-secondary" style="--value:{{ $bruto * 100 }}; --size:7rem; --thickness: 16px;">{{ number_format($bruto*100, 2, ',', '.')}} %</div>
        @else
            <p class="text-xs leading-3">Error! Data tahun sebelumnya bernilai 0</p>
        @endif
    </div>
</div>
