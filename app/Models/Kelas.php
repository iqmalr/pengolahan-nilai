<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'wali_kelas',
        'tahun_ajaran'
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'kelas_id');
    }
}
