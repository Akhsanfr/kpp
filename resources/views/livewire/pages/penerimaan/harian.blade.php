@push('scripts')
    <script>
        window.addEventListener('chart-update', event => {
            // setChart('bar','y','perJenisPajak', event.detail, 'label');
            setChart({   type : 'bar',
                    axis : 'x',
                    id : 'perJenisPajak',
                    data_1 : event.detail,
                    label_1 : 'label',
                });
        })
    </script>
@endpush
<div class="card-title-up col-span-2">
    <h2>Penerimaan per Jenis Pajak</h2>
    <div id="perJenisPajak"></div>
</div>
