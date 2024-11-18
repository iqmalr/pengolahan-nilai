<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'nama_mapel',
        'deskripsi',
        'guru_id'
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
