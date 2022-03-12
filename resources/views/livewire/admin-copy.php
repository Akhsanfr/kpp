<div class="grid grid-cols-12 p-8 gap-4">
    {{-- IMPORT EXCEL --}}
        <div class="col-span-12" x-data="{ namaFile : '', jenisData: '', tipe: '' }" @bersihkan.window="jenisData = '', tipe= '', namaFile = ''">
            <div class="card bg-base-200 p-4 mb-2">
                Unggah data
            </div>
            <div class="flex flex-col w-min space-y-2">
                <input id="file-penerimaan" type="file" wire:model="file" class="hidden" @change="namaFile = $event.target.files[0].name">
                <label for="file-penerimaan" class="btn btn-sm btn-primary">Pilih berkas</label>
                <select class="select select-sm select-bordered">
                    <option disabled="disabled" :selected="jenisData == '' ? 'selected' : ''">Pilih Jenis Data</option>
                    <option @click="jenisData = 'Penerimaan'">Penerimaan Harian</option>
                    <option @click="jenisData = 'PenerimaanPegawai'">Penerimaan Pegawai</option>
                </select>
                <select class="select select-sm select-bordered" x-show="jenisData == 'Penerimaan'">
                    <option disabled="disabled" selected="selected">Pilih Penerimaan</option>
                    <option @click="tipe = 1">SPMKP</option>
                    <option @click="tipe = 2">BRUTO</option>
                </select>
                <select class="select select-sm select-bordered" x-show="jenisData == 'PenerimaanPegawai'">
                    <option disabled="disabled" selected="selected">Pilih Pegawai</option>
                    @forelse ($pegawais as $pegawai)
                        <option @click="tipe = {{$pegawai->id}}">{{ $pegawai->nama }}</option>
                    @empty
                        <option disabled>Belum tersedia data</option>
                    @endforelse
                </select>
                {{-- <form class="col-span-12" wire:submit.prevent="save()"> --}}
                <form class="col-span-12" @submit.prevent="$wire.save(jenisData, tipe)">
                    <button type="submit" class="btn btn-sm btn-secondary btn-block">Unggah SPKM</button>
                </form>
            </div>
            <span x-text="namaFile"></span>
        </div>
    {{-- END IMPORT EXCEL --}}
    {{-- PESAN --}}
    <div class=" alert col-span-12 items-start"
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
    </div>
    {{-- END PESAN --}}
</div>
