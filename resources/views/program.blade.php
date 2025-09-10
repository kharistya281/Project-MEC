@extends('layouts.app')
@section('content')
    <h3 class="font-bold text-4xl text-purple-700 text-center mt-7">Program Kelas</h3>
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 my-10 gap-8 px-4">
        @foreach ($programs as $program)
            <div class="bg-gray-100 rounded-xl border-gray-200 p-7 shadow-lg">
                <h5 class="font-bold text-2xl mt-2 text-purple-600">{{ $program->nama_program }}</h5>
                <h4 class="font-bold text-3xl mt-2">Rp {{ number_format($program->biaya_program, 0, '.', ',') }}</h4>
                <p class="text-gray-500 mt-3">{{ Str::words($program->desc_program, 10, '...') }}</p>
                <a href="/detail/{{ $program->id }}"
                    class="inline-block rounded-2xl border border-purple-500 bg-gradient-to-br from-purple-600 to-amber-300 px-4 py-2 mt-6 text-center font-medium text-white hover:opacity-80 mx-auto">Lihat
                    Detail</a>
            </div>
        @endforeach
    </div>
@endsection

<p></p>