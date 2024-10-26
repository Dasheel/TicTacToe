<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'position' => 'required|integer|min:0|max:8',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
