<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'credits' => 'required',
            'name_teacher' => 'required',
            'pre_course' => 'required',
            'time_auto_work' => 'required',
            'time_direct_work' => 'required',
            'semester_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Name course is required',
            'credits.required' => 'The credits total are required',
            'name_teacher.required' => 'The Name Teacher is required',
            'pre_course.required' => 'The Prerequisite Course is required',
            'time_auto_work.required' => 'The Autonomous Work Time is required',
            'time_direct_work.required' => 'The Redirected Work Time is required',
            'semester_id.required' => 'The Semester is required',
        ];
    }
}
