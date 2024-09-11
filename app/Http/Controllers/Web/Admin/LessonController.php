<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\Admin\Lesson\UpdateLessonDocumentRequest;
use App\Http\Requests\Web\Admin\Lesson\StoreLessonDocumentRequest;
use App\Http\Requests\Web\Admin\Lesson\UpdateLessonVideoRequest;
use App\Http\Requests\Web\Admin\Lesson\StoreLessonVideoRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Listeners\VideoLessonPreparedToUpload;
use App\Events\LessonVideoPreparedToUpload;
use Yajra\DataTables\Exceptions\Exception;
use App\Repositories\VimeoVideoService;
use App\Http\Controllers\Controller;
use App\Enums\LessonProvider;
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

    public function index(): \Illuminate\View\View
    {
        return view('admins.lessons.index');
    }

    /**
     * @throws Exception
     */
    public function lessonsDatatables(): \Illuminate\Http\JsonResponse
    {
        $lessons = $this->lessonModel::select('*')->with(['course:id,name', 'section:id,name', 'folder:id,name']);
        return datatables()->eloquent($lessons)->addIndexColumn()
            ->editColumn('type', function ($lesson) {
                return '<span class="badge badge-soft-primary font-size-12">' . LessonType::tryFrom($lesson->type)->name . '</span>';
            })
            ->editColumn('provider', function ($lesson) {
                return '<span class="badge badge-soft-primary font-size-12">' . LessonProvider::tryFrom($lesson->provider)->name . '</span>';
            })
            ->editColumn('is_free', function ($lesson) {
                return $lesson->isFree() ? '<span class="badge badge-soft-success font-size-12">yes</span>' : '<span class="badge badge-soft-danger font-size-12">no</span>';
            })
            ->editColumn('is_publish', function ($lesson) {
                return $lesson->isPublish() ? '<span class="badge badge-soft-success font-size-12">yes</span>' : '<span class="badge badge-soft-danger font-size-12">no</span>';
            })
            ->addColumn('actions', function ($lesson) {
                return view('admins.lessons.datatable.actions', compact('lesson'))->render();
            })->rawColumns(['actions', 'is_free', 'is_publish', 'provider', 'type'])->toJson();
    }

    public function create(): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        $courses = Course::all();
        if (view()->exists('admins.lessons.create.' . request()->input('type'))) {
            return view('admins.lessons.create.' . request()->input('type'), compact('courses'));
        }
        return to_route('dashboard.lessons.index')->with('error', 'view lesson type not found');
    }

    public function documentStore(StoreLessonDocumentRequest $storeLessonDocumentRequest): \Illuminate\Http\JsonResponse
    {
        $lesson = $this->lessonModel->create($storeLessonDocumentRequest->validated());
        return $this->responseJson([
            'type' => 'success',
            'message' => 'lesson created successfully',
            'next' => route('dashboard.courses.edit', $lesson->course_id)
        ], Response::HTTP_CREATED);
    }

    public function videoStore(StoreLessonVideoRequest $storeLessonVideoRequest, Lesson $lesson): \Illuminate\Http\JsonResponse
    {
        $response = VimeoVideoService::uploadVideo($storeLessonVideoRequest);
        if ($response) {
            LessonVideoPreparedToUpload::dispatch($lesson, $response);
            $uploadLink = $response['upload']['upload_link'];
            $lessonId = VideoLessonPreparedToUpload::getLessonId();
            return $this->responseJson([
                'type' => 'success',
                'message' => 'lesson created and video uploaded successfully',
                'form' => view('admins.lessons.create.video.upload-form', compact('uploadLink', 'lessonId'))->render()
            ], Response::HTTP_CREATED);
        }
        return $this->responseJson(['errors' => ['error' => 'an error occurred while uploading the video to vimeo api']], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function assignVideoLessonToFolder(Lesson $lesson): \Illuminate\Http\JsonResponse
    {
        $assignToFolder = VimeoVideoService::assignVideoToFolder($lesson->folder->folder_id, $lesson->video_id);
        if (!$assignToFolder) {
            return $this->responseJson(['type' => ['error' => 'an error occurred while assigning the lesson to folder']], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->responseJson([
            'next' => route('dashboard.courses.edit', $lesson->course_id),
            'message' => 'lesson assigned to folder successfully',
            'type' => 'success'
        ], Response::HTTP_OK);
    }

    public function edit(Lesson $lesson): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        if (view()->exists('admins.lessons.edit.' . LessonType::tryFrom($lesson->type)->name)) {
            $sections = $lesson->course->sections;
            return view('admins.lessons.edit.' . LessonType::tryFrom($lesson->type)->name, compact('lesson', 'sections'));
        }
        return to_route('dashboard.lessons.index')->with('error', 'view lesson type not found');
    }

    public function show(Lesson $lesson): \Illuminate\View\View
    {
        $lesson->load(['course:id,name', 'section:id,name', 'folder:id,name']);
        return view('dashboard.lessons.show-' . LessonType::from($lesson->type)->name, compact('lesson'));
    }

    public function documentUpdate(UpdateLessonDocumentRequest $updateLessonDocumentRequest, Lesson $lesson): \Illuminate\Http\JsonResponse
    {
        $lesson->update($updateLessonDocumentRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'lesson updated successfully'], Response::HTTP_OK);
    }

    public function videoUpdate(UpdateLessonVideoRequest $updateLessonVideoRequest, Lesson $lesson): \Illuminate\Http\JsonResponse
    {
        $lesson->update($updateLessonVideoRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'lesson updated successfully'], Response::HTTP_OK);
    }

    public function comments(Lesson $lesson): \Illuminate\View\View
    {
        $lesson->load(['course:id,name', 'section:id,name', 'folder:id,name']);
        return view('admins.lessons.comments.index', compact('lesson'));
    }

    /**
     * @throws Exception
     */
    public function lessonCommentsDatatable(Lesson $lesson): \Illuminate\Http\JsonResponse
    {
        $comments = $lesson->comments()->with(['user:id,name,email']);
        return datatables()->eloquent($comments)
            ->addIndexColumn()
            ->addColumn('actions', function ($comment) {
                return view('admins.lessons.comments.datatable.comment_actions', compact('comment'))->render();
            })->rawColumns(['actions'])->toJson();
    }

    public function likes(Lesson $lesson): \Illuminate\View\View
    {
        $lesson->load(['course:id,name', 'section:id,name', 'folder:id,name']);
        return view('admins.lessons.likes.index', compact('lesson'));
    }

    /**
     * @throws Exception
     */
    public function lessonLikesDatatable(Lesson $lesson): \Illuminate\Http\JsonResponse
    {
        $likes = $lesson->likes()->with(['user:id,name,email']);
        return datatables()->eloquent($likes)->addIndexColumn()->toJson();
    }

    public function views(Lesson $lesson): \Illuminate\View\View
    {
        $lesson->load(['course:id,name', 'section:id,name', 'folder:id,name']);
        return view('admins.lessons.view.index', compact('lesson'));
    }

    /**
     * @throws Exception
     */
    public function lessonViewsDatatable(Lesson $lesson): \Illuminate\Http\JsonResponse
    {
        $likes = $lesson->views()->with(['user:id,name,email']);
        return datatables()->eloquent($likes)->addIndexColumn()->toJson();
    }
}
