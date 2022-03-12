<div class="space-y-4">
    <h2 class="card bg-base-200">Data Lifetime</h2>
    @if ($edit_mode)
        <button class="btn btn-primary btn-sm" wire:click="update">Simpan</button>
    @else
        <button class="btn btn-primary btn-sm" wire:click="switchEdit(true)">Edit</button>
    @endif
    <table class="table table-zebra table-compact">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            @php
                $datas = [
                    ['Peringkat kpp kanwil', 'peringkat_kpp_kanwil'],
                    ['Peringkat kpp non pratama', 'peringkat_kpp_non_pratama'],
                    ['Peringkat kpp nasional', 'peringkat_kpp_nasional'],
                    ['Sektor pajak bruto terbesar 1', 'sektor_pajak_bruto_terbesar_1'],
                    ['Sektor pajak bruto terbesar 2', 'sektor_pajak_bruto_terbesar_2'],
                    ['Sektor pajak bruto terbesar 3', 'sektor_pajak_bruto_terbesar_3'],
                    ['Sektor Wajib Pajak tertinggi 1', 'sektor_wp_tertinggi_1'],
                    ['Sektor Wajib Pajak tertinggi 2', 'sektor_wp_tertinggi_2'],
                    ['Sektor Wajib Pajak tertinggi 3', 'sektor_wp_tertinggi_3'],
                    ['Sektor Wajib Pajak tertinggi 4', 'sektor_wp_tertinggi_4'],
                    ['Sektor Wajib Pajak tertinggi 5', 'sektor_wp_tertinggi_5'],
                ]
            @endphp
            @if ($edit_mode)
                @foreach ($datas as $key => $data)
                    <tr>
                        <th>{{ $key + 1}}</th>
                        <th>{{ $data[0] }}</th>
                        <th><input class="input input-sm input-bordered
                            @error("lifetime.$data[1]")
                                input-error
                            @enderror
                        " wire:model.defer="lifetime.{{ $data[1] }}"/></th>
                    </tr>
                @endforeach
            @else
                @foreach ($datas as $key => $data)
                    <tr>
                        <th>{{ $key + 1}}</th>
                        <th>{{ $data[0] }}</th>
                        <th>{{ $lifetime[$data[1]] }}</th>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
