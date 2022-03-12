@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('penerimaan', () => ({
                menuPenerimaan : 1,
                bulanDaftar : new BulanDaftar().daftar,
                tahunAktif : 0,
                bulanAktif : 0,
                tanggalAktifMentah : [1,1],
                tanggalAktif :[0,0],
                setDayStartEnd(){
                        if(((this.tahunAktif % 4 == 0) && (this.tahunAktif % 100 != 0)) || (this.tahunAktif % 400 == 0)){
                            this.bulanDaftar[1].tgl = 29;
                        } else {
                            this.bulanDaftar[1].tgl = 28;
                        }
                        for(i = 0; i < 12 ; i++){
                            dayStart = new Date(this.tahunAktif,i,01);
                            dayEnd = new Date(this.tahunAktif,i,this.bulanDaftar[i].tgl);
                            this.bulanDaftar[i].dayStart = dayStart.getDay()-1;
                            this.bulanDaftar[i].dayEnd = 7 - dayEnd.getDay();
                        }
                },
                getHarian(){
                    return this.$wire.emit('penerimaan-harian', this.tanggalAktif[0], this.tanggalAktif[1], this.bulanAktif + 1, this.tahunAktif, this.menuPenerimaan)
                    // this.$dispatch('penerimaan-harian', this.tanggalAktif[0], this.tanggalAktif[1], this.bulanAktif + 1, this.tahunAktif, this.menuPenerimaan)
                },
                getTahunan(){
                    return this.$wire.emit('penerimaan-tahunan', this.tahunAktif, this.menuPenerimaan)
                },
                setTanggalAktifMentah(tgl){
                    this.tanggalAktifMentah.shift();
                    this.tanggalAktifMentah.push(parseInt(tgl));
                },
                setTanggalAktif(){
                    this.tanggalAktif = [];
                    this.tanggalAktif = [...this.tanggalAktifMentah];
                    this.tanggalAktif.sort(function(a, b){return a - b});
                },
                setBulanAktif(index){
                    this.bulanAktif = index
                    this.tanggalAktifMentah=[1,1]
                    this.tanggalAktif=[1,1]
                },
                setTahunAktif(tahun){
                    this.tahunAktif = tahun;
                    this.setDayStartEnd();
                },
                init(){
                    sekarang = new Date();
                    this.setTahunAktif(sekarang.getFullYear());
                    this.setBulanAktif(sekarang.getMonth());
                    this.setTanggalAktifMentah(sekarang.getDate());
                    this.setTanggalAktifMentah(sekarang.getDate());
                    this.setTanggalAktif();
                    this.setDayStartEnd();
                    this.getHarian();
                    this.getTahunan();
                }
            }))
        })
    </script>
@endpush

<section
    x-data="penerimaan"
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
                    @click="setBulanAktif(index), show = false, getHarian()">
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
                        setTahunAktif(tahun + 2018),
                        setBulanAktif(0),
                        setTanggalAktifMentah(1),
                        setTanggalAktifMentah(1),
                        setTanggalAktif(),
                        show = false,
                        getTahunan(),
                        getHarian()
                        "
                ></span>
            </template>
        </div>
    </div>
    <div class="col-span-2 cal grid grid-cols-7 relative">
        <span class="cal-title">S</span>
        <span class="cal-title">S</span>
        <span class="cal-title">R</span>
        <span class="cal-title">K</span>
        <span class="cal-title">J</span>
        <span class="cal-title">S</span>
        <span class="cal-title">M</span>
        <template x-for="tgl in (bulanDaftar[bulanAktif].dayStart)">
            <span class="cal-none">-</span>
        </template>
        <template x-for="tgl in bulanDaftar[bulanAktif].tgl">
            <span
                class="cal-body"
                x-text="tgl"
                :class=" (tgl >= tanggalAktif[0] && tgl <= tanggalAktif[1]) && 'cal-aktif'"
                @click="
                    setTanggalAktifMentah(tgl),
                    setTanggalAktif(),
                    getHarian()
                    "
            ></span>
        </template>
        <template x-for="tgl in (bulanDaftar[bulanAktif].dayEnd)">
            <span class="cal-none">-</span>
        </template>
    </div>
    <button class="btn btn-sm btn-secondary" :class="(menuPenerimaan == 1) || 'btn-outline'" @click="menuPenerimaan = 1, getHarian(), getTahunan()">SPMKP</button>
    <button class="btn btn-sm btn-secondary" :class="(menuPenerimaan == 2) || 'btn-outline'" @click="menuPenerimaan = 2, getHarian(), getTahunan()">Bruto</button>
</section>

