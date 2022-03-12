<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12">
        <span>Seksi</span>
        <select class="select select-sm select-bordered" wire:model="seksi">
            <option value="Semua">Semua Seksi</option>
            <option value="Pengawasan I">Pengawasan I</option>
            <option value="Pengawasan II">Pengawasan II</option>
            <option value="Pengawasan II">Pengawasan III</option>
            <option value="Pengawasan IV">Pengawasan IV</option>
            <option value="Pengawasan V">Pengawasan V</option>
            <option value="Pengawasan VI">Pengawasan VI</option>
        </select>
        <span>Tahun</span>
        <select class="select select-sm select-bordered" wire:model="tahun">
            @for ($i = 2020; $i <= date('Y'); $i++)
                <option value="{{$i}}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    @foreach ($bulans as $index_bulan => $bulan)
        <div class="card-title-up col-span-12 md:col-span-6 2xl:col-span-4">
            <h2>{{ $bulan }}</h2>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="table table-compact table-zebra w-full">
                        <thead class="text-center">
                            <tr>
                                <th rowspan="2">NO</th>
                                <th rowspan="2">Nama</th>
                                <th colspan="5">Pekan</th>
                            </tr>
                            <tr>
                                <th>I</th>
                                <th>II</th>
                                <th>III</th>
                                <th>IV</th>
                                <th>V</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pegawais as $pegawai)
                                <tr>
                                    <td class="sticky left-0">{{ $loop->iteration }}</td>
                                    <td>{{ $pegawai->nama }}</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            @if(is_numeric(array_search($pegawai->id."-".($index_bulan+1)."-".$i,$mingguans)))
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 bg-success rounded" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 bg-error rounded" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </td>
                                    @endfor
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Tidak ada data pegawai</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
