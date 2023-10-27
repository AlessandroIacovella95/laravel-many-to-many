<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTechnologyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'label' => ['required', 'string'],
            'color' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'label.required' => 'Il titolo è obbligatorio',
            'label.string' => 'Il titolo deve essere una stringa',

            'color.string' => 'Il colore deve essere una stringa',
        ];
    }
}