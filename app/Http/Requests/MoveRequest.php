<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'player_id' => 'required|integer|in:1,2',
            'position' => 'required|integer|min:0|max:8',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
