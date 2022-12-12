<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'value' => 'required',
            'total_credits' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A title is required',
            'description.required' => 'A description is required',
            'duration.required' => 'The duration is required',
            'value.required' => 'A value is required',
            'total_credits.required' => 'The total credits is required',
        ];
    }
}
