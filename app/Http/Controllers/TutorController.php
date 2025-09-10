<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutor;
use App\Models\Program;
use App\Models\Testimoni;

class TutorController extends Controller
{
    public function index(){
        $tutors = Tutor::limit(6)->get();
        $programs = Program::where('is_active', 1)->get();
        $testimonies = Testimoni::where('is_accepted', 1)->limit(6)->get();

        return view('home', compact('tutors', 'programs', 'testimonies'));
    }
}
