<div class="grid grid-cols-12 gap-4">
   @if ($component === 'form')
        <h2 class="col-span-12 card bg-base-200">Form tahunan</h2>
        <button class="btn btn-sm btn-primary col-span-3" wire:click="$emit('tahunanFormSave')">
            Simpan data
        </button>
        <button class="btn btn-sm btn-primary btn-outline col-span-3" wire:click="switchComponent('tabel')">
            Batal
        </button>
        <livewire:admin.tahunan.tahunan-form :tahunan_id="$tahunan_id"/>
        @elseif ($component === 'tabel')
        <h2 class="col-span-12 card bg-base-200">Data tahunan</h2>
        <button class="btn btn-sm btn-primary col-span-3" wire:click="switchComponent('form')">
            Tambah data
        </button>
        <livewire:admin.tahunan.tahunan-tabel  />
    @endif
</div>
