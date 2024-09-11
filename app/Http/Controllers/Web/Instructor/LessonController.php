<?php

namespace App\Http\Controllers\Web\Instructor;

use App\Http\Requests\Web\Instructor\Lesson\UpdateLessonDocumentRequest;
use App\Http\Requests\Web\Instructor\Lesson\StoreLessonDocumentRequest;
use App\Http\Requests\Web\Instructor\Lesson\UpdateLessonVideoRequest;
use App\Http\Requests\Web\Instructor\Lesson\StoreLessonVideoRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response;
use App\Listeners\VideoLessonPreparedToUpload;
use App\Events\LessonVideoPreparedToUpload;
use App\Repositories\VimeoVideoService;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJson;
use App\Enums\LessonType;
use App\Models\Course;
use App\Models\Lesson;

class LessonController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Lesson $lessonModel)
    {
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): \Illuminate\View\View
    {
        $this->authorize('index', $this->lessonModel);
        $lessons = auth()->user()->lessons()->with(['folder:id,name', 'course:id,name', 'section:id,name'])->get();
        return view('instructors.lessons.index', compact('lessons'));
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        $this->authorize('create', $this->lessonModel);
        if (view()->exists('admins.lessons.create.' . request()->input('type'))) {
            $courses = auth()->user()->courses()->get();
            return view('instructors.lessons.create.' . request()->input('type'), compact('courses'));
        }
        return to_route('dashboard.instructors.lessons.index')->with('error', 'invalid lesson type');
    }

    /**
     * @throws AuthorizationException
     */
    public function documentStore(StoreLessonDocumentRequest $storeLessonDocumentRequest): \Illuminate\Http\JsonResponse
    {
        $this->authorize('documentStore', $this->lessonModel);
        $lesson = $this->lessonModel->create($storeLessonDocumentRequest->validated());
        return $this->responseJson([
            'next' => to_route('dashboard.instructors.courses.edit', $lesson->course_id)->getTargetUrl(),
            'message' => 'lesson created successfully',
            'type' => 'success'
        ], Response::HTTP_CREATED);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Lesson $lesson): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        $this->authorize('edit', $lesson);
        if (view()->exists('instructors.lessons.edit.' . LessonType::tryFrom($lesson->type)->name)) {
            $sections = $lesson->course->sections;
            return view('instructors.lessons.edit.' . LessonType::tryFrom($lesson->type)->name, compact('lesson', 'sections'));
        }
        return to_route('dashboard.instructors.lessons.index')->with('error', 'view edit lesson not found');
    }

    /**
     * @throws AuthorizationException
     */
    public function documentUpdate(UpdateLessonDocumentRequest $updateLessonDocumentRequest, Lesson $lesson): \Illuminate\Http\JsonResponse
    {
        $this->authorize('documentUpdate', $lesson);
        $lesson->update($updateLessonDocumentRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'lesson updated successfully'], Response::HTTP_OK);
    }

    /**
     * @throws AuthorizationException
     */
    public function videoUpdate(UpdateLessonVideoRequest $updateLessonVideoRequest, Lesson $lesson): \Illuminate\Http\JsonResponse
    {
        $this->authorize('videoUpdate', $lesson);
        $lesson->update($updateLessonVideoRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'lesson updated successfully'], Response::HTTP_OK);
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Lesson $lesson): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        $this->authorize('show', $lesson);
        if (view()->exists('instructors.lessons.show.' . LessonType::tryFrom($lesson->type)->name)) {
            $lesson->load(['course:id,name', 'section:id,name', 'folder:id,name']);
            return view('instructors.lessons.show.' . LessonType::tryFrom($lesson->type)->name, compact('lesson'));
        }
        return to_route('dashboard.instructors.lessons.index')->with('error', 'view lesson not found');
    }

    /**
     * @throws AuthorizationException
     */
    public function comments(Lesson $lesson): \Illuminate\View\View
    {
        $this->authorize('comments', $lesson);
        $lesson->load(['course:id,name', 'section:id,name', 'folder:id,name', 'comments.user:id,name,email']);
        return view('instructors.lessons.comments.index', compact('lesson'));
    }

    /**
     * @throws AuthorizationException
     */
    public function likes(Lesson $lesson): \Illuminate\View\View
    {
        $this->authorize('likes', $lesson);
        $lesson->load(['course:id,name', 'section:id,name', 'folder:id,name', 'likes.user:id,name,email']);
        return view('instructors.lessons.likes.index', compact('lesson'));
    }

    /**
     * @throws AuthorizationException
     */
    public function views(Lesson $lesson): \Illuminate\View\View
    {
        $this->authorize('views', $lesson);
        $lesson->load(['course:id,name', 'section:id,name', 'folder:id,name', 'views.user:id,name,email']);
        return view('instructors.lessons.views.index', compact('lesson'));
    }

    /**
     * @throws AuthorizationException
     */
    public function videoStore(StoreLessonVideoRequest $storeLessonVideoRequest, Lesson $lesson): \Illuminate\Http\JsonResponse
    {
        $this->authorize('videoStore', $lesson);
        $response = VimeoVideoService::uploadVideo($storeLessonVideoRequest);
        if ($response) {
            LessonVideoPreparedToUpload::dispatch($lesson, $response);
            $uploadLink = $response['upload']['upload_link'];
            $lessonId = VideoLessonPreparedToUpload::getLessonId();
            return $this->responseJson([
                'type' => 'success',
                'message' => 'lesson created and video uploaded successfully to vimeo',
                'form' => view('instructors.lessons.create.video.upload-form', compact('uploadLink', 'lessonId'))->render()
            ], Response::HTTP_CREATED);
        }
        return $this->responseJson(['errors' => ['error' => 'an error occurred while uploading the video to vimeo api']], Response::HTTP_INTERNAL_SERVER_ERROR);
    }


    /**
     * @throws AuthorizationException
     */
    public function assignVideoLessonToFolder(Lesson $lesson): \Illuminate\Http\JsonResponse
    {
        $this->authorize('assignVideoLessonToFolder', $lesson);
        $lesson->load(['course.folder']);
        $assignToFolder = VimeoVideoService::assignVideoToFolder($lesson->course->folder->folder_id, $lesson->video_id);
        if (!$assignToFolder) {
            return $this->responseJson(['type' => ['error' => 'an error occurred while assigning the lesson to folder']], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->responseJson([
            'next' => to_route('dashboard.instructors.courses.edit', $lesson->course_id)->getTargetUrl(),
            'message' => 'lesson assigned to folder successfully',
            'type' => 'success'
        ], Response::HTTP_OK);
    }
}
