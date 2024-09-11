<?php

namespace App\Http\Requests\Web\Admin\Instructor;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\InstructorRequestStatus;
use Illuminate\Validation\Rule;

class UpdateInstructorStatus extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required',
                Rule::when(request()->input('status') === InstructorRequestStatus::pending->value, Rule::in([InstructorRequestStatus::rejected->value, InstructorRequestStatus::accepted->value])),
                Rule::when(request()->input('status') === InstructorRequestStatus::accepted->value, Rule::in([InstructorRequestStatus::accepted->value])),
                Rule::when(request()->input('status') === InstructorRequestStatus::rejected->value, Rule::in([InstructorRequestStatus::rejected->value])),
            ],
        ];
    }
}
