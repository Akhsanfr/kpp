<div class="col-span-6 col-start-1">
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text">Tahun</span>
        </label>
        <select
            class="select select-sm select-bordered
            @error('tahunan.tahun')
                select-error
            @enderror"
            wire:model.defer="tahunan.tahun"
        >
            <option value="null" disabled>Pilih tahun</option>
            @for ($i = 2020; $i <= date('Y'); $i++)
                <option value="{{ $i }}">{{$i}}</option>
            @endfor
        </select>
        @error('tahunan.tahun')
            <span class="text-error text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text">Target</span>
        </label>
        <input
            type="text"
            class="input input-bordered input-sm w-full
            @error('tahunan.target')
                input-error
            @enderror "
            wire:model.defer="tahunan.target"
        />
        @error('tahunan.target')
            <span class="text-error text-sm">{{ $message }}</span>
        @enderror
    </div>
</div>
