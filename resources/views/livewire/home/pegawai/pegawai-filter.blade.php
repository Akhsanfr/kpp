<div class="grid grid-cols-10 gap-4" wire:init="getData">
    <select class="select select-sm select-bordered col-span-5" wire:model="bulan">
            @foreach ($bulans as $key => $bln)
                <option value="{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}">{{ $bln }}</option>
            @endforeach
    </select>
    <select class="select select-sm select-bordered col-span-5" wire:model="tahun">
        @for ($i = 2020; $i <= date('Y'); $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
    @for ($i = 1; $i <= 5 ; $i++)
        <label for="label-pekan-{{ $i }}" class="btn btn-sm col-span-2 {{ $pekans[$i - 1] ? 'btn-secondary'  : '' }}">{{ $i }}</label>
        <input class="hidden" id="label-pekan-{{ $i }}" type="checkbox" wire:model="pekans.{{ $i - 1  }}"/>
        @endfor
    @for ($s = 1; $s <= 6; $s++)
        <label class="col-span-10 label cursor-pointer border border-secondary rounded-lg">
            <span class="label-text">Seksi {{ $daftar_seksi[$s-1] }}</span>
            <input type="checkbox" class="checkbox checkbox-secondary" wire:model="seksis.{{ $s - 1  }}">
        </label>
    @endfor
    <span class="col-span-10">Urutkan data berdasarkan : </span>
    <select class="select select-sm select-bordered col-span-5" id="filter" onchange="filter(event.target.value)">
        <option value="nama">Nama</option>
        @foreach ($koloms as $kolom)
        <option value="{{ $kolom[0] }}">{{ $kolom[1] }}</option>
        @endforeach
    </select>
    <select class="select select-sm select-bordered col-span-5" id="filter-asc" onchange="filterAsc(event.target.value)">
        <option value="naik">Naik (A-Z)</option>
        <option value="turun">Turun (Z-A)</option>
    </select>
</div>
