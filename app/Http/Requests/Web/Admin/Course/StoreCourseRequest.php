<?php

namespace App\Http\Requests\Web\Admin\Course;

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
            'title' => ['required', 'string', 'min:10', 'max:50'],
            'url' => ['required', 'string', 'min:10', 'max:250'],
            'instructor_id'  => ['required'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'level' => ['required', Rule::in([CourseLevel::beginner->value, CourseLevel::intermediate->value, CourseLevel::expert->value])],
            'tags' => ['required', 'string', 'min:10', 'max:250'],
            'price' => ['required_if:is_free,0', 'numeric', 'min:5', 'max:10000000'],
            'old_price' => ['required_if:is_free,0', 'numeric', 'gt:price'],
            'is_free' => ['sometimes', Rule::in([CourseOptions::is_free, CourseOptions::not_free])],
            'is_active' => ['sometimes', Rule::in([CourseOptions::is_active, CourseOptions::not_active])],
            'is_top' => ['sometimes', Rule::in([CourseOptions::is_top, CourseOptions::not_top])],
            'description' => ['required', 'string', 'min:10', 'max:500'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg|max:2000'],
            'cover' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg|max:2000'],
            'video_type' => ['required'],
            'path' => ['required', 'string', 'min:10', 'max:250'],
            'course_prerequisites' => ['sometimes', 'array', 'min:1', 'max:10']
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_free' => $this->has('is_free') ? CourseOptions::is_free : CourseOptions::not_free,
            'is_active' => $this->has('is_active') ? CourseOptions::is_active : CourseOptions::not_active,
            'is_top' => $this->has('is_top') ? CourseOptions::is_top : CourseOptions::not_top,
        ]);
    }


    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);
        if ($this->filled('course_prerequisites')) {
            $validated = array_merge($validated, [
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
