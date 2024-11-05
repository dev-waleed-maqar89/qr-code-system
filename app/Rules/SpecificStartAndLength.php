<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SpecificStartAndLength implements ValidationRule
{
    protected int $legnth;
    protected array $startings;
    public function __construct($legnth, $startings)
    {
        $this->legnth = $legnth;
        $this->startings = $startings;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strlen($value) != $this->legnth || !in_array(substr($value, 0, 1), $this->startings)) {
            $failMessage = 'من فضلك أدخل ';
            $failMessage .= __('validation/userregister.startingLength.' . $attribute);
            $failMessage .= " صحيح";
            $fail(__($failMessage));
        }
    }
}