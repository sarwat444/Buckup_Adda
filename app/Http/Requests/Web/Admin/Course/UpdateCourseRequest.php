<?php

namespace App\Http\Requests\Web\Admin\Course;

use Illuminate\Foundation\Http\FormRequest;
use App\Constant\CourseOptions;
use Illuminate\Validation\Rule;
use App\Enums\CourseLevel;

class UpdateCourseRequest extends FormRequest
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
            'is_top' => ['sometimes', Rule::in([CourseOptions::is_top, CourseOptions::not_top])],
            'is_active' => ['sometimes', Rule::in([CourseOptions::is_active, CourseOptions::not_active])],
            'is_free' => ['sometimes', Rule::in([CourseOptions::is_free, CourseOptions::not_free])],
            'image' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg|max:2000'],
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
        $validated = parent::validated();
        unset($validated['image']);
        if ($this->has('is_free') && $this->input('is_free') == CourseOptions::is_free) {
            $validated['price'] = 0;
            $validated['old_price'] = 0;
        }
        return $validated;
    }
}
