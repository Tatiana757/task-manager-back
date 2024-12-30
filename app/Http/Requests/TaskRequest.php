<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:7000',
            'status' => 'required|in:pending,in_progress,completed',
            'responsible_user_id' => 'required|exists:users,id',
            'created_user_id' => 'nullable|exists:users,id',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => trans('task.title'),
            'description' => trans('task.description'),
            'status' => trans('task.status'),
            'responsible_user_id' => trans('task.responsible_user'),
            'created_user_id' => trans('task.created_user'),
        ];
    }
}
