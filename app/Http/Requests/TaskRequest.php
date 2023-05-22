<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required',
            'dueDate' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title required.',
            'title.max' => 'Title too long.',
            'description.required' => 'Must have a description.',
            'dueDate.required' => 'Task needs due date.',
            'dueDate.date' => 'Not valid date.'
        ];
    }
}
