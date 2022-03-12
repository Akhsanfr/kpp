<div class="card-title-up">
    <h2>Capaian Netto Bruto</h2>
    <div class="p-8 flex space-x-4">
        <div>
            <h3 class="text-center font-bold mb-2">Netto</h3>
            <div class="shrink-0 radial-progress text-primary border-4 border-secondary" style="--value:{{ $netto * 100 }}; --size:7rem; --thickness: 16px;">{{ $netto*100 }}%</div>
        </div>
        <div>
            <h3 class="text-center font-bold mb-2">Bruto</h3>
            <div class="shrink-0 radial-progress text-primary border-4 border-secondary" style="--value:{{ $bruto * 100 }}; --size:7rem; --thickness: 16px;">{{ $bruto * 100 }}%</div>
        </div>
    </div>
</div>
