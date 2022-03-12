{{-- @push('scripts')
    <script>
        class BulanDaftar{
            constructor(){
                this.daftar = [
                    {nama : 'Januari',  tgl :31,    dayStart : 0, dayEnd : 0},
                    {nama : 'Februari', tgl :0,     dayStart : 0, dayEnd : 0},
                    {nama : 'Maret',    tgl :31,    dayStart : 0, dayEnd : 0},
                    {nama : 'April',    tgl :30,    dayStart : 0, dayEnd : 0},
                    {nama : 'Mei',      tgl :31,    dayStart : 0, dayEnd : 0},
                    {nama : 'Juni',     tgl :30,    dayStart : 0, dayEnd : 0},
                    {nama : 'Juli',     tgl :31,    dayStart : 0, dayEnd : 0},
                    {nama : 'Agustus',  tgl :31,    dayStart : 0, dayEnd : 0},
                    {nama : 'September',tgl :30,    dayStart : 0, dayEnd : 0},
                    {nama : 'Oktober',  tgl :31,    dayStart : 0, dayEnd : 0},
                    {nama : 'November', tgl :30,    dayStart : 0, dayEnd : 0},
                    {nama : 'Desember', tgl :31,    dayStart : 0, dayEnd : 0}
                ];
            }
        }

        document.addEventListener('alpine:init', () => {

            Alpine.data('navigation', () => ({
                bulanDaftar : new BulanDaftar().daftar,
                tahunSekarang : new Date().getFullYear(),
            }));

        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
@push('sidebar')
    {{-- SIDEBAR --}}
    <div
        class="p-4 bg-base-200 min-h-screen"
        x-data="navigation"
        >
        <div class="grid grid-cols-2 gap-2">

            {{-- NAVIGASI --}}
                <a class="flex-1 btn btn-sm btn-primary {{ $sidebar == 'penerimaan' ? '' : 'btn-outline' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    Penerimaan
                </a>
                <a class="flex-1 btn btn-sm btn-primary {{ $sidebar == 'penerimaanPegawai' ? '' : 'btn-outline' }}" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    Pegawai
                </a>
            {{-- END NAVIGASI --}}

            {{-- FILTER PENERIMAAN --}}
                {{-- @include('sub.filter-penerimaan') --}}
                @livewire('filter.penerimaan')
                @livewire('filter.penerimaan-pegawai')
                {{-- @include('sub.filter-penerimaan-pegawai') --}}
            {{-- END FILTER PENERIMAAN --}}

        </div>
    </div>
    {{-- END SIDEBAR --}}
@endpush
<section
    class="flex flex-row"
>
    @livewire('pages.penerimaan')
    @livewire('pages.penerimaan-pegawai')
</section> --}}

