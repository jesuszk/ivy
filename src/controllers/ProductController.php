<?php

namespace src\Controllers;

use src\Services\ProductService;
use src\Support\View;

use src\Support\Redirect;

use src\requests\products\ProductStoreRequest;
use src\requests\products\ProductUpdateRequest;

class ProductController
{
    public function __construct(private ProductService $productService)
    {
    }

    public function index(): View
    {
        try {
            $products = $this->productService->getAll();
            return view('products.index', ['products' => $products]);
        } catch (\Exception $e) {
            notification()->error($e->getMessage());
            return view('products.index', ['products' => []]);
        }
    }

    public function create()
    {
        return View::render('products.create');
    }

    public function store(ProductStoreRequest $request): Redirect
    {
        try {
            $this->productService->create($request->get());
            return redirect()->route('products.index')->withSuccess('product created successfully');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->withError($e->getMessage());
        }
    }

    public function edit(string $uuid): View|Redirect
    {
        try {
            $product = $this->productService->getByUuid($uuid);
            return view('products.edit', ['product' => $product]);
        } catch (\Exception $e) {
            return redirect()->route('products.index')->withError($e->getMessage());
        }
    }

    public function update(ProductUpdateRequest $request, string $uuid): Redirect
    {
        try {
            $this->productService->update($uuid, $request->get());
            return redirect()->route('products.index')->withSuccess('product updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->withError($e->getMessage());
        }
    }
    public function delete(string $uuid): Redirect
    {
        try {
            $this->productService->delete($uuid);
            return redirect()->route('products.index')->withSuccess('product deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->withError($e->getMessage());
        }
    }
}
