<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'body' => ['required', 'string', 'min:2', 'max:255'],
            'link' => ['required', 'string', 'min:2', 'max:255'],
            'amount' => ['required', 'min:2', 'max:255'],
        ];
    }
}
