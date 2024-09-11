<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\Admin\Section\UpdateSectionLessonsOrdering;
use App\Http\Requests\Web\Admin\Section\UpdateSectionRequest;
use App\Http\Requests\Web\Admin\Section\StoreSectionRequest;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJson;
use App\Models\Section;
use App\Models\Course;

class SectionController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Section $sectionModel)
    {
    }

    public function index(): \Illuminate\View\View
    {
        $courses = Course::all(['id', 'name']);
        return view('admins.sections.index', compact('courses'));
    }

    /**
     * @throws Exception
     */
    public function sectionsDatatables(): \Illuminate\Http\JsonResponse
    {
        $sections = $this->sectionModel->with('course:id,name')->withCount('lessons');
        return datatables()->eloquent($sections)
            ->addIndexColumn()
            ->addColumn('actions', function ($section) {
                return view('admins.sections.datatable.actions', compact('section'))->render();
            })->rawColumns(['actions'])->toJson();
    }

    public function edit(Section $section): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $section], Response::HTTP_OK);
    }

    public function destroy(Section $section): \Illuminate\Http\RedirectResponse
    {
        $section->delete();
        return redirect()->route('dashboard.sections.index')->with('success', 'Section deleted successfully');
    }

    public function store(StoreSectionRequest $storeSectionRequest): \Illuminate\Http\JsonResponse
    {
        $this->sectionModel->create($storeSectionRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'section created successfully'], Response::HTTP_CREATED);
    }

    public function update(UpdateSectionRequest $updateSectionRequest, Section $section): \Illuminate\Http\RedirectResponse
    {
        $section->update($updateSectionRequest->validated());
        return redirect()->route('dashboard.sections.index')->with('success', 'Section updated successfully');
    }

    public function updateLessonsOrder(UpdateSectionLessonsOrdering $updateSectionLessonsOrdering,Section $section): \Illuminate\Http\JsonResponse
    {
        $section->updateLessonsOrder($updateSectionLessonsOrdering->validated()['ordering']);
        return $this->responseJson(['type' => 'success', 'message' => 'lesson ordering updated successfully'], Response::HTTP_OK);
    }
}
