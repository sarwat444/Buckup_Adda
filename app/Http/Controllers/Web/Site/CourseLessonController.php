<?php

namespace App\Http\Controllers\Web\Site;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJson;
use App\Models\Course;

class CourseLessonController extends Controller
{
    use ResponseJson;

    public function preview(Course $course): \Illuminate\Http\JsonResponse
    {
        if (!$course->IsActive()) {
            $this->responseJson(['errors' => ['error' => 'course is invalid for preview']], Response::HTTP_BAD_REQUEST);
        }
        $lessons = $course->availableLessons()->orderBy('ordering')->get(['title', 'embed', 'duration']);
        return $this->responseJson(['lessons' => $lessons], Response::HTTP_OK);
    }
}
