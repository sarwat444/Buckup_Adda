<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstructorRequestPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return !$user->hasInstructorRequest();
    }
}
