<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class OurFeatureCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'icon' => ['required'],
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ];
    }
}
