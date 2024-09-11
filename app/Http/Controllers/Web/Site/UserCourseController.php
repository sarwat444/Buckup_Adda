<?php

namespace App\Http\Controllers\Web\Site;

use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Events\LessonViewedByUser;
use App\Traits\ResponseJson;
use App\Models\Section;
use App\Models\Lesson;
use App\Models\Course;

class UserCourseController extends Controller
{
    use ResponseJson;

    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    public function myCourses(): \Illuminate\Contracts\View\View
    {
        $courses = auth()->user()->coursesEnrolled()->with(['category', 'media'])->withAvg('rates', 'rate')->withSum('lessons', 'duration')->withCount('rates', 'lessons')->simplePaginate(10);
        return view('site.users.courses.my-courses', compact('courses'));
    }

    /**
     * @throws AuthorizationException
     */
    public function watchCourse(Course $course): \Illuminate\Contracts\View\View
    {
        $this->authorize('watchCourse', $course);
        $course->load(['media', 'prerequisites', 'lastLesson:id,course_id,created_at', 'video.folder:id,name', 'user:id,first_name,last_name', 'category', 'sections.lessons.lesson_progress', 'sections.lessons' => function ($query) {
            $query->orderBy('ordering', 'ASC')->withCount(['comments', 'views']);
        }])->loadAvg('rates', 'rate')->loadSum('lessons', 'duration')->loadCount(['course_progress','lessons', 'enrollments', 'comments', 'rates', 'likes']);
        return view('site.users.courses.watch', compact('course'));
    }

    /**
     * @throws AuthorizationException
     */
    public function enroll(Course $course): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('enroll', $course);
        $course->enrollments()->create(['user_id' => auth()->id()]);
        return redirect()->route('site.courses.me')->with('success', 'You have successfully enrolled in the course');
    }

    /**
     * @throws AuthorizationException
     */
    public function watchLesson(Course $course, Section $section, Lesson $lesson): \Illuminate\Http\JsonResponse
    {
        $this->authorize('watchLesson', $course);
        $lesson->lesson_progress()->updateOrCreate(['user_id' => auth()->id(),'lesson_id' => $lesson->getAttribute('id'), 'course_id' => $course->getAttribute('id'), 'section_id' => $section->getAttribute('id')]);
        event(new LessonViewedByUser($lesson,$course));
        $lesson->load('lesson_progress');
        return $this->responseJson(['data' => $lesson], Response::HTTP_OK);
    }

    /**
     * @throws AuthorizationException
     */
    public function watchLessonProgress(Course $course, Section $section, Lesson $lesson): \Illuminate\Http\JsonResponse
    {
        $this->authorize('watchLessonProgress', $course);
        $lesson->lesson_progress()->updateOrCreate([
                'user_id' => auth()->id(),
                'lesson_id' => $lesson->getAttribute('id'),
                'course_id' => $course->getAttribute('id'),
                'section_id' => $section->getAttribute('id')]
            , ['is_completed' => request()->boolean('is_completed'), 'time_completed' => request()->input('time_completed')]);
        $lesson->load('lesson_progress');
        return $this->responseJson(['data' => $lesson], Response::HTTP_OK);
    }

    /**
     * @throws AuthorizationException
     */
    public function completeLesson(Course $course, Section $section, Lesson $lesson): \Illuminate\Http\JsonResponse
    {
        $this->authorize('completeLesson', $course);
        $lesson->lesson_progress()->update(['is_completed' => true,'time_completed' => request()->input('time_completed')]);
        return $this->responseJson([], Response::HTTP_NO_CONTENT);
    }
}
