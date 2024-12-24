<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        'nilai_akhir',
        'mata_pelajaran_id'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mata_pelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'siswa_id')
            ->where('kelas_id', $this->kelas_id)
            ->where('semester', $this->semester)
            ->where('mata_pelajaran_id', $this->mata_pelajaran_id);
    }

    protected static function booted()
    {
        static::saving(function ($raport) {
            // Gunakan query yang sudah ada atau langsung ambil dari raw penilaians
            $penilaians = Penilaian::where('siswa_id', $raport->siswa_id)
                ->where('kelas_id', $raport->kelas_id)
                ->where('semester', $raport->semester)
                ->where('mapel_id', $raport->mata_pelajaran_id)
                ->get();

            // Hitung rata-rata nilai berdasarkan jenis penilaian
            $nilaiTugas = $penilaians->where('jenis_penilaian', 'Tugas')->avg('nilai') ?? 0;
            $nilaiUlanganHarian = $penilaians->where('jenis_penilaian', 'Ulangan Harian')->avg('nilai') ?? 0;
            $nilaiUTS = $penilaians->where('jenis_penilaian', 'UTS')->avg('nilai') ?? 0;
            $nilaiUAS = $penilaians->where('jenis_penilaian', 'UAS')->avg('nilai') ?? 0;
            // dd([
            //     'Siswa ID' => $raport->siswa_id,
            //     'Kelas ID' => $raport->kelas_id,
            //     'Semester' => $raport->semester,
            //     'Mata Pelajaran ID' => $raport->mata_pelajaran_id,
            //     'Nilai Tugas' => $nilaiTugas,
            //     'Nilai Ulangan Harian' => $nilaiUlanganHarian,
            //     'Nilai UTS' => $nilaiUTS,
            //     'Nilai UAS' => $nilaiUAS,
            // ]);
            $nilaiAkhir = (
                ($nilaiTugas * 0.10) +
                ($nilaiUlanganHarian * 0.15) +
                ($nilaiUTS * 0.35) +
                ($nilaiUAS * 0.40)
            );
            // dd($nilaiAkhir);
            // Set nilai akhir pada raport
            $raport->nilai_akhir = round($nilaiAkhir, 2);
        });
    }

    // Metode tambahan untuk fleksibilitas perhitungan
    public function hitungNilaiAkhir()
    {
        $penilaians = $this->penilaians;

        $nilaiTugas = $penilaians->where('jenis_penilaian', 'Tugas')->avg('nilai') ?? 0;
        $nilaiUlanganHarian = $penilaians->where('jenis_penilaian', 'Ulangan Harian')->avg('nilai') ?? 0;
        $nilaiUTS = $penilaians->where('jenis_penilaian', 'UTS')->avg('nilai') ?? 0;
        $nilaiUAS = $penilaians->where('jenis_penilaian', 'UAS')->avg('nilai') ?? 0;

        return round(
            ($nilaiTugas * 0.10) +
                ($nilaiUlanganHarian * 0.15) +
                ($nilaiUTS * 0.35) +
                ($nilaiUAS * 0.40),
            2
        );
    }
}
