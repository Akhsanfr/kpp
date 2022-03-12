<div class="col-span-12 grid grid-cols-3 gap-4">
    <div class="col-span-3">
        <span>Pilih tahun</span>
        <select class="select select-sm select-bordered" wire:model="tahun">
            @for ($i = 2020; $i <= date('Y'); $i++)
                <option value="{{$i}}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    @foreach ($kalenders as $kalender)
    <div class="card-title-up">
        <h2>{{ $kalender['nama_bulan'] }}</h2>
        <div class="card text-xs cal grid grid-cols-7 content-start bg-base-200">
            <span class="cal-title">M</span>
            <span class="cal-title">S</span>
            <span class="cal-title">S</span>
            <span class="cal-title">R</span>
            <span class="cal-title">K</span>
            <span class="cal-title">J</span>
            <span class="cal-title">S</span>

            @for ($i = 0; $i < $kalender['hari_pertama']; $i++)
                <span class="cal-none">-</span>
            @endfor
            @foreach ($kalender['tanggal'] as $tanggal)
                <span
                    @if (array_search($tanggal, $tanggals) > -1)
                        class="cal-aktif cal-clickable"
                        wire:click="$emit('filterSearch','{{ $tanggal }}')"
                    @else
                        class="cal-body"
                    @endif
                >{{ $loop->iteration }}</span>

            @endforeach

            @for ($i = 0; $i < 7 - $kalender['hari_pertama_bulan_berikutnya']; $i++)
                <span class="cal-none">-</span>
            @endfor

            @if($kalender['hari_pertama'] + count($kalender['tanggal']) < 35)
                @for ($i = 0; $i < 7 ; $i++)
                    <span class="cal-none">-</span>
                @endfor
            @endif

        </div>
    </div>
    @endforeach
</div>
