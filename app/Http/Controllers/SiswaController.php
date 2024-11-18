<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function create()
    {
        $kelas = Kelas::all(); // Mengambil data kelas untuk dropdown
        return view('siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nisn' => 'required|string|unique:siswa,nisn',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P'
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.create')->with('success', 'Data siswa berhasil ditambahkan');
    }
}
// class SiswaController extends Controller
// {
//     public function create()
//     {
//         return view('siswa.create');
//     }
//     public function store(Request $request)
//     {
//         $request->validate([
//             'nama' => 'required|string',
//             'kelas' => 'required|string',
//             'tanggal_lahir' => 'required|date'
//         ]);
//         Siswa::create($request->all());
//         // return redirect('/siswa');
//         return redirect()->route('siswa.create')->with('success', 'Data siswa berhasil ditambahkan');
//     }
// }
