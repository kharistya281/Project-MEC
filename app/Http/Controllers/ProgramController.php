<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Siswa;
use App\Models\JadwalTutor;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::where('is_active', 1)->get();
        return view('program', compact('programs'));
    }

    public function view()
    {
        $programs = Program::where('is_active', 1)->get();
        return view('home', compact('programs'));
    }

    public function detail($id)
    {
        $program = Program::findOrFail($id);
        return view('detail', compact('program'));
    }

    public function detailSiswa($id)
    {
        $detailProgram = Program::with('materi')->findOrFail($id);
        return view('siswa.detail', compact('detailProgram'));
    }

    public function programSiswa()
    {
        $siswa = Siswa::where('id_user', Auth::id())->firstOrFail();

        $programs = Pendaftaran::with('program')
            ->where('id_siswa', $siswa->id)
            ->get()
            ->pluck('program');

        $programId = $programs->pluck('id')->all();
        // $programId = $programs->first()->all();

        // dd($programId);

        $jadwals = JadwalTutor::with(['materi', 'ruang', 'sesi'])
            ->whereIn('id_program', $programId)
            ->orderBy('hari')
            ->get()
            ->groupBy('id_program');

        // dd($jadwals);

        return view('siswa.program-siswa', compact('programs', 'jadwals'));
    }
}
