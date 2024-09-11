<?php

namespace App\Http\Requests\Web\Instructor\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use App\Rules\Instructor\UpdatePassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateInstructorProfileRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => ['nullable', 'string', Rule::requiredIf(function () {
                return $this->input('password');
            }), new UpdatePassword()],
            'password' => ['nullable', 'string', Password::min(8), 'confirmed'],
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);
        if ($this->filled('password')) {
            $validated['password'] = Hash::make($this->input('password'));
        }
        return $validated;
    }
}
