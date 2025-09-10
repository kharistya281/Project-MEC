<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use App\Models\Siswa;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index(){
        $siswa = Siswa::where('id_user', auth()->id())->first();
        $testimoni = Testimoni::where('id_siswa', $siswa->id)->first();

        return view('siswa.testimoni', compact('testimoni'));
    }

    public function store(Request $request){
        $request->validate([
            'status_diterima' => 'required | in:1,0',
            'testimoni' => 'required | string', 

            'diterima' => $request->status_diterima == '1' ? 'required|string' : 'nullable|string',
        ]);

        $siswa = Siswa::where('id_user', auth()->id())->first();

        Testimoni::create([
            'id_siswa' => $siswa->id,
            'is_accepted' => $request->status_diterima,
            'diterima_di' => $request->diterima,
            'pesan_kesan' => $request->testimoni,
        ]);

        return back()->with('success', 'Testimoni berhasil dikirim');
    }
}
