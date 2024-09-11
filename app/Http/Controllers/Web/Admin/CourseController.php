<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\Admin\Course\PrepareCourseVideoUploadRequest;
use App\Http\Requests\Web\Admin\Course\UpdateCourseRequest;
use App\Http\Requests\Web\Admin\Course\StoreCourseRequest;
use App\Models\InstructorRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use App\Events\CourseVideoPreparedToUpload;
use Yajra\DataTables\Exceptions\Exception;
use App\Repositories\VimeoVideoService;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJson;
use App\Models\VimeoFolder;
use App\Models\Category;
use App\Models\Course;

class CourseController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Course $courseModel)
    {
    }

    public function index(): \Illuminate\View\View
    {
        return view('admins.courses.index');
    }

    public function create(): \Illuminate\View\View
    {
        $categories = Category::all();
        $instructors = InstructorRequest::with('user')->where('status' , 1 )->get()  ;
        return view('admins.courses.create', compact('categories' , 'instructors'));
    }

    /**
     * @throws Exception
     */
    public function coursesDatatables(): \Illuminate\Http\JsonResponse
    {
        $courses = $this->courseModel->with(['category', 'user']);
        return datatables()->eloquent($courses)
            ->addIndexColumn()
            ->addColumn('actions', function ($course) {
                return view('admins.courses.datatable.actions', compact('course'))->render();
            })->editColumn('image', function ($course) {
                return view('admins.courses.datatable.image', compact('course'))->render();
            })->rawColumns(['actions', 'image'])->toJson();
    }

    public function store(StoreCourseRequest $storeCourseRequest): \Illuminate\Http\JsonResponse
    {
        $course = $this->courseModel->create($storeCourseRequest->safe()->except(['image','cover' , '_token', 'course_prerequisites']));
        $course->addMediaFromRequest('image')->withResponsiveImages()->toMediaCollection('courses');
        if ($storeCourseRequest->filled('course_prerequisites')) {
            $course->createManyPrerequisites($course, $storeCourseRequest->validated()['course_prerequisites']);
        }
        return $this->responseJson([
            'type' => 'success',
            'message' => 'course created successfully',
            'next' => route('dashboard.courses.edit', $course->id)
            ], Response::HTTP_CREATED);
    }

    public function show(Course $course): \Illuminate\View\View
    {
        $course->load(['video.folder:id,name', 'user:id,first_name,last_name', 'category', 'sections.lessons' => function ($query) {
            $query->orderBy('ordering','ASC')->withCount(['comments','views']);
        }])->loadAvg('rates', 'rate')->loadCount(['enrollments', 'comments', 'rates', 'likes']);
        return view('admins.courses.show', compact('course'));
    }

    public function courseVideo(Course $course): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        if ($course->getAttribute('has_video')) {
            return redirect()->action([self::class, 'show'], $course);
        }
        $folders = VimeoFolder::all('id', 'name');
        return view('admins.courses.video.show', compact('course', 'folders'));
    }

    public function courseVideoUpload(PrepareCourseVideoUploadRequest $prepareCourseVideoUploadRequest, Course $course): \Illuminate\Http\JsonResponse
    {
        $response = VimeoVideoService::uploadVideo($prepareCourseVideoUploadRequest);
        if ($response) {
            CourseVideoPreparedToUpload::dispatch($course, $response);
            $uploadLink = $response['upload']['upload_link'];
            return $this->responseJson([
                'type' => 'success',
                'message' => 'video uploaded successfully',
                'form' => view('admins.courses.video.upload-form', compact('uploadLink', 'course'))->render()
            ], Response::HTTP_CREATED);
        }
        return $this->responseJson(['errors' => ['error' => 'an error occurred while uploading the video to vimeo api']], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function assignVideoCourseToFolder(Course $course): \Illuminate\Http\JsonResponse
    {
        $course = $course->load('video.folder');
        $assignToFolder = VimeoVideoService::assignVideoToFolder($course->video->folder->folder_id, $course->video->video_id);
        if ($assignToFolder) {
            return $this->responseJson(['type' => 'success', 'message' => 'video assigned to folder successfully'], Response::HTTP_OK);
        }
        return $this->responseJson(['type' => ['error' => 'an error occurred while assigning the video to folder']], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function courseVideoDelete(Course $course): \Illuminate\Http\RedirectResponse
    {
        VimeoVideoService::deleteVideo((int)$course->video->video_id);
        $course->video()->delete();
        if (request()->boolean('add_new') === true) {
            return to_route('dashboard.courses.video', $course);
        }
        return redirect()->back()->with('success', 'Video deleted successfully');
    }

    public function edit(Course $course): \Illuminate\View\View
    {
        $course->load('category','media','sections');
        $instructors = InstructorRequest::with('user')->where('status' , 1 )->get()  ;
        $categories = Category::all();
        return view('admins.courses.edit', compact('course', 'categories' , 'instructors'));
    }

    public function update(UpdateCourseRequest $updateCourseRequest, Course $course): \Illuminate\Http\JsonResponse
    {
        $course->update($updateCourseRequest->validated());
        if ($updateCourseRequest->has('image')) {
            $course->addMediaFromRequest('image')->withResponsiveImages()->toMediaCollection('courses');
        }
        return $this->responseJson(['type' => 'success', 'message' => 'course updated successfully'], Response::HTTP_OK);
    }
}
