<?php

use App\Http\Livewire\Admin\Harian\HarianIndex;
use App\Http\Livewire\Admin\Lifetime\LifetimeIndex;
use App\Http\Livewire\Admin\Mingguan\MingguanIndex;
use App\Http\Livewire\Admin\Pegawai\PegawaiIndex;
use App\Http\Livewire\Admin\Tahunan\TahunanIndex;
use App\Http\Livewire\Home\Kantor\KantorIndex;
use App\Http\Livewire\Home\Pegawai\PegawaiIndex as HomePegawaiIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return redirect(route('kantor'));
});

Route::get('/kantor', KantorIndex::class)->name('kantor');
Route::get('/pegawai', HomePegawaiIndex::class)->name('pegawai');

Route::prefix(env('LINK_ADMIN'))->group(function () {
    Route::get('/', function () {return redirect(route('admin-harian'));});

    Route::get('/harian', HarianIndex::class)->name('admin-harian');
    Route::get('/mingguan', MingguanIndex::class)->name('admin-mingguan');
    Route::get('/tahunan', TahunanIndex::class)->name('admin-tahunan');
    Route::get('/lifetime', LifetimeIndex::class)->name('admin-lifetime');

    Route::get('/pegawai', PegawaiIndex::class)->name('admin-pegawai');
});
