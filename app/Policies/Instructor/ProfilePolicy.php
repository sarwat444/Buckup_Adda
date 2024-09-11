<?php

namespace App\Policies\Instructor;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

class ProfilePolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->isAcceptedInstructorRequest();
    }

    public function edit(User $user): bool
    {
        return $user->isAcceptedInstructorRequest();
    }
}
