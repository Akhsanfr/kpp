@push('scripts')
    <script>
        window.addEventListener('chartPerjenis', event => {
            setChart({   type : 'bar',
                    axis : 'x',
                    id : 'chart-perjenis',
                    data_1 : event.detail,
                    label_1 : 'Data',
                });
        })
    </script>
@endpush
<div class="card-title-up col-span-6 ">
    <h2>Penerimaan per Jenis Pajak <small class="badge badge-info">Harian</small></h2>
    <div id="chart-perjenis"></div>
</div>
