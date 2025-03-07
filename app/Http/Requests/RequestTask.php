<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestTask extends FormRequest
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
            'title' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\pL\s\-0-9]+$/u'],
            'description' => ['nullable', 'string', 'regex:/^[\pL\s\-\(\)\'"]+$/u'],
            'status' => ['required', 'string', 'in:pending,completed'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le titre est requis.',
            'title.string' => 'Le titre doit être une chaîne de caractères.',
            'title.min' => 'Le titre doit avoir au moins 3 caractères.',
            'title.max' => 'Le titre ne peut pas avoir plus de 255 caractères.',
            'title.regex' => 'Le titre de la tâche ne peut contenir que des lettres, des chiffres et des tirets.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.regex' => 'La description de la tâche ne peut contenir que des lettres, des espaces et des tirets.',
            'status.required' => 'Le statut est requis.',
            'status.string' => 'Le statut doit être une chaîne de caractères.',
            'status.in' => 'Le statut doit être valide.',
        ];
    }
}
