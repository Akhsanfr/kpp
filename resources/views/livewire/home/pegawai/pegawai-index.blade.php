@push('sidebar_home')
    <livewire:home.pegawai.pegawai-filter />
@endpush
@push('scripts')
    <script>
        window.addEventListener('chart-pegawai', event => {
            // get data from livewire...
            data = event.detail;
            console.log("data : ",data);

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

    </script>
@endpush

<section class="w-full grid grid-cols-12 gap-4 content-start">

    {{-- <div id="chart_div" class="bg-primary"></div> --}}

    <div class="card bg-base-300 p-4 col-span-12">
        SP2DK dan LHP2DK
    </div>

    {{-- <x-chart id='sp2dk' judul="SP2DK" col="4"></x-chart>
    <x-chart id="lhp2dk" judul="LHP2DK" col="4"></x-chart>
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

