<?php

namespace App\Http\Controllers\Web\Instructor;

use App\Http\Requests\Web\Instructor\Section\UpdateSectionLessonsOrdering;
use App\Http\Requests\Web\Instructor\Section\UpdateSectionRequest;
use App\Http\Requests\Web\Instructor\Section\StoreSectionRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response;
use App\Events\InstructorUpdateSection;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJson;
use App\Models\Section;

class SectionController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Section $sectionModel)
    {
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): \Illuminate\View\View
    {
        $this->authorize('index', $this->sectionModel);
        $sections = auth()->user()->sections()->with('course:id,name')->withCount('lessons')->get();
        return view('instructors.sections.index', compact('sections'));
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): \Illuminate\View\View
    {
        $this->authorize('index', $this->sectionModel);
        $courses = auth()->user()->courses()->select('id', 'name')->get();
        return view('instructors.sections.create', compact('courses'));
    }

    /**
     * @throws AuthorizationException
     */
    public function updateLessonsOrder(UpdateSectionLessonsOrdering $updateSectionLessonsOrdering, Section $section): \Illuminate\Http\JsonResponse
    {
        $this->authorize('updateLessonsOrder', $section);
        $section->updateLessonsOrder($updateSectionLessonsOrdering->validated()['ordering']);
        return $this->responseJson(['type' => 'success', 'message' => 'lesson ordering updated successfully'], Response::HTTP_OK);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreSectionRequest $storeSectionRequest): \Illuminate\Http\JsonResponse
    {
        $this->authorize('store', $this->sectionModel);
        $this->sectionModel->create($storeSectionRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'section created successfully'], Response::HTTP_CREATED);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Section $section): \Illuminate\View\View
    {
        $this->authorize('edit', $section);
        $courses = auth()->user()->courses()->select('id', 'name')->get();
        return view('instructors.sections.edit', compact('section', 'courses'));
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateSectionRequest $storeSectionRequest, Section $section): \Illuminate\Http\JsonResponse
    {
        $this->authorize('update', $section);
        $section->update($storeSectionRequest->validated());
        InstructorUpdateSection::dispatch($section);
        return $this->responseJson(['type' => 'success', 'message' => 'section updated successfully'], Response::HTTP_OK);
    }
}
