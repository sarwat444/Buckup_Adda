<?php

namespace App\Http\Controllers\Web\Site;

use App\Filters\Site\Course\{
    InstructorFilter,
    NormalSortFilter,
    TitleSortFilter,
    CategoryFilter,
    DurationFilter,
    PriceFilter,
    LevelFilter,
    RateFilter
};
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Pipeline\Pipeline;
use App\Traits\ResponseJson;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;

class CourseController extends Controller
{
    use ResponseJson;

    public function __construct
    (
        private readonly Course $courseModel
    )
    {
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        $courses = app(Pipeline::class)
            ->send($this->courseModel->query()->ActiveCourses()->with(['category', 'media'])->withAvg('rates', 'rate')->withSum('lessons', 'duration')->withCount('rates', 'lessons'))
            ->through([
                InstructorFilter::class,
                NormalSortFilter::class,
                TitleSortFilter::class,
                DurationFilter::class,
                CategoryFilter::class,
                LevelFilter::class,
                PriceFilter::class,
                RateFilter::class,
            ])->thenReturn()->simplePaginate(10);
        $categories = Category::all();
        $instructors = User::OnlyInstructors()->select(['id','first_name','last_name'])->get();
        return view('site.courses.index')->with(['courses' => $courses, 'categories' => $categories, 'instructors' => $instructors]);
    }

    public function show(Course $course): \Illuminate\Contracts\View\View
    {
        abort_if(!$course->IsActive(), Response::HTTP_NOT_FOUND);
        $course->load(['prerequisites', 'lastLesson:id,course_id,created_at', 'video.folder:id,name', 'user:id,first_name,last_name', 'category', 'sections.lessons' => function ($query) {
            $query->orderBy('ordering', 'ASC')->withCount(['comments', 'views']);
        }])->loadAvg('rates', 'rate')->loadSum('lessons', 'duration')->loadCount(['lessons', 'enrollments', 'comments', 'rates', 'likes']);
        return view('site.courses.show', compact('course'));
    }

    public function course(Course $course): \Illuminate\Http\JsonResponse
    {
        $course->load(['category:id,name', 'prerequisites', 'sections.lessons'])
            ->loadSum('lessons', 'duration')
            ->loadAvg('rates', 'rate')
            ->loadCount('rates', 'lessons');
        return $this->responseJson(['data' => $course], Response::HTTP_OK);
    }
}
