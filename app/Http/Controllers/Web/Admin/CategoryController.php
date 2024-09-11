<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Web\Admin\Category\UpdateCategoryRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJson;
use App\Models\Category;

class CategoryController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Category $categoryModel)
    {
    }

    public function index(): \Illuminate\View\View
    {
        $categories = $this->categoryModel->withCount('courses')->get();
        return view('admins.categories.index', compact('categories'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('admins.categories.create');
    }

    public function   store(StoreCategoryRequest $storeCategoryRequest): \Illuminate\Http\JsonResponse
    {
        $this->categoryModel->create($storeCategoryRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'Category created successfully.'], Response::HTTP_CREATED);
    }

    public function destroy(Category $category): \Illuminate\Http\RedirectResponse
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully');
    }

    public function edit(Category $category): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $category], Response::HTTP_OK);
    }

    public function update(UpdateCategoryRequest $updateCategoryRequest, Category $category): \Illuminate\Http\RedirectResponse
    {
        $category->update($updateCategoryRequest->validated());
        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully');
    }

}
