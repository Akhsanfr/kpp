<div class="w-full grid grid-cols-3 gap-4 content-start" x-data>
    <div class="card-title-down">
        <div>{{ $targetKKP }}</div>
        <div>Terget KKP 073</div>
    </div>
    <div class="card-title-down">
        <div x-text="$wire.penerimaanNetto"></div>
        <div>Penerimaan Netto</div>
    </div>
    <div class="card-title-down">
        <div x-text="$wire.SPMKP"></div>
        <div>SPMKP</div>
    </div>
    <livewire:pages.penerimaan.harian />
    <div class="col-span-1 flex flex-col space-y-4">
        <div class="card-title-up">
            <h2>3 Sektor pajak paling cuan</h2>
            <div>
                <ul class="list-disc">
                    <li>1. {{ $dataSekarang->peringkat_pajak_1 }}</li>
                    <li>2. {{ $dataSekarang->peringkat_pajak_2 }}</li>
                    <li>3. {{ $dataSekarang->peringkat_pajak_3 }}</li>
                </ul>
            </div>
        </div>
        <livewire:pages.penerimaan.pertumbuhan-netto-bruto />
        <livewire:pages.penerimaan.capaian-netto-bruto />
    </div>
    <livewire:pages.penerimaan.tahunan />
</div>
