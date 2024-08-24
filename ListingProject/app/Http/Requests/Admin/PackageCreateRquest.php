<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageCreateRquest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required','in:free,paid'],
            'name' => ['required','string', 'max:50'],
            'price' => ['required','numeric'],
            'number_of_days' => ['required','integer'],
            'number_of_listing' => ['required','integer'],
            'number_of_photos' => ['required','integer'],
            'number_of_video' => ['required','integer'],
            'number_of_amenities' => ['required','integer'],
            'number_of_featured_listing' => ['required','integer'],
            'show_at_home'=> ['required','boolean'],
            'status'=> ['required','boolean'],
        ];
    }
}
