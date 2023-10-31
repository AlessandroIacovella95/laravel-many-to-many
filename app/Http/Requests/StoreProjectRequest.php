<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'cover_image' => ['nullable', 'image', 'max:512'],
            'type_id' => ['nullable', 'exists:types,id'],
            'technologies' => ['nullable', 'exists:technologies,id'],
            'description' => ['required', 'string'],
            'url' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una stringa',

            'cover_image.image' => 'Il file caricato deve essere un\' immagine',
            'cover_image.max' => 'Il file caricato deve avere una dimensione inferiore a 512KB',

            'type_id.exists' => 'Il tipo inserito non è valido',

            'technologies.exists' => 'Le tecnologie inserita non sono valide',

            'description.required' => 'La descrizione è obbligatoria',
            'description.string' => 'La descrizione deve essere una stringa',

            'url.required' => 'L\'url è obbligatorio',
            'url.string' => 'L\'url deve essere una stringa',
        ];
    }
}