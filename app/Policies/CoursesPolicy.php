<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use App\Models\Course;
use App\Models\User;

class CoursesPolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->isAcceptedInstructorRequest();
    }

    public function watchCourse(User $user, $course): bool
    {
        return $user->coursesEnrolled()->where('course_id', $course->id)->exists();
    }

    public function enroll(User $user, $course): Response|bool
    {
        if ($user->coursesEnrolled()->where('course_id', $course->id)->doesntExist() && $course->user_id !== $user->id) {
            return true;
        }
        return Response::deny('You are not allowed to enroll in this course');
    }

    public function watchLesson(User $user, $course): bool
    {
        return $user->coursesEnrolled()->where('course_id', $course->id)->exists();
    }

    public function watchLessonProgress(User $user, $course): bool
    {
        return $user->coursesEnrolled()->where('course_id', $course->id)->exists();
    }

    public function completeLesson(User $user, $course): bool
    {
        return $user->coursesEnrolled()->where('course_id', $course->id)->exists();
    }

    public function edit(User $user, Course $course): bool
    {
        return $user->isAcceptedInstructorRequest() && $user->id === $course->user_id;
    }

    public function create(User $user): bool
    {
        return $user->isAcceptedInstructorRequest();
    }

    public function show(User $user, Course $course): bool
    {
        return $user->isAcceptedInstructorRequest() && $user->id === $course->user_id;
    }

    public function update(User $user, Course $course): bool
    {
        return $user->isAcceptedInstructorRequest() && $user->id === $course->user_id;
    }

    public function store(User $user): bool
    {
        return $user->isAcceptedInstructorRequest();
    }

    public function courseVideo(User $user, Course $course): bool
    {
        return $user->isAcceptedInstructorRequest() && $user->id === $course->user_id;
    }

    public function courseVideoUpload(User $user, Course $course): bool
    {
        return $user->isAcceptedInstructorRequest() && $user->id === $course->user_id;
    }

    public function courseVideoDelete(User $user, Course $course): bool
    {
        return $user->isAcceptedInstructorRequest() && $user->id === $course->user_id;
    }

    public function courseSections(User $user, Course $course): bool
    {
        return $user->isAcceptedInstructorRequest() && $user->id === $course->user_id;
    }
}
