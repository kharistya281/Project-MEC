<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use App\Models\Kuis;
use App\Models\Soal;
use App\Models\JawabanKuis;
use App\Models\HasilKuis;

class KuisController extends Controller
{
    public function index()
    {
        $kuiss = Kuis::with('soal')->get();
        $totalSoal = $kuiss->sum(function($kuis){
            return $kuis->soal->count();
        });
        return view('siswa.kuis', compact('kuiss', 'totalSoal'));
    }

    public function detailKuis($id)
    {
        $siswaId = Auth::user()->siswa->id;

        $isDone = JawabanKuis::where('id_kuis', $id)
            ->where('id_siswa', $siswaId)
            ->exists();

        if($isDone){
            return redirect()->route('siswa.hasil', $id)
            ->with('nfo', 'Kuis ini sudah kamu kerjakan');
        }

        $kuis = Kuis::findOrFail($id);
        
        $soals = Kuis::with('soal')->findOrFail($id);
        return view('siswa.detail-kuis', compact('soals', 'kuis'));
    }
    
    public function submit(Request $request, $id)
    {
        $siswaId = Auth::user()->siswa->id;

        $isDone = JawabanKuis::where('id_kuis', $id)
            ->where('id_siswa', $siswaId)
            ->exists();
    
        if($isDone){
            return redirect()->route('siswa.hasil', $id)
            ->with('nfo', 'Kuis ini sudah kamu kerjakan');
        }

        $soals = Soal::where('id_kuis', $id)->get();
        // dd($soals);

        foreach ($soals as $index => $soal) {
            $jawaban = $request->input("jawaban_$index");

            JawabanKuis::create([
                'id_siswa' => $siswaId,
                'id_kuis' => $id,
                'id_soal' => $soal->id,
                'jawaban_siswa' => $jawaban,
                'jawaban_benar' => $soal->jawaban_benar,
                'is_benar' => $jawaban === $soal->jawaban_benar,
            ]);
        }

        return redirect()->route('siswa.kuis.hasil', $id)->with('success', 'Jawaban berhasil disimpan');
    }

    public function hasil($id)
    {
        $siswaId = Auth::user()->siswa->id;

        $jawabanKuis = JawabanKuis::where('id_kuis', $id)
            ->where('id_siswa', $siswaId)
            ->with('soal')
            ->get();

        $jawabanBenar = $jawabanKuis->where('is_benar', true)->count();
        $jawabanSalah = $jawabanKuis->where('is_benar', false)->count();
        $totalSoal = $jawabanKuis->count();

        return view('siswa.hasil', compact('jawabanBenar', 'jawabanSalah', 'totalSoal', 'jawabanKuis'));
    }
}
