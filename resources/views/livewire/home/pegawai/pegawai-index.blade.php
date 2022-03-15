@php
    // List kolom/field dan human readable-nya
    $koloms = [
        ['sp2dk_target', 'SP2DK Target'],
        ['sp2dk_jumlah', 'SP2DK Jumlah'],
        ['lhp2dk_target', 'LHP2DK Target'],
        ['lhp2dk_jumlah', 'LHP2DK Jumlah'],
        ['lp2dk_realisasi_rupiah', 'LHP2DK Realisasi Rupiah'],
        ['lhpt_target', 'LHPT Target'],
        ['lhpt_jumlah', 'LHPT Jumlah'],
        ['sp2dk_terbit_target', 'SP2DK Terbit Target'],
        ['sp2dk_terbit_jumlah', 'SP2DK Terbit Jumlah'],
        ['lhpt_lhp2dk_target', 'LHPT LHP2DK Target'],
        ['lhpt_lhp2dk_jumlah', 'LHPT LHP2DK Jumlah'],
        ['lhp2dk_realisasi_rupiah', 'LHP2DK Realisasi Rupiah'],
        ['stp_terbit_target', 'STP Terbit Target'],
        ['stp_terbit_jumlah', 'STP Terbit Jumlah'],
        ['stp_terbit_rupiah', 'STP Terbit Rupiah']
    ]
@endphp
@push('sidebar_home')
    {{-- Filter BackEnd / GET Data dari database , note : menu sort data filter FrontEnd ada di bagian ini --}}
    <livewire:home.pegawai.pegawai-filter :koloms="$koloms" />
@endpush
@push('scripts')
    {{-- Filter FrontEnd --}}
    <script>

        // Data dari BE
        let data_mentah = [];
        window.addEventListener('chartPegawai', event => {
            // ubah data obj ke arr agar bisa disort
            data_mentah = [];
            for(let nama in event.detail){
                let v = {...event.detail[nama]}
                data_mentah.push(v);
            }
            setUI();
        })

        // Type Sort
        let asc_sort = localStorage.getItem('asc_sort') ?? 'naik';
        let kolom_sort = localStorage.getItem('sort') ?? 'nama';
        document.getElementById('filter').value = kolom_sort;
        document.getElementById('filter-asc').value = asc_sort;

        // Daftar koloms dalam array javascript
        const koloms = [
            @foreach ($koloms as $kolom)
            ['{{ $kolom[0] }}','{{ $kolom[1] }}'],
            @endforeach
        ];

        // Fungsi filter dan sort data
            function sortData(){
                let hasil = [];
                if(asc_sort === 'naik'){
                    hasil = data_mentah.sort((a, b)=>{
                        if(a[kolom_sort] < b[kolom_sort]){
                            return -1;
                        } else if (a[kolom_sort] > b[kolom_sort]) {
                            return 1;
                        } else {
                            return 0;
                        }
                    });
                } else {
                    hasil = data_mentah.sort((a, b)=>{
                        if(a[kolom_sort] > b[kolom_sort]){
                            return -1;
                        } else if (a[kolom_sort] < b[kolom_sort]) {
                            return 1;
                        } else {
                            return 0;
                        }
                    });
                }
                return hasil;
            }
            function filter(e){
                kolom_sort = e;
                setUI();
                localStorage.setItem('sort', e);
            }
            function filterAsc(e){
                asc_sort = e
                setUI();
                localStorage.setItem('asc_sort', e);
            }
        // End Fungsi filter dan sort data

        function setUI(){
            // Susunan data dalam chart
            const charts = [
                ['chart-sp2dk', [1, 2]],
                ['chart-lhp2dk', [3, 4]],
                ['chart-lp2dk-realisasi-rupiah', [5]],
                ['chart-lhpt',[6,7]],
                ['chart-sp2dk-terbit',[8,9]],
                ['chart-lhpt-lhp2dk',[10,11]],
                ['chart-lhp2dk-realisasi',[12]],
                ['chart-stp-terbit',[13, 14]],
                ['chart-stp-terbit-rupiah',[15]],
            ];

            // Data yang telah disortir
            const data_sorted = sortData(data_mentah);

            // Label (nama) dari kumpulan data
            let labels = [];
            data_sorted.forEach(v => {
                // Ambil nama pegawai untuk setiap data pegawai
                labels.push(v.nama)
            })

            // set chart
            charts.forEach(chart => {
                // set datasets
                let data = [];
                // set legenda
                let legends = [];

                chart[1].forEach( kolom => {
                    let data_perkolom = []
                    data_sorted.forEach(pegawai => {
                        const field = koloms[kolom - 1][0]
                        data_perkolom.push(pegawai[field])
                    });

                    data.push(data_perkolom)
                    legends.push(koloms[kolom - 1][1])
                })

                setChart({   type : 'bar',
                    axis : 'y',
                    id : chart[0],
                    interaction: true,
                    data,
                    labels,
                    legends,
                });
            })
        }
    </script>
@endpush

<section
    class="w-full grid grid-cols-12 gap-4 content-start"
    >

    <div class="card bg-base-300 p-4 col-span-12">
        SP2DK dan LHP2DK
    </div>

    <x-chart id='chart-sp2dk' judul="SP2DK" col="col-span-4"/>
    <x-chart id='chart-lhp2dk' judul="LHP2DK" col="col-span-4" />
    <x-chart id='chart-lp2dk-realisasi-rupiah' judul="Realisasi" col="col-span-4" />

    <div class="card bg-base-300 p-4 col-span-12">
        SP2DK dan LHP2DK
    </div>

    <x-chart id="chart-lhpt" judul="LHPT" col="col-span-3"></x-chart>
    <x-chart id="chart-sp2dk-terbit" judul="SP2DK Terbit" col="col-span-3"></x-chart>
    <x-chart id="chart-lhpt-lhp2dk" judul="LHPT LHP2DK" col="col-span-3"></x-chart>
    <x-chart id="chart-lhp2dk-realisasi" judul="LHP2DK Realisasi" col="col-span-3"></x-chart>

    <div class="card bg-base-300 p-4 col-span-12">
        STP
    </div>

    <x-chart id="chart-stp-terbit" judul="STP Terbit" col="col-span-6"></x-chart>
    <x-chart id="chart-stp-terbit-rupiah" judul="STP Rupiah" col="col-span-6"></x-chart>
</section>

