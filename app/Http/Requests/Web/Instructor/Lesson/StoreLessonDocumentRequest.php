<?php

namespace App\Http\Requests\Web\Instructor\Lesson;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\LessonProvider;
use App\Enums\LessonType;
use App\Models\Course;

class StoreLessonDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:50'],
            'embed' => ['required', 'url', 'active_url'],
            'course_id' => ['required', Rule::exists('courses', 'id')->where(function ($query) {
                $query->where('user_id', auth()->id());
            })],
            'section_id' => ['required', Rule::exists('sections', 'id')->where('course_id', request()->input('course_id'))],
            'is_free' => ['sometimes', 'boolean'],
            'is_publish' => ['sometimes', 'boolean'],
            'type' => ['required', Rule::in([LessonType::document->value])],
            'provider' => ['required', Rule::in([LessonProvider::url->value])]
        ];
    }


    public function validated($key = null, $default = null): array
    {
        return array_merge(parent::validated($key, $default), ['folder_id' => Course::find($this->input('course_id'))->with('folder')->first()->folder->id]);
    }
}
