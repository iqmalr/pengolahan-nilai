<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    use HasFactory;

    protected $table = 'raport';

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'semester',
        'tahun_ajaran',
        'tanggal_raport',
        'nilai_akhir'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'siswa_id');
    }
    protected static function booted()
    {
        static::saving(function ($raport) {
            $nilaiTugas = $raport->siswa->penilaians()
                ->where('siswa_id', $raport->siswa_id)
                ->where('jenis_penilaian', 'Tugas')
                ->avg('nilai');
            $nilaiUlanganHarian = $raport->siswa->penilaians()
                ->where('siswa_id', $raport->siswa_id)
                ->where('jenis_penilaian', 'Ulangan Harian')
                ->avg('nilai');
            // dd($nilaiTugas);
            $nilaiUTS = $raport->siswa->penilaians()
                ->where('siswa_id', $raport->siswa_id)
                ->where('jenis_penilaian', 'UTS')
                ->value('nilai');
            // dd($nilaiUTS);
            $nilaiUAS = $raport->siswa->penilaians()
                ->where('siswa_id', $raport->siswa_id)
                ->where('jenis_penilaian', 'UAS')
                ->value('nilai');
            // dd($nilaiUAS);
            // dd([
            //     'nilaiTugas' => $nilaiTugas,
            //     'nilaiUlanganHarian' => $nilaiUlanganHarian,
            //     'nilaiUTS' => $nilaiUTS,
            //     'nilaiUAS' => $nilaiUAS
            // ]);
            $nilaiAkhir = ($nilaiTugas * 0.10) + ($nilaiUlanganHarian * 0.15) + ($nilaiUTS * 0.35) + ($nilaiUAS * 0.40);
            // dd($nilaiAkhir);
            $raport->nilai_akhir = $nilaiAkhir;
        });
    }
    // protected static function booted()
    // {
    //     static::saving(function ($raport) {
    //         $nilaiTugas = $raport->penilaians()
    //             ->where(
    //                 'jenis_penilaian',
    //                 'Tugas'
    //             )
    //             ->avg('nilai');
    //         dd($nilaiTugas);
    //         $nilaiUTS = $raport->penilaians()
    //             ->where('jenis_penilaian', 'uts');

    //         $nilaiUAS = $raport->penilaians()
    //             ->where('jenis_penilaian', 'uas');

    //         $nilaiAkhir = ($nilaiTugas * 0.25) + ($nilaiUTS * 0.35) + ($nilaiUAS * 0.40);

    //         $raport->nilai_akhir = $nilaiAkhir;
    //     });
    // }
}
