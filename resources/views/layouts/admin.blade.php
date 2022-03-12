@extends('layouts.main')
@push('sidebar')
    <ul class="space-y-4">
        <li>
            <a href="{{ route('admin-harian') }}" class="btn w-full {{ Request::is(env('LINK_ADMIN')."/harian*")  ? 'btn-secondary' : 'btn-secondary-inactive'}}"> Data Harian</a>
        </li>
        <li>
            <a href="{{ route('admin-mingguan') }}" class="btn w-full {{ Request::is(env('LINK_ADMIN')."/mingguan*")  ? 'btn-secondary' : 'btn-secondary-inactive'}}"> Data Mingguan</a>
        </li>
        <li>
            <a href="{{ route('admin-tahunan') }}" class="btn w-full {{ Request::is(env('LINK_ADMIN')."/tahunan*")  ? 'btn-secondary' : 'btn-secondary-inactive'}}"> Data Tahunan</a>
        </li>
        <li>
            <a href="{{ route('admin-lifetime') }}" class="btn w-full {{ Request::is(env('LINK_ADMIN')."/lifetime*")  ? 'btn-secondary' : 'btn-secondary-inactive'}}"> Data Lifetime</a>
        </li>
        <li>
            <a href="{{ route('admin-pegawai') }}" class="btn w-full {{ Request::is(env('LINK_ADMIN')."/pegawai*")  ? 'btn-secondary' : 'btn-secondary-inactive'}}"> Data Pegawai</a>
        </li>
    </ul>
@endpush
@section('app')
    @yield('content')
@endsection
