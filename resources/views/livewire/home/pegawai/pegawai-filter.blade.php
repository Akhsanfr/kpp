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
</div>
