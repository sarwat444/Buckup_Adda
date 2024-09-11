<?php

namespace App\Http\Controllers\Web\Instructor;

use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJson;
use App\Models\Course;

class CourseSectionController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Course $courseModel)
    {
    }

    /**
     * @throws AuthorizationException
     */
    public function courseSections(Course $course): \Illuminate\Http\JsonResponse
    {
        $this->authorize('courseSections', $course);
        $course->load('sections');
        return $this->responseJson(['type' => 'success', 'sections' => $course->sections], Response::HTTP_OK);
    }
}
