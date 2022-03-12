@push('scripts')
    <script defer>
        document.addEventListener('alpine:init', () => {
            Alpine.data('mingguanTabel', () => ({
                hapus(){
                    const el = document.getElementsByClassName('check');
                    let id = [];
                    let tanggal = [];
                    for(e of el){
                        if(e.checked){
                            val = e.value.split(",");
                            id.push(Number(val[0]));
                            tanggal.push(` '${val[1]}'`)
                        }
                    }
                    if(id.length === 0){
                        alert("Pilih data yang hendak dihapus terlebih dahulu!");
                        return;
                    }
                    if(confirm(`Yakin ingin menghapus data dengan tanggal ${tanggal}?`)){
                        this.$wire.hapus(id);
                    }
                },
                edit(){
                    const el = document.getElementsByClassName('check');
                    let id = [];
                    for(e of el){
                        if(e.checked){
                            val = e.value.split(",");
                            id.push(Number(val[0]));
                        }
                    }
                    if(id.length === 0){
                        alert("Pilih data yang hendak diubah terlebih dahulu!")
                        return;
                    }
                    this.$wire.edit(id);
                },
                edit_simpan(){
                    this.$wire.edit_simpan();
                },
                hapusAll(){
                    if(confirm(`Yakin ingin menghapus semua data?`)){
                        this.$wire.hapusAll();
                    }
                }
            }))
        })

    </script>
@endpush

<section
    x-data="mingguanTabel"
    class="col-span-12 space-y-4"
    >

    <div class="space-x-4">
        @if ($edit_mode)
            <button @click="edit_simpan()" class="btn btn-sm btn-primary">Simpan perubahan</button>
        @else
            <button @click="edit()" class="btn btn-sm btn-primary">Ubah</button>
            <button @click="hapus()" class="btn btn-sm btn-error">Hapus</button>
            <button @click="hapusAll()" class="btn btn-sm btn-error">Hapus semua data</button>
        @endif
    </div>

    @if (!$edit_mode)
        <div class="flex flex-row space-x-2 items-center">
            <input class="input input-bordered input-sm" wire:model="search" type="search" placeholder="Cari data..."/>
            <span>Data per halaman</span>
            <select class="select select-sm select-bordered" wire:model="paginate">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span>Tampilan digit desimal</span>
            <select class="select select-sm select-bordered" wire:model="decimal">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
    @endif

    @if (!$edit_mode)
        <div>
            {{ $mingguans->links() }}
        </div>
    @endif
    <div class="overflow-x-auto">
        <table class="table table-compact table-zebra">
            <thead>
                <th> # </th>
                @if(!$edit_mode)
                    <th>Pilih</th>
                @endif
                <th> Tahun </th>
                <th> Bulan </th>
                <th> Pekan </th>
                <th> Pegawai </th>
                <th> SP2DK Target </th>
                <th> SP2DK Jumlah </th>
                <th> LHP2DK Target </th>
                <th> LHP2DK Jumlah </th>
                <th> LP2DK Realisasi Rupiah </th>
                <th> LHPT Target </th>
                <th> LHPT Jumlah </th>
                <th> SP2DK Terbit Target </th>
                <th> SP2DK Terbit Jumlah </th>
                <th> LHPT LHP2DK Target </th>
                <th> LHPT LHP2DK Jumlah </th>
                <th> LHP2DK Realisasi Rupiah </th>
                <th> STP Terbit Target </th>
                <th> STP Terbit Jumlah </th>
                <th> STP Terbit Rupiah </th>
            </thead>
            <tbody>
                @if ($edit_mode)
                    @foreach ($edit_data as $index => $data)
                        <tr>
                            <td class="sticky left-0">{{ $loop->iteration }}</td>
                            <td> {{ $data->tahun}}</td>
                            <td> {{ $data->bulan}}</td>
                            <td> {{ $data->pekan}}</td>
                            <td> {{ $data->pegawai->nama }} - {{ $data->pegawai->seksi }}</td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.sp2dk_target")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.sp2dk_target">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.sp2dk_jumlah")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.sp2dk_jumlah">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.lhp2dk_target")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.lhp2dk_target">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.lhp2dk_jumlah")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.lhp2dk_jumlah">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.lp2dk_realisasi_rupiah")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.lp2dk_realisasi_rupiah">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.lhpt_target")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.lhpt_target">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.lhpt_jumlah")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.lhpt_jumlah">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.sp2dk_terbit_target")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.sp2dk_terbit_target">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.sp2dk_terbit_jumlah")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.sp2dk_terbit_jumlah">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.lhpt_lhp2dk_target")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.lhpt_lhp2dk_target">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.lhpt_lhp2dk_jumlah")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.lhpt_lhp2dk_jumlah">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.lhp2dk_realisasi_rupiah")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.lhp2dk_realisasi_rupiah">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.stp_terbit_target")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.stp_terbit_target">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.stp_terbit_jumlah")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.stp_terbit_jumlah">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.stp_terbit_rupiah")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.stp_terbit_rupiah">
                            </td>
                        </tr>
                    @endforeach
                @else
                    @forelse ($mingguans as $mingguan)
                        <tr>
                            <td class="sticky left-0">{{ $mingguans->firstItem() + $loop->index }}</td>
                            <td>
                                <input type="checkbox" class="checkbox check" value="{{ $mingguan->id }},{{ $mingguan->tahun }}">
                            </td>
                            <td>{{ $mingguan->tahun }}</td>
                            <td>{{ $mingguan->bulan }}</td>
                            <td>{{ $mingguan->pekan }}</td>
                            <td>{{ $mingguan->pegawai->nama }} - {{ $mingguan->pegawai->seksi }}</td>
                            <td>{{ number_format($mingguan->sp2dk_target,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($mingguan->sp2dk_jumlah,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($mingguan->lhp2dk_target,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($mingguan->lhp2dk_jumlah,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($mingguan->lp2dk_realisasi_rupiah,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($mingguan->lhpt_target,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($mingguan->lhpt_jumlah,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($mingguan->sp2dk_terbit_target,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($mingguan->sp2dk_terbit_jumlah,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($mingguan->lhpt_lhp2dk_target,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($mingguan->lhpt_lhp2dk_jumlah,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($mingguan->lhp2dk_realisasi_rupiah,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($mingguan->stp_terbit_target,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($mingguan->stp_terbit_jumlah,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($mingguan->stp_terbit_rupiah,$decimal,',', '.' ) }}</td>

                        </tr>
                    @empty
                        <tr colspan="11">
                            <td class="sticky left-0">Data tidak tersedia</td>
                        </tr>
                    @endforelse
                @endif
            </tbody>
        </table>
    </div>
    @if (!$edit_mode)
        <div>
            {{ $mingguans->links() }}
        </div>
    @endif
</section>
