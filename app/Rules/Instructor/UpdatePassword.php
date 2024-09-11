<?php

namespace App\Rules\Instructor;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UpdatePassword implements Rule
{
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return Hash::check($value, auth()->user()->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The current password is incorrect.';
    }
}
