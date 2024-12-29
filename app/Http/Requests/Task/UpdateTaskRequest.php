<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'      => ['nullable', 'string', 'min:3', 'max:255'],
            'priority'  => ['nullable', 'integer', 'min:1', 'max:1000'],
        ];
    }
}
