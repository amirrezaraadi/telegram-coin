<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnergyRequest extends FormRequest
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
            'title' => ['nullable', 'string', 'min:2', 'max:200'],
            'size' => ['nullable', 'string', 'max:200'],
            'unit' => ['nullable', 'string', 'max:200'],
            'amount' => ['nullable', 'string', 'max:200'],
        ];
    }
}
