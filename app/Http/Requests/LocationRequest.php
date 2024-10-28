<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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


    public function attributes(): array
    {
        return [
            'name' => 'Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'hex' => 'Hex',
        ];
    }


    //Hata mesajlarını json dönmedi araştırmalarımda bu fonksiyon sorunu çözüyordu.
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
