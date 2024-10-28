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
        $rules = [
            'name' => ['required', 'string'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'hex' => ['required', 'string', 'regex:/^#?([0-9a-fA-F]{6}|[0-9a-fA-F]{3})$/'],
        ];

        //Eğer put veya delete metodu ise id kontrolü yapılacak.
        if ($this->isMethod('put')) {
            $rules = array_merge($rules, [
                'location' => ['required', 'integer', 'exists:locations,id,deleted_at,NULL'],
            ]);
        }

        return $rules;
    }


    //Body içerisine location id'sini ekledik ve bu id'yi kontrol etmeyi sağladık.
    public function all($keys = null): array
    {
        $data = parent::all();
        if ($this->isMethod('put') || $this->isMethod('delete')) {
            $data['location'] = $this->route('location');
        }
        return $data;
    }


    public function attributes(): array
    {
        return [
            'id' => 'Id',
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
