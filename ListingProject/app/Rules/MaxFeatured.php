<?php

namespace App\Rules;

use App\Models\Listing;
use Auth;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxFeatured implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $packageFeaturedListingLimit = Auth::user()->subscription->package->number_of_featured_listing;

        $userFeaturedListingCount = Listing::where(['user_id' => Auth::user()->id, 'is_featured' => 1, 'status' => 1])->count();

        if ($packageFeaturedListingLimit === -1) {
            return;
        }

        if ($userFeaturedListingCount >= $packageFeaturedListingLimit) {
            $fail('You have reached the maximum limit of ' . $packageFeaturedListingLimit . ' featured listing.');
        }

    }
}
