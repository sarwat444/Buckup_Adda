<?php

namespace App\Http\Controllers\Web\Admin\Setting;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ResponseJson;
use App\Models\Course;

class CourseSettingController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Course $courseModel)
    {
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        $courses = $this->courseModel->select(['id', 'name', 'user_id', 'is_top'])->with('user:id,first_name,last_name,email')->simplePaginate(10);
        return view('admins.settings.homepage', compact('courses'));
    }

    public function updateTopCourse(Request $request, Course $course): JsonResponse
    {
        $course->update(['is_top' => $request->boolean('is_top')]);
        return $this->responseJson(['type' => 'success', 'message' => 'course now appear in home page as top course'], Response::HTTP_OK);
    }
}
