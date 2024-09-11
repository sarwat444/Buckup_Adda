<?php

namespace App\View\Components;

use App\Models\Category as CategoryModel;
use Illuminate\View\Component;

class Category extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(private readonly CategoryModel $categoryModel)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): \Illuminate\Contracts\View\View
    {
        $categories = $this->categoryModel->all();
        return view('components.category', compact('categories'));
    }
}
