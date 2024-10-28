<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
//        'regex:/^#?([0-9a-fA-F]{6}|[0-9a-fA-F]{3})$/', ifadesi hex rengi kontrol eder.

        return [
            'name' => ['required', 'string'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'hex' => ['required', 'string', 'regex:/^#?([0-9a-fA-F]{6}|[0-9a-fA-F]{3})$/'],
        ];
    }
}
