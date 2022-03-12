<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mingguan extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the pegawai that owns the Mingguan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
