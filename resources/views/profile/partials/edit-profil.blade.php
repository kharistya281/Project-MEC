<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Siswa') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update informasi pribadimu.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('siswa.setting.update', $siswa->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="asalsekolah" :value="__('Asal Sekolah')" />
            <x-text-input id="asalsekolah" name="asalsekolah" type="text" class="mt-1 block w-full" :value="old('asal_sekolah', $siswa->asal_sekolah)"
                required autofocus autocomplete="asalsekolah" />
            <x-input-error class="mt-2" :messages="$errors->get('asalsekolah')" />
        </div>
        <div>
            <x-input-label for="notelpsiswa" :value="__('No Telp Siswa')" />
            <x-text-input id="notelpsiswa" name="notelpsiswa" type="text" class="mt-1 block w-full"
                :value="old('notelpsiswa', $siswa->notelp_siswa)" required autofocus autocomplete="notelpsiswa" />
            <x-input-error class="mt-2" :messages="$errors->get('notelpsiswa')" />
        </div>
        <div>
            <x-input-label for="alamatsiswa" :value="__('Alamat Siswa')" />
            <x-text-input id="alamatsiswa" name="alamatsiswa" type="text" class="mt-1 block w-full" :value="old('alamatsiswa', $alamat->alamat_detail ?? '-')"
                required autofocus autocomplete="alamatsiswa" aria-placeholder="Ex : Jl. Mawar No 3, RT:XX/RW/XX"/>
            <x-input-error class="mt-2" :messages="$errors->get('alamatsiswa')" />
        </div>
        <div class="">
            {{-- Provinsi --}}
            <div>
                <x-input-label for="provinsi" :value="__('Provinsi')" />
                <select id="provinsi" name="provinsi_id" class="mt-1 block w-full">
                    <option value="">-- Pilih Provinsi --</option>
                    {{-- opsi akan di-load lewat AJAX --}}
                </select>
                <input type="hidden" id="provinsi_nama" name="provinsi_nama">
            </div>

            {{-- Kabupaten --}}
            <div>
                <x-input-label for="kabupaten" :value="__('Kabupaten / Kota')" />
                <select id="kabupaten" name="kabupaten_id" class="mt-1 block w-full">
                    <option value="">-- Pilih Kabupaten / Kota --</option>
                </select>
                <input type="hidden" id="kabupaten_nama" name="kabupaten_nama">
            </div>
        </div>
        <div class="">
            {{-- Kecamatan --}}
            <div>
                <x-input-label for="kecamatan" :value="__('Kecamatan')" />
                <select id="kecamatan" name="kecamatan_id" class="mt-1 block w-full">
                    <option value="">-- Pilih Kecamatan --</option>
                </select>
                <input type="hidden" id="kecamatan_nama" name="kecamatan_nama">
            </div>

            {{-- Kelurahan --}}
            <div>
                <x-input-label for="kelurahan" :value="__('Kelurahan')" />
                <select id="kelurahan" name="kelurahan_id" class="mt-1 block w-full">
                    <option value="">-- Pilih Kelurahan --</option>
                </select>
                <input type="hidden" id="kelurahan_nama" name="kelurahan_nama">
            </div>
        </div>

        {{-- <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div> --}}

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
