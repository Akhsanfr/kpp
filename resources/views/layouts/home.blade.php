@extends('layouts.main')
@push('chart')
    <script src="{{ mix('js/chart.js') }}"></script>
    <script>
        function showLabelData(value, index, values){
            return this.getLabelForValue(value).split(" ")[0] ;
        }

        function showLabelAngka(value, index, values){
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

        function setChart(
                {   type,
                    axis,
                    id,
                    interaction = false,
                    barThickness = null,
                    data,
                    labels,
                    legends,
                    height = 'auto'
                }
            ){
            // prepare config...
            // color
            const colors = [
                'rgb(33, 44, 95)',
                'rgb(255, 201, 27)',
                'rgb(0, 148, 133)'
            ]
            let datasets = [];
            // siapkan  config data untuk tiap set data
            data.forEach((e, index) => {
                datasets.push({
                    label : legends[index],
                    backgroundColor: colors[index],
                    data : e,
                    tension: 0.2,
                    barThickness
                })
            })

            const jenis_config = {
                type,
                data : {
                    labels,
                    datasets,
                },
                options : {
                    indexAxis : axis,
                    maintainAspectRatio: false,
                }
            };
            if(interaction){
                jenis_config.options.interaction = {
                    intersect: false,
                    mode: 'index',
                    axis,
                }
            }

            if(axis == 'x'){
                jenis_config.options.scales = {
                    x: {
                        ticks: { callback: showLabelData }
                    },
                    y:{
                        ticks: { callback: showLabelAngka}
                    }
                }
            } else {
                jenis_config.options.scales = {
                    x: {
                        ticks: { callback: showLabelAngka }
                    },
                    y:{
                        ticks: { callback: showLabelData}
                    }
                }
            }

            //prepare target...
            const jenis_chart = document.getElementById(id);
            if(jenis_chart === null){
                return console.error('Invalid id chart');
            }
            jenis_chart.innerHTML = `<canvas></canvas>`;
            if(height === 'auto'){
                if(axis === 'x'){
                    jenis_chart.style.height = "300px";
                } else {
                    jenis_chart.style.height = labels.length * 30 + 75 +'px';
                }
            } else {
                jenis_chart.style.height = height + 'px';
            }
            console.log(jenis_chart.style.height);
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
