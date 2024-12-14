<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'site_name' => 'required|max:20',
            'facebook' => 'required|url',
            'youtube' => 'required|url',
            'linkedin' => 'required|url',
            'twitter' => 'required|url',
            'about_us_content' => 'required|string|min:20|max:1500',
        ];
    }
}
