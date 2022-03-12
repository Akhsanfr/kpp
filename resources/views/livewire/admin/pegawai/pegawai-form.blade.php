<div class="col-span-6 col-start-1">
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text">Nama Pegawai</span>
        </label>
        <input
            type="text"
            class="input input-bordered input-sm w-full
            @error('pegawai.nama')
                input-error
            @enderror "
            wire:model.defer="pegawai.nama"
        />
        @error('pegawai.nama')
            <span class="text-error text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text">Seksi</span>
        </label>
        <select
            class="select select-sm select-bordered
            @error('pegawai.seksi')
                select-error
            @enderror"
            wire:model.defer="pegawai.seksi"
        >
            <option value="null" disabled>Pilih seksi</option>
            <option value="Pengawasan I">Pengawasan I</option>
            <option value="Pengawasan II">Pengawasan II</option>
            <option value="Pengawasan III">Pengawasan III</option>
            <option value="Pengawasan IV">Pengawasan IV</option>
            <option value="Pengawasan V">Pengawasan V</option>
            <option value="Pengawasan VI">Pengawasan VI</option>
        </select>
        @error('pegawai.seksi')
            <span class="text-error text-sm">{{ $message }}</span>
        @enderror
    </div>
</div>
