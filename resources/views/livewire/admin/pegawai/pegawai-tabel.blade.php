<div class="col-span-12 overflow-x-auto"
    x-data="{
        hapus(id, nama){
            if(confirm(`Yakin ingin menghapus data ${nama} ?`)){
                this.$wire.delete(id)
            }
            return ;
        }
     }"
>
    <table class="table table-compact table-zebra">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Seksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pegawais as $pegawai)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pegawai->nama }}</td>
                <td>{{ $pegawai->seksi }}</td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-primary btn-xs" wire:click="edit({{ $pegawai->id }})">Edit</button>
                        <button class="btn btn-outline btn-xs" @click="hapus({{ $pegawai->id }},'{{ $pegawai->nama }}')">
                            Hapus
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
