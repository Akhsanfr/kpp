<section class="col-span-2 grid grid-cols-2 gap-4" wire:init="init">

    <div wire:loading.delay col-span-2>
        Loading ...
    </div>
    <select class="select select-sm select-bordered" wire:model="bulan">
        @foreach ($kalender['bulan'] as $key => $bln)
            <option value="{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}">{{ $bln }}</option>
        @endforeach
    </select>
    <select class="select select-sm select-bordered" wire:model="tahun">
        @for ($i = 2020; $i <= date('Y'); $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
    <button class="col-span-2 btn btn-primary btn-sm" wire:click="resetTanggal">Reset tanggal</button>
    <div class="col-span-2 cal grid grid-cols-7 relative">
        <span class="cal-title">M</span>
        <span class="cal-title">S</span>
        <span class="cal-title">S</span>
        <span class="cal-title">R</span>
        <span class="cal-title">K</span>
        <span class="cal-title">J</span>
        <span class="cal-title">S</span>

        @for ($i = 0; $i < $kalender['hari_pertama']; $i++)
            <span class="cal-none">-</span>
        @endfor

        @foreach ($kalender['tanggal'] as $tanggal)
            <span
                class="cal-clickable {{
                    $tanggal >= $tanggal_awal && $tanggal <= $tanggal_akhir
                        ? 'cal-aktif'
                        : 'cal-body'
                }}"
                wire:click="pilihTanggal({{ $tanggal }})"
                >{{ $tanggal }}</span
            >
        @endforeach

        @for ($i = 0; $i < 7 - $kalender['hari_pertama_bulan_berikutnya']; $i++)
            <span class="cal-none">-</span>
        @endfor

        @if($kalender['hari_pertama'] + count($kalender['tanggal']) < 35)
            @for ($i = 0; $i < 7 ; $i++)
                <span class="cal-none">-</span>
            @endfor
        @endif
    </div>

    <div class="col-span-2 bg-info text-white rounded-sm p-2">Filter Harian : {{ "($tanggal_awal - $tanggal_akhir) - $bulan - $tahun" }}</div>
    <div class="col-span-2 bg-secondary text-white rounded-sm p-2">Filter Tahunan : {{ $tahun }}</div>
    <div class="col-span-2 bg-accent text-white rounded-sm p-2">Tidak terfilter</div>

</section>
