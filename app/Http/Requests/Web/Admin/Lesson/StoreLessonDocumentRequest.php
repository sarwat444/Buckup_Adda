<?php

namespace App\Http\Requests\Web\Admin\Lesson;

use App\Models\VimeoFolder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\LessonProvider;
use App\Enums\LessonType;

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
            'course_id' => ['required', Rule::exists('courses', 'id')],
            'section_id' => ['required', Rule::exists('sections', 'id')->where('course_id', request()->input('course_id'))],
            'is_free' => ['nullable', 'boolean'],
            'is_publish' => ['nullable', 'boolean'],
            'type' => ['required', Rule::in([LessonType::document->value])],
            'provider' => ['required', Rule::in([LessonProvider::url->value])],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated();
        return array_merge($validated, ['folder_id' => VimeoFolder::where('course_id', $validated['course_id'])->first()->id]);
    }
}
