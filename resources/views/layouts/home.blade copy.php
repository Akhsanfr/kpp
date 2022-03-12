@extends('layouts.main')
@push('chart')
    <script src="{{ mix('js/chart.js') }}"></script>
    <script>
        // function setChart(type,axis, id, data_1, label_1, data_2 = false, label_2 = ''){
        function setChart(
                {   type,
                    axis,
                    id,
                    data_1,
                    label_1,
                    data_2 = false,
                    label_2 = '',
                    data_3 = false,
                    label_3 = '',
                }
            ){
            label = [];
            data_set = [];
            // Set data pertama...
            data_a = [];
            for( key in data_1){
                // set label...
                label.push(key);
                // set data...
                data_a.push(data_1[key])
            }
            data_set.push({
                label : label_1,
                backgroundColor: 'rgb(33, 44, 95)',
                borderColor: 'rgb(33, 44, 95)',
                data: data_a,
                tension: 0.2,
            });

            // Set data 2 jika ada...
            if(data_2){
                data_b = [];
                for( key in data_2){
                    // set data...
                    data_b.push(data_2[key])
                }
                data_set.push({
                    label : label_2,
                    backgroundColor: 'rgb(0, 148, 86)',
                    borderColor: 'rgb(0, 148, 86)',
                    data: data_b,
                    tension: 0.2,
                });
            }
            if(data_3){
                data_c = [];
                for( key in data_3){
                    // set data...
                    data_c.push(data_3[key])
                }
                data_set.push({
                    label : label_3,
                    backgroundColor: 'rgb(42, 48, 86)',
                    borderColor: 'rgb(42, 48, 86)',
                    data: data_c,
                    tension: 0.2,
                });
            }
            console.log('data_set', data_set);

            // prepare config...
            const jenis_config = {};
            jenis_config.type = type;
            jenis_config.data = {
                labels: label,
                datasets: data_set
            };
            if(type === 'bar'){
                jenis_config.options = {};
                jenis_config.options.indexAxis = axis;
                if(axis === 'y'){
                    jenis_config.options.scales = {
                        x: {
                            ticks: {
                                callback: function(value, index, values) {
                                    // jumlah digit max label...
                                    digit = values.at(-1).value.toString().length;
                                    // set value menjadi ribuan (4 digit)...
                                    pembagi = 10 ** (digit - 4);
                                    return  (value / pembagi).toFixed(0);
                                }
                            }
                        },
                        y:{
                            ticks: {
                                callback: function(value, index, values) {
                                    return this.getLabelForValue(value).split(" ")[0] ;
                                }
                            }
                        }
                    }
                } else {
                    jenis_config.options.scales = {
                        x: {
                            ticks: {
                                callback: function(value, index, values) {
                                    return this.getLabelForValue(value).split(" ")[0] ;
                                }
                            }
                        },
                        y:{
                            ticks: {
                                callback: function(value, index, values) {
                                    // jumlah digit max label...
                                    digit = values.at(-1).value.toString().length;
                                    // set value menjadi ribuan (4 digit)...
                                    pembagi = 10 ** (digit - 4);
                                    return  (value / pembagi).toFixed(0);
                                }
                            }
                        }
                    }
                }
            }

            //prepare target...
            const jenis_chart = document.getElementById(id);
            jenis_chart.innerHTML = `<canvas></canvas>`

            //init chart...
            new Chart(
                jenis_chart.firstChild,
                jenis_config
            );
        }
    </script>
@endpush
@push('scripts')
    <script>
        class BulanDaftar{
            constructor(){
                this.daftar = [
                    {nama : 'Januari',  tgl :31,    dayStart : 0, dayEnd : 0},
                    {nama : 'Februari', tgl :0,     dayStart : 0, dayEnd : 0},
                    {nama : 'Maret',    tgl :31,    dayStart : 0, dayEnd : 0},
                    {nama : 'April',    tgl :30,    dayStart : 0, dayEnd : 0},
                    {nama : 'Mei',      tgl :31,    dayStart : 0, dayEnd : 0},
                    {nama : 'Juni',     tgl :30,    dayStart : 0, dayEnd : 0},
                    {nama : 'Juli',     tgl :31,    dayStart : 0, dayEnd : 0},
                    {nama : 'Agustus',  tgl :31,    dayStart : 0, dayEnd : 0},
                    {nama : 'September',tgl :30,    dayStart : 0, dayEnd : 0},
                    {nama : 'Oktober',  tgl :31,    dayStart : 0, dayEnd : 0},
                    {nama : 'November', tgl :30,    dayStart : 0, dayEnd : 0},
                    {nama : 'Desember', tgl :31,    dayStart : 0, dayEnd : 0}
                ];
            }
        }

        // setChart();
        document.addEventListener('alpine:init', () => {

            Alpine.data('navigation', () => ({
                bulanDaftar : new BulanDaftar().daftar,
                tahunSekarang : new Date().getFullYear(),
            }));

        })
    </script>
@endpush
@push('sidebar')
    {{-- SIDEBAR --}}
    <div
        class="bg-base-200 min-h-screen"
        x-data="navigation"
        >
        <div class="grid grid-cols-2 gap-2">

            {{-- NAVIGASI --}}
                <a class="flex-1 btn btn-sm btn-primary {{ $sidebar == 'penerimaan' ? '' : 'btn-outline' }}" href="{{ route('penerimaan') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    Penerimaan
                </a>
                <a class="flex-1 btn btn-sm btn-primary {{ $sidebar == 'penerimaan-pegawai' ? '' : 'btn-outline' }}" href="{{ route('penerimaan-pegawai') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    Pegawai
                </a>
            {{-- END NAVIGASI --}}
            {{-- FILTER --}}
                @if ($sidebar == 'penerimaan')
                    @livewire('filter.penerimaan')
                @else
                    @livewire('filter.penerimaan-pegawai')
                @endif
            {{-- END PENERIMAAN --}}
        </div>
    </div>
    {{-- END SIDEBAR --}}
@endpush
@section('app')
    @yield('main')
@endsection
