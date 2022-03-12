<div class="card-title-up col-span-3">
    <h2>Capaian Netto <small class="badge badge-secondary">Tahunan</small></h2>
    <div class="p-4">
        @if ($netto)
            <div class="radial-progress text-primary border-4 border-secondary" style="--value:{{ $netto * 100 }}; --size:7rem; --thickness: 16px;">{{ number_format($netto*100, 2, ',', '.')}} %</div>
        @else
            <p class="text-xs leading-3">Error! Data target bernilai 0</p>
        @endif
    </div>
</div>
