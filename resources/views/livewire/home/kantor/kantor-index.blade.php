@push('sidebar_home')
    <livewire:home.kantor.kantor-filter />
@endpush
<div class="grid grid-cols-12 gap-4">
    <livewire:home.kantor.kantor-penerimaan-target />
    <livewire:home.kantor.kantor-penerimaan-netto />
    <livewire:home.kantor.kantor-penerimaan-spmkp />


    <livewire:home.kantor.kantor-perjenis />
    <livewire:home.kantor.kantor-perbulan />

    <livewire:home.kantor.kantor-capaian-netto />
    <livewire:home.kantor.kantor-capaian-bruto />
    <livewire:home.kantor.kantor-pertumbuhan-netto />
    <livewire:home.kantor.kantor-pertumbuhan-bruto />

    <livewire:home.kantor.kantor-sektor-terbesar />
    <livewire:home.kantor.kantor-wp-tertinggi />

</div>
