<?php

namespace App\Http\Requests\Web\Admin\Section;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255', Rule::unique('sections', 'name')->where(function ($query) {
                return $query->where('course_id', $this->input('course_id'));
            })],
            'course_id' => ['required', 'exists:courses,id'],
        ];
    }
}
