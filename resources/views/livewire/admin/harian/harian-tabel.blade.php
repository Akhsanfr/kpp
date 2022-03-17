@push('scripts')
    <script defer>
        document.addEventListener('alpine:init', () => {
            Alpine.data('harianTabel', () => ({
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
    x-data="harianTabel"
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
            {{ $harians->links() }}
        </div>
    @endif
    <div class="overflow-x-auto">
        <table class="table table-compact table-zebra">
            <thead>
                <th> # </th>
                @if(!$edit_mode)
                    <th>Pilih</th>
                @endif
                <th> Tanggal </th>

                <th> PPN Impor </th>
                <th> PPH 25/9 </th>
                <th> PPH 22 Impor </th>

                <th> PPH 21 </th>
                <th> PPH PPNDN </th>
                <th> PPH 23 </th>

                <th> PPH 22 </th>
                @if (!$edit_mode)
                    <th> Bruto </th>
                @endif
                <th> Netto </th>
            </thead>
            <tbody>
                @if ($edit_mode)
                    @foreach ($edit_data as $index => $data)
                        <tr>
                            <td class="sticky left-0">{{ $loop->iteration }}</td>
                            <td> {{ $data->tanggal }}
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.ppn_impor")
                                    input-error
                                @enderror"
                                type="text" wire:model.defer="edit_data.{{ $index }}.ppn_impor">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.pph_25_9")
                                    input-error
                                @enderror" type="text" wire:model.defer="edit_data.{{ $index }}.pph_25_9">
                            </td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.pph_22_impor")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.pph_22_impor"></td>

                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.pph_21")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.pph_21"></td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.pph_ppndn")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.pph_ppndn"></td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.pph_23")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.pph_23"></td>

                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.pph_22")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.pph_22"></td>
                            <td>
                                <input class="input input-sm input-ghost
                                @error("edit_data.$index.netto")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.netto"></td>
                            <td>
                                {{-- <input class="input input-sm input-ghost
                                @error("edit_data.$index.bruto")
                                    input-error
                                @enderror"
                                 type="text" wire:model.defer="edit_data.{{ $index }}.bruto"></td> --}}

                        </tr>
                    @endforeach
                @else
                    @forelse ($harians as $harian)
                        <tr>
                            <td class="sticky left-0">{{ $harians->firstItem() + $loop->index }}</td>
                            <td>
                                <input type="checkbox" class="checkbox check" value="{{ $harian->id }},{{ $harian->tanggal }}">
                            </td>
                            <td>{{ $harian->tanggal }}</td>

                            <td>{{ number_format($harian->ppn_impor,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($harian->pph_25_9,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($harian->pph_22_impor,$decimal,',', '.' ) }}</td>

                            <td>{{ number_format($harian->pph_21,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($harian->pph_ppndn,$decimal,',', '.' ) }}</td>
                            <td>{{ number_format($harian->pph_23,$decimal,',', '.' ) }}</td>

                            <td>{{ number_format($harian->pph_22,$decimal,',', '.' ) }}</td>
                            @php
                                $bruto = bcadd($harian->ppn_impor,
                                            bcadd($harian->pph_25_9,
                                                bcadd($harian->pph_22_impor,
                                                    bcadd($harian->pph_21,
                                                        bcadd($harian->pph_ppndn,
                                                            bcadd($harian->pph_23,
                                                                $harian->pph_22
                                                            )
                                                        )
                                                    )
                                                )
                                            )
                                        );
                            @endphp
                            <td>{{ number_format($bruto, $decimal,',', '.') }}</td>
                            <td>{{ number_format($harian->netto, $decimal,',', '.') }}</td>

                        </tr>
                    @empty
                        <tr colspan="11">
                            <td>Data tidak tersedia</td>
                        </tr>
                    @endforelse
                @endif
            </tbody>
        </table>
    </div>
    @if (!$edit_mode)
        <div>
            {{ $harians->links() }}
        </div>
    @endif
</section>


