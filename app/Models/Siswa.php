<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Kelas;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'nama',
        'nisn',
        'kelas_id',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'siswa_id');
    }

    public function raports()
    {
        return $this->hasMany(Raport::class);
    }
    // public function create()
    // {
    //     return view('siswa.create');
    // }
    // public function store(Request $request){
    //     $request->validate([
    //         'nama' => 'required|string',
    //         'kelas' => 'required|string',
    //         'tanggal_lahir' => 'required|date'
    //     ]);
    //     Siswa::create($request->all());
    //     return redirect('/siswa');
    // }
}
