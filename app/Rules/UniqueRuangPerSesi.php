<?php

namespace App\Rules;

use App\Models\JadwalTutor;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueRuangPerSesi implements ValidationRule
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
            ->where('id_ruang', $value)
            ->exists();

        if ($exists) {
            $fail('Ruang sudah terpakai di sesi ini.');
        }
    }
}
