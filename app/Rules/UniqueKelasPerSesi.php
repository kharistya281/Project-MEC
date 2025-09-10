<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\JadwalTutor;

class UniqueKelasPerSesi implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    private $hari;
    private $idSesi;

    public function __construct($hari, $idSesi)
    {
        $this->hari = $hari;
        $this->idSesi = $idSesi;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = JadwalTutor::where('hari', $this->hari)
            ->where('id_sesi', $this->idSesi)
            ->where('id_kelas', $value)
            ->exists();

        if ($exists) {
            $fail('Kelas sudah terpakai di sesi ini.');
        }
    }
}
