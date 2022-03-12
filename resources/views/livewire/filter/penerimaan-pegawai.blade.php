@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('penerimaanPegawai', () => ({
                bulanDaftar : new BulanDaftar().daftar,
                romawi: ['I', 'II', 'III', 'IV', 'V'],
                seksis: [
                    {nama : 'Pengawasan I', status : false},
                    {nama : 'Pengawasan II', status : false},
                    {nama : 'Pengawasan III', status : false},
                    {nama : 'Pengawasan IV', status : false},
                    {nama : 'Pengawasan V', status : false},
                    {nama : 'Pengawasan VI', status : false},
                ],
                tahunAktif : 0,
                bulanAktif : 0,
                pekanAktif : 0,
                seksiAktif : [], // index of seksis
                setBulanAktif(bulan){
                    this.bulanAktif = bulan;
                },
                setTahunAktif(tahun){
                    this.tahunAktif = tahun;
                },
                setPekanAktif(pekan){
                    this.pekanAktif = pekan;
                },
                setSeksiAktif(seksi){
                    this.seksis[seksi].status = !this.seksis[seksi].status;
                },
                getData(){
                    rawSqlSeksi = [];
                    for(seksi in this.seksis){
                        // pilih seksi yang bernilai true...
                        if(this.seksis[seksi].status){
                            rawSqlSeksi.push(`seksi = '${this.seksis[seksi].nama}'`)
                        }
                    }
                    // ubah sesuai statement MYSQL...
                    rawSqlSeksi = rawSqlSeksi.join(' OR ')
                    // set jika tidak ada seksi yang dipilih biar ga error...
                    if(rawSqlSeksi == ''){
                        rawSqlSeksi = "seksi = ''"
                    }
                    this.$wire.emit('penerimaan-pegawai',this.tahunAktif, this.bulanAktif + 1, this.pekanAktif, rawSqlSeksi);
                },
                init(){
                    sekarang = new Date();
                    this.setTahunAktif(sekarang.getFullYear());
                    this.setBulanAktif(sekarang.getMonth());
                    this.setPekanAktif(1);
                    this.setSeksiAktif(0);
                    this.getData()
                }
            }))
        })
    </script>
@endpush
<section
    x-data="penerimaanPegawai"
    class="col-span-2 grid grid-cols-2 gap-2"
    >
    <div class="relative" x-data="{show : false}">
        <div class="btn btn-sm btn-secondary btn-block" @click="show = !show" x-text="bulanDaftar[bulanAktif].nama"></div>
        <div class="w-max z-10 absolute top-10 card bg-primary p-2 grid grid-cols-3 gap-1" x-show="show" @click.outside="show = false">
            <template x-for="(bulan, index) in bulanDaftar">
                <span
                    class="btn btn-sm btn-primary"
                    :class="(bulanAktif == index) ? 'btn-secondary' : ''"
                    x-text="bulan.nama"
                    @click="
                        setBulanAktif(index);
                        getData();
                        show = false"
                >
                </span>
            </template>
        </div>
    </div>
    <div class="relative" x-data="{show : false}">
        <div class="btn btn-sm btn-secondary btn-block" @click="show = !show" x-text="tahunAktif"></div>
        <div class="w-max z-10 absolute top-10 right-0 card bg-primary p-4 grid grid-cols-1" x-show="show" @click.outside="show = false">
            <template x-for="tahun in (tahunSekarang - 2018)">
                <span class="hover:bg-base-200 p-2 card cursor-pointer text-base-100 hover:text-primary" x-text="tahun + 2018"
                    @click="
                        setTahunAktif(tahun + 2018);
                        getData();
                        show = false
                        "
                ></span>
            </template>
        </div>
    </div>
    <div class="col-span-2 cal grid grid-cols-5 gap-2">
        <template x-for="pekan in 5">
            <span
                x-text="pekan"
                class="cal-body"
                :class="pekan == pekanAktif && 'cal-aktif'"
                @click="setPekanAktif(pekan); getData()"
            ></span>
        </template>
        <template x-for="(seksi, index) in seksis">
            <span
                class="cal-body col-span-5"
                :class="seksi.status && 'cal-aktif'"
                x-text="seksi.nama"
                @click="setSeksiAktif(index); getData()"
            ></span>
        </template>
    </div>
</section>
