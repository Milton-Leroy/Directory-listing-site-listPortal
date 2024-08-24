<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class SocialLinkUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'icon' => ['nullable', 'string'],
            'url' => ['required', 'url'],
            'status' => ['required', 'boolean']
        ];
    }
}
