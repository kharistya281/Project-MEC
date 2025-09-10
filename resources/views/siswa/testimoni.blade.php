@extends('layouts.app')

@section('content')
    @include('components.sidebar')
    <main class="md:ml-64 p-6">
        <div class="flex items-center mb-7">
            <a href="{{ route('siswa.program') }}">
                <x-heroicon-s-arrow-left class="md:h-7 md:w-7 w-5 h-5" />
            </a>
            <h3 class="text-4xl font-bold text-gray-800 mx-4">Testimoni</h3>
        </div>


        @if ($testimoni)
            <div class="p-6 bg-green-100 text-green-700 rounded">
                Kamu sudah membagikan testimonimu. Terima kasih!
            </div>
        @else
            @if (session()->has('success'))
                <x-alert-success message="{{ session('success') }}"></x-alert-success>
            @endif

            {{-- Form Tambah Testimoni --}}
            <div class="mb-6 bg-white p-6 rounded-lg shadow">
                <form action="{{ route('siswa.program.testimoni.store') }}" method="POST">
                    @csrf
                    {{-- Pilihan diterima atau tidak --}}
                    <div class="mt-2"></div>
                    <x-input-label for="status_diterima" :value="__('Status Penerimaan')" class="text-start font-semibold text-gray-900" />
                    <select name="status_diterima" id="status_diterima"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Status Penerimaan</option>
                        <option value="1">Diterima</option>
                        <option value="0">Tidak Diterima</option>
                    </select>
                    <x-input-error :messages="$errors->get('status_diterima')" class="mt-2" />

                    {{-- Input jika diterima --}}
                    <div class="mt-2 hidden" id="field-diterima">
                        <x-input-label for="diterima" :value="__('Diterima di')" class="text-start font-semibold text-gray-900" />
                        <x-text-input id="diterima" class="block mt-1 w-full" type="text" name="diterima"
                            :value="old('diterima')" autofocus autocomplete="diterima" />
                        <x-input-error :messages="$errors->get('diterima')" class="mt-2" />
                    </div>

                    {{-- Testimoni --}}
                    <div class="mt-2">
                        <x-input-label for="testimoni" :value="__('Testimoni')" class="text-start font-semibold text-gray-900" />
                        <x-text-input id="testimoni" class="block mt-1 w-full" type="text" name="testimoni"
                            :value="old('testimoni')" required autofocus autocomplete="testimoni" />
                        <x-input-error :messages="$errors->get('testimoni')" class="mt-2" />
                    </div>
                    <x-primary-button>{{ __('Kirim') }}</x-primary-button>
                </form>
            </div>
        @endif
    </main>
@endsection
