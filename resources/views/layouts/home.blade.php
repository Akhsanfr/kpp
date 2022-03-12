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
                    backgroundColor: 'rgb(255, 201, 27)',
                    borderColor: 'rgb(255, 201, 27)',
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
                    backgroundColor: 'rgb(0, 148, 133)',
                    borderColor: 'rgb(0, 148, 133)',
                    data: data_c,
                    tension: 0.2,
                });
            }

            // prepare config...
            const jenis_config = {};
            jenis_config.type = type;
            jenis_config.data = {
                labels: label,
                datasets: data_set
            };
            jenis_config.options = {};
            jenis_config.options.indexAxis = axis;
            jenis_config.options.interaction = {
                intersect: false,
                mode: 'index',
            },

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
                                if(digit <= 3 ){
                                    label = `${value}`
                                } else if(digit <= 6){
                                    label = `${value / 1000} {{env('AWALAN_SI_RIBU', 'K')}}`
                                } else if(digit <= 9){
                                    label = `${value / 1000000} {{env('AWALAN_SI_JUTA', 'M')}}`
                                } else if(digit <= 12) {
                                    label = `${value / 1000000000} {{env('AWALAN_SI_MILIAR', 'G')}}`
                                } else {
                                    label = `${value / 1000000000000} {{env('AWALAN_SI_TRILIUN', 'T')}}`
                                }
                                return label
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
@push('sidebar')
    <div class="space-y-4">
        <div class="grid grid-cols-2 gap-4 w-full">
            <a href="{{ route('kantor') }}" class="btn btn-sm btn-primary {{ Request::is("kantor*")  ? '' : 'btn-outline'}}">Kantor</a>
            <a href="{{ route('pegawai') }}" class="btn btn-sm btn-primary {{ Request::is("pegawai*")  ? '' : 'btn-outline'}}">Pegawai</a>
        </div>
        @stack('sidebar_home')
    </div>
@endpush
@section('app')
    @yield('content')
@endsection