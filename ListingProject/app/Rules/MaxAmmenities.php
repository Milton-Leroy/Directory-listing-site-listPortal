<?php

namespace App\Rules;

use Auth;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxAmmenities implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $packageAmenitiesLimit = Auth::user()->subscription->package->number_of_amenities;

        if($packageAmenitiesLimit === -1){
            return;
        }

        if (count($value) > $packageAmenitiesLimit) {
            $fail('You can only use' . $packageAmenitiesLimit . ' amenities.');
        }


    }
}
