@extends('layouts.app')
@section('content')
    {{-- Hero start --}}
    <section class="container relative mx-auto md:flex md:justify-between md:px-5 items-center my-3 space-x-4">
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-[80vh]">
                <!-- Item 1 -->
                <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                    <img src="{{ asset('/img/carousel01.png') }}" class="absolute w-full h-[80vh] object-cover top-0 left-0"
                        alt="...">
                    {{-- <p class="absolute z-50 text-black  font-bold top-10 left-10">Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Nulla, aperiam!</p> --}}
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                    <img src="{{ asset('/img/carousel02.png') }}" class="absolute w-full h-[80vh] object-cover top-0 left-0"
                        alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                    <img src="{{ asset('/img/carousel03.png') }}" class="absolute w-full h-[80vh] object-cover top-0 left-0"
                        alt="...">
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                    data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                    data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                    data-carousel-slide-to="2"></button>
            </div>
            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    </section>
    {{-- Hero end --}}
    {{-- Program start --}}
    <section class="bg-purple-500 border-solid border-5 border-purple-50 mx-auto p-10 my-0 mt-40 text-center mb-3"
        id="program">
        <h3 class="text-4xl font-bold text-white mt-15">Program Kami</h3>
        <p class="text-gray-100 mt-7">Bergabung dengan program-program terbaik kami.</p>
        <div class="container mx-auto flex flex-col md:flex-row mt-10 gap-y-6 md:gap-x-8">
            {{-- program 1 --}}
            @foreach ($programs as $program)
                <div class="bg-gray-100 md:w-1/3 mb-4 rounded-xl border-gray-200 p-7 shadow-lg">
                    <h5 class="font-bold text-2xl mt-2 text-purple-600">{{ $program->nama_program }}</h5>
                    <h4 class="font-bold text-3xl mt-2">Rp {{ number_format($program->biaya_program, 0, '.', ',') }}</h4>
                    <p class="text-gray-500 mt-3">{{ Str::words($program->desc_program, 10, '...') }}</p>
                    <a href="/detail/{{ $program->id }}"
                        class="inline-block rounded-2xl border border-purple-500 bg-gradient-to-br from-purple-600 to-amber-300 px-8 py-3 mt-6 text-center font-medium text-white hover:opacity-80 mx-auto">Lihat
                        Detail</a>
                </div>
            @endforeach
        </div>
        <a href=""
            class="inline-block rounded-2xl border border-violet-800 bg-white px-8 py-3 text-center font-medium text-purple-600 hover:bg-gray-100 mt-10">Lihat
            Selengkapnya</a>
    </section>
    {{-- Program end --}}
    {{-- Tutor start --}}
    <section class="container mx-auto text-center p-10 scroll-mt-20 " id="tutor">
        <h3 class="text-4xl font-bold text-gray-700">Belajar dari Tutor yang Berpengalaman</h3>
        <div class="md:flex md:justify-center mt-8">
            {{-- card 1 --}}
            @foreach ($tutors as $tutor)
                <div class="bg-gray-100 mb:w-1/6 max-w-xs mb-6 rounded-2xl border border-gray-300 p-4 shadow-lg mx-4">
                    <img src="{{ asset('storage/' . $tutor->foto_tutor) }}" alt=""
                        class="w-full h-30 object-cover rounded-lg mb-4">
                    <h4 class="font-bold text-purple-600 text-lg -mt-1 text-start">{{ $tutor->nama_tutor }}</h4>
                    <p class="font-semibold text-gray-500 text-sm text-start">{{ $tutor->kesibukan_tutor }}</p>
                </div>
            @endforeach
        </div>
    </section>
    {{-- Tutor end --}}
    {{-- Testimoni start --}}
    <section class="container mx-auto text-center p-10 scroll-mt-20" id="testimoni">
        <h3 class="text-4xl font-bold text-gray-700">Testimoni Alumni</h3>
        <div class="md:flex md:justify-center mt-10">
            {{-- card 1 --}}
            @foreach ($testimonies as $testimoni)
                <div class="bg-gray-100 md:w-1/3 mb-6 rounded-2xl border border-gray-200 p-6 shadow-lg w-80 mx-4">
                    <div class="flex mb-2">
                        {{-- <img src="{{ asset('img/person1.png') }}" alt=""
                        class="rounded-xl w-14 h-14 border-solid border-3 border-purple-400"> --}}
                        <div class="text-start">
                            <h4 class="font-bold text-purple-600 text-lg -mt-1">{{ $testimoni->siswa->nama_siswa }}</h4>
                            <p class="font-bold text-gray-500 text-sm -mt-1">{{ $testimoni->diterima_di }}</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-justify text-sm">{{ $testimoni->pesan_kesan }}</p>
                </div>
            @endforeach
        </div>
    </section>
    {{-- Testimoni end --}}
    {{-- Tentang start --}}
    <section
        class="bg-purple-500 border-solid border-5 border-purple-50 mx-auto p-10 my-6 mt-40 text-center md:flex md:justify-between items-start"
        id="aboutus">
        <div class="flex flex-col md:flex-row md:space-x-4">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d756.4221895132655!2d111.44694052494565!3d-7.401166918956115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79e74800611017%3A0xc8e163f3ce8b8c85!2smillenial%20english%20club%20ngawi!5e0!3m2!1sen!2sid!4v1747574493873!5m2!1sen!2sid"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                class="md:w-3/6 w-full h-64 md:h-auto mb-5 rounded-lg"></iframe>
            {{-- about us --}}
            <div class="md:w-3/6 text-left ml-5">
                <h3 class="text-4xl font-bold text-white md:mb-10 mb-5 text-center">Tentang Kami</h3>
                <p class="text-gray-100 leading-relaxed">Millenial Education Center didirikan dengan tujuan untuk
                    menyediakan layanan bimbingan pendidikan offline maupun online
                    yang berkualitas tinggi. Dengan pengalaman yang luas dan
                    dedikasi terhadap keberhasilan siswa, kami telah membantu
                    puluhan ribu murid lolos dalam tes ujian masuk kuliah, TNI, POLRI,
                    kedinasan, dan ikatan dinas. Berlokasi di Ngawi, Jawa Timur, kami
                    berkomitmen untuk memperluas jangkauan dan terus
                    meningkatkan layanan kami hingga ke seluruh Indonesia.</p>
                <div class="h-px mt-3 bg-white"></div>
                <h5 class="font-semibold text-lg text-white mt-2">Tetap Terhubung Dengan Kami</h5>
                <div class="flex justify-start gap-3 mb-5">
                    <a href="htps://wa.me/6285655659084" class="">
                        <img src="{{ asset('img/social3.png') }}" alt=""
                            class="md:w-10 w-8 ml-3 mr-3 mt-2 hover:opacity-30">
                    </a>
                    <a href="https://www.instagram.com/mec_ngawi/" class="">
                        <img src="{{ asset('img/social1.png') }}" alt=""
                            class="md:w-10 w-8 ml-3 mr-3 mt-2 hover:opacity-30">
                    </a>
                    <a href="" class="">
                        <img src="{{ asset('img/social2.png') }}" alt=""
                            class="md:w-10 w-8 ml-3 mr-3 mt-2 hover:opacity-30">
                    </a>
                </div>
            </div>
        </div>
    </section>
    {{-- Tentang end --}}
@endsection