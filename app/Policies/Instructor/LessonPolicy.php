<?php

namespace App\Policies\Instructor;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Lesson;
use App\Models\User;

class LessonPolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->isAcceptedInstructorRequest();
    }

    public function show(User $user, Lesson $lesson): bool
    {
        return $user->isAcceptedInstructorRequest() && $lesson->course->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isAcceptedInstructorRequest();
    }

    public function documentStore(User $user): bool
    {
        return $user->isAcceptedInstructorRequest();
    }

    public function edit(User $user, Lesson $lesson): bool
    {
        return $user->isAcceptedInstructorRequest() && $lesson->course->user_id === $user->id;
    }

    public function documentUpdate(User $user, Lesson $lesson): bool
    {
        return $user->isAcceptedInstructorRequest() && $lesson->course->user_id === $user->id;
    }

    public function videoUpdate(User $user, Lesson $lesson): bool
    {
        return $user->isAcceptedInstructorRequest() && $lesson->course->user_id === $user->id;
    }

    public function comments(User $user, Lesson $lesson): bool
    {
        return $user->isAcceptedInstructorRequest() && $lesson->course->user_id === $user->id;
    }

    public function likes(User $user, Lesson $lesson): bool
    {
        return $user->isAcceptedInstructorRequest() && $lesson->course->user_id === $user->id;
    }

    public function views(User $user, Lesson $lesson): bool
    {
        return $user->isAcceptedInstructorRequest() && $lesson->course->user_id === $user->id;
    }

    public function videoStore(User $user,Lesson $lesson): bool
    {
        return $user->isAcceptedInstructorRequest();
    }

    public function assignVideoLessonToFolder(User $user,Lesson $lesson): bool
    {
        return $user->isAcceptedInstructorRequest();
    }
}
