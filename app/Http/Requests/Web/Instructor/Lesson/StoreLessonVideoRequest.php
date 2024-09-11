<?php

namespace App\Http\Requests\Web\Instructor\Lesson;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\LessonProvider;
use App\Enums\LessonType;

class StoreLessonVideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:50'],
            'course_id' => ['required', Rule::exists('courses', 'id')],
            'section_id' => ['required', Rule::exists('sections', 'id')->where('course_id', request()->input('course_id'))],
            'is_free' => ['nullable', 'boolean'],
            'is_publish' => ['nullable', 'boolean'],
            'type' => ['required', Rule::in([LessonType::video->value])],
            'provider' => ['required', Rule::in([LessonProvider::vimeo->value])],
            'video' => ['required', 'mimes:mp4,mov,ogg,qt,webm,flv,avi,wmv,mpg,mpeg']
        ];
    }
}
