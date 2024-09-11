<?php

namespace App\Policies\Instructor;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectionPolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->isAcceptedInstructorRequest();
    }

    public function create(User $user): bool
    {
        return $user->isAcceptedInstructorRequest();
    }

    public function store(User $user): bool
    {
        return $user->isAcceptedInstructorRequest();
    }

    public function updateLessonsOrder(User $user, $section): bool
    {
        return $section->course->user_id === $user->id && $user->isAcceptedInstructorRequest();
    }

    public function edit(User $user, $section): bool
    {
        return $user->isAcceptedInstructorRequest() && $user->id === $section->course->user_id;
    }

    public function update(User $user, $section): bool
    {
        return $user->isAcceptedInstructorRequest() && $user->id === $section->course->user_id;
    }
}
