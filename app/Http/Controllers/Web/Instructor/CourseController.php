<?php

namespace App\Http\Controllers\Web\Instructor;


use App\Http\Requests\Web\Instructor\Course\PrepareCourseVideoUploadRequest;
use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use App\Http\Requests\Web\Instructor\Course\UpdateCourseRequest;
use App\Http\Requests\Web\Instructor\Course\StoreCourseRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response;
use App\Events\CourseVideoPreparedToUpload;
use App\Repositories\VimeoVideoService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseJson;
use App\Models\Category;
use App\Models\Course;

class CourseController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Course $courseModel)
    {
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): \Illuminate\View\View
    {
        $this->authorize('index', $this->courseModel);
        $courses = auth()->user()->courses()->with('media')
            ->withCount(['rates', 'enrollments', 'lessons'])->withSum('lessons', 'duration')->withAvg('rates', 'rate')->get();
        return view('instructors.courses.index', compact('courses'));
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): \Illuminate\View\View
    {
        $this->authorize('create', $this->courseModel);
        $categories = Category::all();
        return view('instructors.courses.create', compact('categories'));
    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreCourseRequest $storeCourseRequest): JsonResponse
    {
        $this->authorize('store', $this->courseModel);
        $course = auth()->user()->courses()->create($storeCourseRequest->safe()->except(['image', '_token', 'course_prerequisites']));
        $course->addMediaFromRequest('image')->withResponsiveImages()->toMediaCollection('courses');
        if ($storeCourseRequest->filled('course_prerequisites')) {
            $course->createManyPrerequisites($course, $storeCourseRequest->validated()['course_prerequisites']);
        }
        return $this->responseJson([
            'next' => route('dashboard.instructors.courses.edit', $course->id),
            'message' => 'course created successfully',
            'type' => 'success'
        ], Response::HTTP_CREATED);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Course $course): \Illuminate\View\View
    {
        $this->authorize('edit', $course);
        $course->load('category','media','sections');
        $categories = Category::all();
        return view('instructors.courses.edit', compact('course', 'categories'));
    }

    /**
     * @throws AuthorizationException
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(UpdateCourseRequest $updateCourseRequest, Course $course): JsonResponse
    {
        $this->authorize('update', $course);
        $course->update($updateCourseRequest->validated());
        if ($updateCourseRequest->has('image')) {
            $course->addMediaFromRequest('image')->withResponsiveImages()->toMediaCollection('courses');
        }
        return $this->responseJson([
            'next' => route('dashboard.instructors.courses.edit', $course->id),
            'message' => 'course updated successfully',
            'type' => 'success'
        ], Response::HTTP_OK);
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Course $course): \Illuminate\View\View
    {
        $this->authorize('show', $course);
        $course->load(['prerequisites', 'video.folder:id,name', 'user:id,first_name,last_name', 'category', 'sections.lessons' => function ($query) {
            $query->orderBy('ordering', 'ASC')->withCount(['comments', 'views', 'likes']);
        }])->loadSum('lessons', 'duration')->loadAvg('rates', 'rate')->loadCount(['enrollments', 'rates', 'sections', 'lessons']);
        return view('instructors.courses.show', compact('course'));
    }


    /**
     * @throws AuthorizationException
     */
    public function courseVideo(Course $course): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        $this->authorize('courseVideo', $course);
        if ($course->getAttribute('has_video')) {
            return redirect()->action([self::class, 'show'], $course);
        }
        return view('instructors.courses.video.show', compact('course'));
    }

    /**
     * @throws AuthorizationException
     */
    public function courseVideoUpload(PrepareCourseVideoUploadRequest $prepareCourseVideoUploadRequest, Course $course): \Illuminate\Http\JsonResponse
    {
        $this->authorize('courseVideoUpload', $course);
        $response = VimeoVideoService::uploadVideo($prepareCourseVideoUploadRequest);
        if ($response) {
            CourseVideoPreparedToUpload::dispatch($course, $response);
            $uploadLink = $response['upload']['upload_link'];
            return $this->responseJson([
                'type' => 'success',
                'message' => 'video uploaded successfully',
                'form' => view('instructors.courses.video.upload-form', compact('uploadLink', 'course'))->render()
            ], Response::HTTP_CREATED);
        }
        return $this->responseJson(['errors' => ['error' => 'an error occurred while uploading the video to vimeo api']], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @throws AuthorizationException
     */
    public function courseVideoDelete(Course $course): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('courseVideoDelete', $course);
        VimeoVideoService::deleteVideo((int)$course->video->video_id);
        $course->video()->delete();
        if (request()->boolean('add_new') === true) {
            return to_route('dashboard.instructors.courses.video', $course);
        }
        return redirect()->back()->with('success', 'Video deleted successfully');
    }
}
