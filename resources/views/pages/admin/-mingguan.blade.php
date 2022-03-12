@extends('layouts.admin')
@section('content')
    <h2 class="col-span-12 card bg-base-200">
        Unggah Data Baru
    </h2>
    <livewire:admin.harian-upload />
    <h2 class="col-span-12 card bg-base-200">
        Data Mingguan Pegawai
    </h2>
    <livewire:admin.harian-tabel />
    <h2 class="col-span-12 card bg-base-200">
        Cek Data
    </h2>
    <livewire:admin.harian-cek />
@endsection
