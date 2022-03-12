<div x-data="{
    namaFile : '',
    unggah(){
        if(this.namaFile == ''){
            this.$dispatch('pesan', {
                isi     : ['Pilih berkas terlebih dahulu!'],
                tipe    : 'warning'
            });
        } else {
            this.$wire.unggah()
        }
    },
}"
@reset.window="namaFile = ''"
class="col-span-8 "
>
    <div class="flex flex-row items-center gap-x-4">
        <input id="file-harian" type="file" wire:model.defer="file" class="hidden" @change="namaFile = $event.target.files[0].name">
        <label for="file-harian" class="btn btn-sm btn-primary">Pilih berkas</label>
        <button @click="unggah" type="submit" class="btn btn-sm btn-secondary whitespace-nowrap">Unggah Data</button>
    </div>
    <span x-text="namaFile"></span>
</div>
