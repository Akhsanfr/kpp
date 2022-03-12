{{-- @push('scripts')
    <script defer>
        document.addEventListener('alpine:init', () => {
            Alpine.data('data', () => ({
                namaFile : '',
                tipe : 0,
                columnDaftar : [
                    {title:"id", field:'id', visible:false},
                    {title:"Tanggal", field:"tanggal"},
                    {title:"PPN Impor", field:"ppn_impor"},
                    {title:"PPH 25/9", field:"pph_25_9"},
                    {title:"PPH 22 Impor", field:"pph_22_impor"},
                    {title:"PPH 21", field:"pph_21"},
                    {title:"PPH PPNDN", field:"pph_ppndn"},
                    {title:"PPH 23", field:"pph_23"},
                    {title:"PPH 22", field:"pph_22"},
                    {title:"Netto", field:"netto"},
                    {title:"Bruto", field:"bruto"},
                    {title:"Capaian Netto", field:"capaian_netto"},
                    {title:"Capaian Bruto", field:"capaian_bruto"},
                    {title:"Penerimaan Target", field:"penerimaan_target"},
                    {title:"Penerimaan Netto", field:"penerimaan_netto"},
                    {title:"Penerimaan SPMKP", field:"penerimaan_spmk"}
                ],
                tabel : '',
                setTabel(){
                    this.tabel = new Tabulator("#tabel", {
                        data            :this.$wire.penerimaans, //assign data to table
                        columns         :this.columnDaftar,
                        pagination      :true,
                        paginationSize  :25,
                        paginationButtonCount:3,
                        paginationSizeSelector:[25,50,75,100]
                    });
                },
                setFilter(search){
                    // Filter semua kolom (OR statement)
                    allColumnFilter = [];
                    this.columnDaftar.forEach((val)=>{
                        allColumnFilter.push({field:val.field, type:"keywords", value:search})
                    })
                    // Set Filter
                    this.tabel.setFilter([
                        allColumnFilter
                    ]);
                },
                unggahBerkas(){
                    if(this.namaFile != ''){
                        this.$wire.unggahBerkas(this.tipe)
                    } else {
                        this.$dispatch('pesan', {
                            isi     : ['Pilih berkas terlebih dahulu!'],
                            tipe    : 'warning'
                        });
                    }
                },
                init(){
                    this.setTabel();
                },
                tes(){
                    this.$dispatch('pesan', {
                            isi     : ['Pilih berkas terlebih dahulu!'],
                            tipe    : 'warning'
                        });
                }
            }))
        })

    </script>
@endpush
{{-- @push('filter')
<span>
    Ini Filter
</span>
@endpush --}}

<section
    x-data="data"
    @reset.window="namaFile = ''"
    class="w-full grid grid-cols-12 p-8 gap-4">
    {{-- UNGGAH BERKAS --}}
    <h2 class="col-span-12 card bg-base-300 p-4">
        Unggah Data Baru
    </h2>
    <button class="btn" @click="unggahBerkas()"> Unggah yok</button>
    <div class="col-span-12">
        <form @submit.prevent="tes()">
        <div class="flex flex-row items-center gap-x-4">
            <select class="select select-bordered select-primary w-full max-w-xs">
                <option disabled="disabled" selected="selected">Pilih tipe penerimaan</option>
                <option @click="tipe = 'spmkp'">SPMKP</option>
                <option @click="tipe = 'bruto'">BRUTO</option>
            </select>
            <input id="file-penerimaan" type="file" wire:model="file" class="hidden" @change="namaFile = $event.target.files[0].name">
            <label for="file-penerimaan" class="btn btn-sm btn-primary">Pilih berkas</label>
                <button type="submit" class="btn btn-sm btn-secondary whitespace-nowrap">Unggah Data</button>
            </div>
        </form>
        <button class="btn" @click="tes()">TESSSSS</button>
        <span x-text="namaFile"></span>
    </div>
    {{-- UNGGAH BERKAS --}}
    {{-- PESAN --}}
    {{-- <div class=" alert col-span-12 items-start"
        x-data="{isi: '', tipe:''}"
        :class="'alert-'+tipe"
        x-show="isi"
        @pesan.window="isi = $event.detail.isi; tipe = $event.detail.tipe"
    >
        <div class="flex-1">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
            <path x-show="tipe == 'success' || tipe == 'info'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            <path x-show="tipe == 'error'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
            <path x-show="tipe == 'warning'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
          </svg>
            <label>
                <ul>
                    <template x-for="i in isi">
                        <li x-text="i"></li>
                    </template>
                </ul>
            </label>
        </div>
        <svg @click="isi = ''" @click.outside="isi = ''" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </div> --}}
    <x-pesan></x-pesan>
    {{-- END PESAN --}}
    {{-- TABEL --}}
    {{-- <h2 class="col-span-12 card bg-base-300 p-4">
        Kelola Data
    </h2>
    <input type="text" placeholder="Cari data..." class="col-span-12 input input-primary input-bordered" @input="setFilter($event.target.value)">
    <div id="tabel" class="col-span-12"></div> --}}
    {{-- END TABEL --}}
</section>
 --}}
