<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // public function penerimaanPegawais(){
    //     return $this->hasMany(PenerimaanPegawai::class);
    // }

    /**
     * Get all of the mingguan for the Pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mingguan()
    {
        return $this->hasMany(Mingguan::class);
    }
}
