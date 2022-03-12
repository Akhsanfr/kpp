<div class="card-title-up col-span-6">
    <h2>Sektor Pajak Terbesar  <small class="badge badge-accent">Selamanya</small></h2>
    <div class="p-4">
        @if (is_null($lifetime))
            <div>Loading...</div>
        @else
            <ul class="list-decimal ml-4">
                <li>{{ $lifetime->sektor_wp_tertinggi_1 }}</li>
                <li>{{ $lifetime->sektor_wp_tertinggi_2 }}</li>
                <li>{{ $lifetime->sektor_wp_tertinggi_3 }}</li>
                <li>{{ $lifetime->sektor_wp_tertinggi_4 }}</li>
                <li>{{ $lifetime->sektor_wp_tertinggi_5 }}</li>
            </ul>
        @endif
    </div>
</div>

