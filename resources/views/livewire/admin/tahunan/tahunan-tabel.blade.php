<div class="col-span-12 overflow-x-auto"
    x-data="{
        hapus(id, tahun){
            if(confirm(`Yakin ingin menghapus data ${tahun} ?`)){
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
                <th>Tahun</th>
                <th>Target</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tahunans as $tahunan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $tahunan->tahun }}</td>
                <td class="text-right">{{ number_format($tahunan->target ,5,',', '.' ) }}</td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-primary btn-xs" wire:click="edit({{ $tahunan->id }})">Edit</button>
                        <button class="btn btn-outline btn-xs" @click="hapus({{ $tahunan->id }},'{{ $tahunan->tahun }}')">
                            Hapus
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
