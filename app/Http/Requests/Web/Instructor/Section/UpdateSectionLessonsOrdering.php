<?php

namespace App\Http\Requests\Web\Instructor\Section;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSectionLessonsOrdering extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ordering' => ['required', 'array', 'min:2'],
            'ordering.*' => ['required', 'distinct', Rule::exists('lessons', 'id')->where(function ($query) {
                $query->where('section_id', $this->route('section')->id);
            })],
        ];
    }
}
