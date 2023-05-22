<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskEditRequest extends FormRequest
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
            'due_date' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title required.',
            'title.max' => 'Title too long.',
            'description.required' => 'Must have a description.',
            'due_date.required' => 'Task have a due.',
            'due_date.date' => 'Not valid date.'
        ];
    }
}
