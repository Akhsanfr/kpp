@push('scripts')
<script>
        window.addEventListener('chart-perbulan', event => {
            setChart({   type : 'line',
                    axis : 'x',
                    id : 'chart-perbulan',
                    data_1 : event.detail.bruto,
                    label_1 : 'BRUTO',
                    data_2 : event.detail.netto,
                    label_2 : 'NETTO',
                    data_3 : event.detail.spmkp,
                    label_3 : 'SPMKP'
                })
        });
    </script>
@endpush

<div class="card-title-up col-span-6">
    <h2>Penerimaan per Bulan <small class="badge badge-secondary">Tahunan</small></h2>
    <div id="chart-perbulan"></div>
</div>
