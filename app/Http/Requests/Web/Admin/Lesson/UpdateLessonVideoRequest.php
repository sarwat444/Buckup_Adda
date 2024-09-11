<?php

namespace App\Http\Requests\Web\Admin\Lesson;

use App\Enums\LessonProvider;
use App\Enums\LessonType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLessonVideoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:50'],
            'section_id' => ['required', Rule::exists('sections', 'id')->where(function ($query) {
                $query->where('course_id', $this->lesson->course_id);
            })],
            'is_free' => ['nullable', 'boolean'],
            'is_publish' => ['nullable', 'boolean'],
            'type' => ['required', Rule::in([LessonType::video->value])],
            'provider' => ['required', Rule::in([LessonProvider::vimeo->value])]
        ];
    }


    public function validated($key = null, $default = null)
    {
        return array_merge(parent::validated($key, $default), [
            'is_free' => $this->boolean('is_free'),
            'is_publish' => $this->boolean('is_publish'),
        ]);
    }

}
