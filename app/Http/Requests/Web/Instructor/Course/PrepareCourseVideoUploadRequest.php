<?php

namespace App\Http\Requests\Web\Instructor\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PrepareCourseVideoUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'video' => ['required', 'mimes:mp4,mov,ogg,qt,webm,flv,avi,wmv,mpg,mpeg'],
        ];
    }


    public function prepareForValidation()
    {
        $this->merge([
            'title' => $this->route('course')->title
        ]);
    }
}
