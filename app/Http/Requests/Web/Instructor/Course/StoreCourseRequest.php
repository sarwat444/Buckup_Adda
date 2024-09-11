<?php

namespace App\Http\Requests\Web\Instructor\Course;

use Illuminate\Foundation\Http\FormRequest;
use App\Constant\CourseOptions;
use Illuminate\Validation\Rule;
use App\Enums\CourseLevel;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'title' => ['required', 'string', 'min:10', 'max:50'],
            'name' => ['required', 'string', 'min:10', 'max:50'],
            'description' => ['required', 'string', 'min:10', 'max:500'],
            'price' => ['required_if:is_free,0', 'numeric', 'min:5', 'max:10000000'],
            'old_price' => ['required_if:is_free,0', 'numeric', 'gt:price'],
            'level' => ['required', Rule::in([CourseLevel::beginner->value, CourseLevel::intermediate->value, CourseLevel::expert->value])],
            'is_active' => ['required', Rule::in([CourseOptions::is_active, CourseOptions::not_active])],
            'is_free' => ['required', Rule::in([CourseOptions::is_free, CourseOptions::not_free])],
            'course_prerequisites' => ['sometimes', 'array', 'min:1', 'max:10'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg|max:2000'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active') ? CourseOptions::is_active : CourseOptions::not_active,
            'is_free' => $this->has('is_free') ? CourseOptions::is_free : CourseOptions::not_free,
        ]);
    }


    public function validated($key = null, $default = null)
    {
        $validated = parent::validated();
        if ($this->filled('course_prerequisites')) {
            $validated =  array_merge($validated, [
                    'course_prerequisites' => array_map(function ($item) {
                        return ['course_prerequisites' => $item['course_prerequisites']];
                    }, $this->input('course_prerequisites'))
                ]);
        }

        if ($this->has('is_free') && $this->input('is_free') == CourseOptions::is_free) {
            $validated['price'] = 0;
            $validated['old_price'] = 0;
        }
        return $validated;
    }
}
