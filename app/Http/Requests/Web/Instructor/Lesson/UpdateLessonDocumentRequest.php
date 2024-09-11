<?php

namespace App\Http\Requests\Web\Instructor\Lesson;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\LessonProvider;
use App\Enums\LessonType;

class UpdateLessonDocumentRequest extends FormRequest
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
            'embed' => ['required', 'url', 'active_url'],
            'is_free' => ['sometimes', 'boolean'],
            'is_publish' => ['sometimes', 'boolean'],
            'type' => ['required', Rule::in([LessonType::document->value])],
            'provider' => ['required', Rule::in([LessonProvider::url->value])],
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
