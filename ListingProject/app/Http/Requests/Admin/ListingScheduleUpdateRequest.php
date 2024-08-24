<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ListingScheduleUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'day' => ['required'],
            'start_time' => ['required', 'string'],
            'end_time' => ['required', 'string'],
            'status' => ['required', 'boolean'],
        ];
    }
}
