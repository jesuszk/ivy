<?php

namespace src\Controllers;

use src\Services\CategoryService;
use src\Support\View;

use src\Support\Redirect;

use src\requests\categories\CategoryStoreRequest;
use src\requests\categories\CategoryUpdateRequest;

class CategoryController
{
    public function __construct(private CategoryService $categoryService)
    {
    }

    public function index(): View
    {
        try {
            $categories = $this->categoryService->getAll();
            return view('categories.index', ['categories' => $categories]);
        } catch (\Exception $e) {
            notification()->error($e->getMessage());
            return view('categories.index', ['categories' => []]);
        }
    }

    public function create()
    {
        return View::render('categories.create');
    }

    public function store(CategoryStoreRequest $request): Redirect
    {
        try {
            $this->categoryService->create($request->get());
            return redirect()->route('categories.index')->withSuccess('category created successfully');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->withError($e->getMessage());
        }
    }

    public function edit(string $uuid): View|Redirect
    {
        try {
            $category = $this->categoryService->getByUuid($uuid);
            return view('categories.edit', ['category' => $category]);
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->withError($e->getMessage());
        }
    }

    public function update(CategoryUpdateRequest $request, string $uuid): Redirect
    {
        try {
            $this->categoryService->update($uuid, $request->get());
            return redirect()->route('categories.index')->withSuccess('category updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->withError($e->getMessage());
        }
    }
    public function delete(string $uuid): Redirect
    {
        try {
            $this->categoryService->delete($uuid);
            return redirect()->route('categories.index')->withSuccess('category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->withError($e->getMessage());
        }
    }
}
