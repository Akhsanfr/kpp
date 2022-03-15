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
                }
            ){


            //
                // console.log(data_1);
                // let labels = [];
                // let data_set = [];
                // let datasets = [];
                // Set data pertama...
                // data_a = [];
                // for( key in data_1){
                //     // set label...
                //     label.push(data_1.label);
                //     // set data...
                //     data_a.push(data_1.value)
                // };
                // for( key in data_1){
                //     // set label...
                //     label.push(key);
                //     // set data...
                //     data_a.push(data_1[key])
                // };
                // data_set.push({
                //     label : label_1,
                //     backgroundColor: 'rgb(33, 44, 95)',
                //     borderColor: 'rgb(33, 44, 95)',
                //     barThickness,
                //     data: data_a,
                //     tension: 0.2,
                // });

                // Set data 2 jika ada...
                // if(data_2){
                //     data_b = [];
                //     for( key in data_2){
                //         // set data...
                //         data_b.push(data_2[key])
                //     }
                //     data_set.push({
                //         label : label_2,
                //         backgroundColor: 'rgb(255, 201, 27)',
                //         borderColor: 'rgb(255, 201, 27)',
                //         data: data_b,
                //         tension: 0.2,
                //         barThickness
                //     });
                // }
                // if(data_3){
                //     data_c = [];
                //     for( key in data_3){
                //         // set data...
                //         data_c.push(data_3[key])
                //     }
                //     data_set.push({
                //         label : label_3,
                //         backgroundColor: 'rgb(0, 148, 133)',
                //         borderColor: 'rgb(0, 148, 133)',
                //         data: data_c,
                //         tension: 0.2,
                //         barThickness
                //     });
                // }
                // new
                // if(Array.isArray(data)){
                //     console.log('cek',data);
                //     console.log(Array.isArray(data));
                // } else {
                //     console.log('data' ,data);
                //     x = [];
                //     // y = [];
                //     for( key in data){
                //         // set data...
                //         x.push(data[key])
                //         labels.push(key)
                //     }
                //     // console.log(y);
                //     datasets.push({
                //         label : 'yoo',
                //         backgroundColor: colors[0],
                //         data: x,
                //         tension: 0.2,
                //         barThickness
                //     });
                // }

                // data_a = [];
                // for( key in data_1){
                //     // set label...
                //     label.push(data_1.label);
                //     // set data...
                //     data_a.push(data_1.value)
                // };
                // for( key in data_1){
                //     // set label...
                //     label.push(key);
                //     // set data...
                //     data_a.push(data_1[key])
                // };
                // data_set.push({
                //     label : label_1,
                //     backgroundColor: 'rgb(33, 44, 95)',
                //     borderColor: 'rgb(33, 44, 95)',
                //     barThickness,
                //     data: data_a,
                //     tension: 0.2,
                // });
                    // console.log('datasets :', datasets);
                    // console.log('labels :', labels);
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
            //
                // if(data[0][0]){
                //     data.forEach((e, index) => {
                //         datasets.push({
                //             label : legend[index],
                //             backgroundColor: colors[index],
                //             data : data[index],
                //             tension: 0.2,
                //             barThickness
                //         })
                //     })
                // } else {
                //     datasets.push({
                //         label : legend,
                //         backgroundColor: colors[0],
                //         data,
                //         tension: 0.2,
                //         barThickness
                //     })
                // }
                // console.log(datasets);
            // console.log(data[0][0] ? 'yes' : 'no')

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
            jenis_chart.style.height = labels.length * 30 + 75 +'px';

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
