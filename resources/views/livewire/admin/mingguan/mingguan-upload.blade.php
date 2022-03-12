<div x-data="{
    namaFile : '',
    pegawai_id : 0,
    unggah(){
        if(this.namaFile == ''){
            this.$dispatch('pesan', {
                isi     : ['Pilih berkas terlebih dahulu!'],
                tipe    : 'warning'
            });
        } else if(this.pegawai_id === 0){
            this.$dispatch('pesan', {
                isi     : ['Pilih pegawai terlebih dahulu!'],
                tipe    : 'warning'
            });
        } else {
            this.$wire.unggah(this.pegawai_id)
        }
    },
}"
@reset.window="namaFile = ''"
class="col-span-8 "
>
    <div class="flex flex-row items-center gap-x-4">
        <input id="file-mingguan" type="file" wire:model.defer="file" class="hidden" @change="namaFile = $event.target.files[0].name">
        <label for="file-mingguan" class="btn btn-sm btn-primary">Pilih berkas</label>
        <select x-model="pegawai_id" class="select select-bordered select-sm">
            <option value="0" disabled>Pilih data pegawai</option>
            @forelse ($pegawais as $pegawai)
            <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
            @empty
            <option>No data avalilable</option>
            @endforelse
        </select>
        <button @click="unggah" type="submit" class="btn btn-sm btn-secondary whitespace-nowrap">Unggah Data</button>
    </div>
    <span x-text="namaFile"></span>
</div>
