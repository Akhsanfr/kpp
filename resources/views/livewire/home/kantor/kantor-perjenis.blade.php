@push('scripts')
    <script>
        window.addEventListener('chartPerjenis', event => {
            let data = [];
            let labels = [];
            setChart({   type : 'bar',
                axis : 'x',
                id : 'chart-perjenis',
                data : [event.detail[1]],
                labels : event.detail[0],
                legends : ['Data']
            });
        })
    </script>
@endpush
<div class="card-title-up col-span-6 ">
    <h2>Penerimaan per Jenis Pajak <small class="badge badge-info">Harian</small></h2>
    <div id="chart-perjenis"></div>
</div>
