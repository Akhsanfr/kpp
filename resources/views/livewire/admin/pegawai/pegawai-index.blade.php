<div
    class="col-span-12 grid grid-cols-12 gap-4"
>
    @if ($component === 'form')
        <h2 class="col-span-12 card bg-base-200">Form Pegawai</h2>
        <button class="btn btn-sm btn-primary col-span-3" wire:click="$emit('pegawaiFormSave')">
            Simpan data
        </button>
        <button class="btn btn-sm btn-primary btn-outline col-span-3" wire:click="switchComponent('tabel')">
            Batal
        </button>
        <livewire:admin.pegawai.pegawai-form :pegawai_id="$pegawai_id"/>
    @elseif ($component === 'tabel')
        <h2 class="col-span-12 card bg-base-200">Data Pegawai</h2>
        <button class="btn btn-sm btn-primary col-span-3" wire:click="switchComponent('form')">
            Tambah data
        </button>
        <livewire:admin.pegawai.pegawai-tabel  />
    @endif
</div>
