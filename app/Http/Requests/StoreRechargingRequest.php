<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRechargingRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:2', 'max:200'],
            'size' => ['required', 'string', 'min:2', 'max:200'],
            'unit' => ['required', 'string', 'max:200'],
            'amount' => ['required', 'string', 'min:2', 'max:200'],
        ];
    }
}
