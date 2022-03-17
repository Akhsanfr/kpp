@push('scripts')
<script>
        window.addEventListener('chart-perbulan', event => {
            console.log(event.detail.labels);
            let data = [];
            let labels = [];
            setChart({   type : 'line',
                axis : 'x',
                id : 'chart-perbulan',
                interaction : true,
                data : [
                    event.detail.bruto,
                    event.detail.netto,
                    event.detail.spmkp,
                ],
                labels : event.detail.labels,
                legends : ['Bruto', 'Netto', 'SPMKP'],
                height : 450
            });
        });
    </script>
@endpush

<div class="card-title-up col-span-6">
    <h2>Penerimaan per Bulan <small class="badge badge-secondary">Tahunan</small></h2>
    <div id="chart-perbulan"></div>
</div>
