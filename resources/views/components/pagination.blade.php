<div class="flex flex-col space-y-2">
    {{-- INFO --}}
    <p>Menampilkan {{ $pagination['row_awal'] }} sampai {{$pagination['row_akhir'] }} baris data dari {{ $pagination['jumlah_row'] }} baris data</p>
    {{-- SEARCH --}}
    <div class="flex flex-row items-center">
        <label for="search">Cari data :</label>
        <input id="search" type="text" class="input input-sm input-bordered" wire:model.debounce.500ms="s">
    </div>
    {{-- LIMIT --}}
    <div class="flex flex-row items-center">
        <label for="set-limit">Limit data per halaman : </label>
        <select id="set-limit" wire:model="l"  class="select select-sm select-bordered w-24">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="500">500</option>
            <option value="1000">1000</option>
        </select>
    </div>
    {{-- PAGE --}}
    <div class="btn-group">
        <button wire:click="setPage({{ $pagination['page']-1 }})" class="btn btn-sm btn-secondary
        @if ($pagination['page'] === 1)
            btn-disabled
        @endif
        ">Previous</button>
        {{-- min --}}
        @if($pagination['page'] >= 2)
            <button wire:click="setPage(1)" class="btn btn-sm btn-secondary">1</button>
        @endif
        {{-- min + 1 --}}
        @if($pagination['page'] >= 3)
            <button wire:click="setPage(2)" class="btn btn-sm btn-secondary">2</button>
        @endif

        @if($pagination['page'] >= 5)
            <button class="btn btn-sm btn-secondary btn-disabled">...</button>
        @endif

        {{-- -1 --}}
        @if ($pagination['page'] >= 4)
            <button wire:click="setPage({{ $pagination['page'] - 1 }})" class="btn btn-sm btn-secondary">{{ $pagination['page'] - 1 }}</button>
        @endif

        <button wire:click="setPage({{ $pagination['page']}})" class="btn btn-sm btn-primary">{{ $pagination['page'] }}</button>

        {{-- +1 --}}
        @if ($pagination['page'] <= ($pagination['jumlah_page'] - 3))
            <button wire:click="setPage({{ $pagination['page'] + 1 }})" class="btn btn-sm btn-secondary">{{ $pagination['page'] + 1 }}</button>
        @endif

        {{-- dot --}}
        @if ($pagination['page'] <= ($pagination['jumlah_page'] - 4))
            <button class="btn btn-sm btn-secondary">...</button>
        @endif
        {{-- max -1 --}}
        @if ($pagination['page'] <= ($pagination['jumlah_page'] - 2))
            <button wire:click="setPage({{ $pagination['jumlah_page'] - 1 }})" class="btn btn-sm btn-secondary">{{ $pagination['jumlah_page'] - 1 }}</button>
        @endif
        {{-- max --}}
        @if($pagination['page'] <= $pagination['jumlah_page'] - 1)
            <button wire:click="setPage({{ $pagination['jumlah_page'] }})" class="btn btn-sm btn-secondary">{{ $pagination['jumlah_page'] }}</button>
        @endif

        <button wire:click="setPage({{ $pagination['page'] + 1 }})" class="btn btn-sm btn-secondary
        @if ($pagination['page'] === $pagination['jumlah_page'])
            btn-disabled
        @endif
        ">Next</button>
    </div>
</div>
