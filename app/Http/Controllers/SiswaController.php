<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Program;
use App\Models\Alamat;
use App\Models\JadwalTutor;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::where('id_user', Auth::id())->firstOrFail();
        $jadwals = JadwalTutor::with(['kelas'])
            ->where('id_program', $siswa->id_program)
            ->paginate(3);
        $programs = Program::select('id', 'nama_program', 'biaya_program', 'desc_program')
            ->where('is_active', 1)->get();

        return view('siswa.siswa', compact('siswa', 'jadwals', 'programs'));
    }

    public function edit()
    {
        $user = auth()->user();
        $siswa = $user->siswa;
        $alamat = $siswa->alamat;

        return view('siswa.setting', compact('user', 'siswa', 'alamat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'asalsekolah' => 'required | string',
            'notelpsiswa' => 'required | string',
            'alamatsiswa' => 'required | string',
            'provinsi_id'  => 'required | integer',
            'provinsi_nama' => 'required | string',
            'kabupaten_id'  => 'required | integer',
            'kabupaten_nama' => 'required | string',
            'kecamatan_id'  => 'required | integer',
            'kecamatan_nama' => 'required | string',
            'kelurahan_id'  => 'required | integer',
            'kelurahan_nama' => 'required | string',
        ]);

        $siswa = Siswa::findOrFail($id);


        // Mengupdate nama di tabel user
        $user = $siswa->user;
        if ($user) {
            $user->update([
                'name' => $request->input('name')
            ]);
        }

        // Update atau create alamat
        $alamat = $siswa->alamat;

        if (!$alamat) {
            $alamat = new Alamat();
            $alamat->id_siswa = $siswa->id;
        }

        $alamat->provinsi_id = $request->input('provinsi_id');
        $alamat->provinsi_nama = $request->input('provinsi_nama');
        $alamat->kabupaten_id = $request->input('kabupaten_id');
        $alamat->kabupaten_nama = $request->input('kabupaten_nama');
        $alamat->kecamatan_id = $request->input('kecamatan_id');
        $alamat->kecamatan_nama = $request->input('kecamatan_nama');
        $alamat->kelurahan_id = $request->input('kelurahan_id');
        $alamat->kelurahan_nama = $request->input('kelurahan_nama');
        $alamat->alamat_detail = $request->input('alamatsiswa');

        $alamat->save();

        // Mengupdate data siswa
        $siswa->update([
            'id_alamat' => $alamat->id,
            'nama_siswa' => $request->input('name'),
            'asal_sekolah' => $request->input('asalsekolah'),
            'notelp_siswa' => $request->input('notelpsiswa')
        ]);

        return redirect()->route('siswa.setting')->with('success', 'Data siswa berhasil diperbarui');
    }
}
