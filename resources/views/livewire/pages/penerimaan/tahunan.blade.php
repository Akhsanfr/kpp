@push('scripts')
<script>
        window.addEventListener('chart-bulanan', event => {
            setChart({   type : 'line',
                    axis : 'x',
                    id : 'bulanChart',
                    data_1 : event.detail.data_bruto,
                    label_1 : 'Bruto',
                    data_2 : event.detail.data_spmkp,
                    label_2 : 'SPMKP',
                    data_3 : event.detail.data_netto,
                    label_3 : 'Netto'
                })
        });
    </script>
@endpush
<div class="col-span-3">
    <x-chart id="bulanChart" judul="Penerimaan per Bulan" col="-"></x-chart>
</div>
