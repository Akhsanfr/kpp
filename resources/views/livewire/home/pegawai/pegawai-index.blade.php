@push('sidebar_home')
    <livewire:home.pegawai.pegawai-filter />
@endpush
@push('scripts')
    <script>
        let data;
        function setSp2dk(){
           setChart({   type : 'bar',
                    axis : 'y',
                    id : 'chart-sp2dk',
                    data_1 : event.detail.sp2dk_target,
                    label_1 : 'Target',
                    data_2 : event.detail.sp2dk_jumlah,
                    label_2 : 'Jumlah',
                    interaction: true,
            });
        }
        window.addEventListener('chart-pegawai', event => {
            // get data from livewire...
            data = event.detail;
            setSp2dk();
            console.log("data : ",data);
            // setChart({   type : 'bar',
            //         axis : 'y',
            //         id : 'chart-sp2dk',
            //         data_1 : event.detail.sp2dk_target,
            //         label_1 : 'Target',
            //         data_2 : event.detail.sp2dk_jumlah,
            //         label_2 : 'Jumlah',
            //         interaction: true,
            //         // barThickness : 15
            // });
            // setChart({   type : 'bar',
            //         axis : 'y',
            //         id : 'chart-lhp2dk',
            //         data_1 : event.detail.lhp2dk_target,
            //         label_1 : 'Target',
            //         data_2 : event.detail.lhp2dk_jumlah,
            //         label_2 : 'Jumlah',
            //         // barThickness : 15
            // });
            // setChart({  type : 'bar',
            //         axis : 'y',
            //         id : 'chart-lp2dk-realisasi-rupiah',
            //         data_1 : event.detail.lp2dk_realisasi_rupiah,
            //         label_1 : 'Realisasi LP2DK',
            //         // barThickness : 15
            // });

            // setChart('bar','y','sp2dk', data.sp2dk_target, 'Target', data.sp2dk_jumlah, 'Realisasi')
            // setChart('bar','y','lhp2dk', data.lhp2dk_target, 'Target', data.lhp2dk_jumlah, 'Realisasi')
            // setChart('bar','y','realisasi', data.lp2dk_realisasi_rupiah, 'Realisasi')

            // setChart('bar','y','lhpt', data.lhpt_target, 'Target', data.lhpt_jumlah, 'Realisasi')
            // setChart('bar','y','sp2dk_terbit', data.sp2dk_terbit_target, 'Target', data.sp2dk_terbit_jumlah, 'Realisasi')
            // setChart('bar','y','lhpt_lhp2dk', data.lhpt_lhp2dk_target, 'Target', data.lhpt_lhp2dk_jumlah, 'Realisasi')
            // setChart('bar','y','lhp2dk_realisasi', data.lhp2dk_realisasi_rupiah, 'Realisasi')

            // setChart('bar','y','stp_terbit', data.stp_terbit_target, 'Target', data.stp_terbit_jumlah, 'Realisasi')
            // setChart('bar','y','stp_terbit_rupiah', data.stp_terbit_rupiah, 'Realisasi')

        })

        // d = {
        //     type : 'bar',
        //     axis : 'y',
        //     id : 'chart-sp2dk',
        //     data_1 : data.sp2dk_target,
        //     label_1 : 'Target',
        //     data_2 : data.sp2dk_jumlah,
        //     label_2 : 'Jumlah',
        //     interaction: true,
        //     // barThickness : 15
        // }
        // setChart(d);
        console.log(data);
    </script>
@endpush

<section class="w-full grid grid-cols-12 gap-4 content-start">

    {{-- <div id="chart_div" class="bg-primary"></div> --}}

    <div class="card bg-base-300 p-4 col-span-12">
        SP2DK dan LHP2DK
    </div>
    {{-- <div class="card-title-up col-span-6 ">
        <h2>Penerimaan per Jenis Pajak <small class="badge badge-info">Harian</small></h2>
        <div id="chart-sp2dk-jumlah"></div>
    </div> --}}

    <x-chart id='chart-sp2dk' judul="SP2DK" col="col-span-4"/>
    <x-chart id='chart-lhp2dk' judul="LHP2DK" col="col-span-4" />
    <x-chart id='chart-lp2dk-realisasi-rupiah' judul="Realisasi" col="col-span-4" />
    {{-- <x-chart id="lhp2dk" judul="LHP2DK" col="4"></x-chart>
    <x-chart id="realisasi" judul="Realisasi" col="4"></x-chart> --}}

    <div class="card bg-base-300 p-4 col-span-12">
        SP2DK dan LHP2DK
    </div>

    {{-- <x-chart id="lhpt" judul="LHPT" col="3"></x-chart>
    <x-chart id="sp2dk_terbit" judul="SP2DK Terbit" col="3"></x-chart>
    <x-chart id="lhpt_lhp2dk" judul="LHPT LHP2DK" col="3"></x-chart>
    <x-chart id="lhp2dk_realisasi" judul="LHP2DK Realisasi" col="3"></x-chart> --}}

    <div class="card bg-base-300 p-4 col-span-12">
        STP
    </div>
{{--
    <x-chart id="stp_terbit" judul="STP Terbit" col="6"></x-chart>
    <x-chart id="stp_terbit_rupiah" judul="STP Rupiah" col="6"></x-chart> --}}
</section>

