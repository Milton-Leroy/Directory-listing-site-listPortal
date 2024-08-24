<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'title' => ['required', 'string', 'max:255', 'unique:blogs,title,'.$this->blog],
            'category' => ['required', 'integer'],
            'description' => ['required'],
            'is_popular' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
        ];
    }
}
