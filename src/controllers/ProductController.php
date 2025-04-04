<?php

namespace src\controllers;

use Exception;
use src\requests\products\ProductStoreRequest;
use src\requests\products\ProductUpdateRequest;
use src\services\ProductService;
use src\support\Redirect;
use src\support\View;

class ProductController
{
    public function __construct(private ProductService $ProductService) {}

    public function index(): View
    {
        try {
            return view('products.index', ['products' => $this->ProductService->getAll()]);
        } catch (Exception $e) {
            notification()->error($e->getMessage());
            return view('products.index', ['products' => []]);
        }
    }

    public function store(ProductStoreRequest $request)
    {
        try {
            $this->ProductService->create($request->get());
            return redirect()->route('products.index')->withSuccess('Product created successfully');
        } catch (Exception $e) {
            return redirect()->route('products.index')->withError($e->getMessage());
        }
    }

    public function delete(string $uuid): Redirect
    {
        try {
            $this->ProductService->delete($uuid);
            return redirect()->route('products.index')->withSuccess('Product deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('products.index')->withError($e->getMessage());
        }
    }

    public function edit(string $uuid): View|Redirect
    {
        try {
            $product = $this->ProductService->getByUuid($uuid);
            return view('products.edit', ['product' => $product]);
        } catch (Exception $e) {
            return redirect()->route('products.index')->withError($e->getMessage());
        }
    }

    public function update(ProductUpdateRequest $request, string $uuid): Redirect
    {
        try {
            $this->ProductService->update($uuid, $request->get());
            return redirect()->route('products.index')->withSuccess(['Product updated successfully']);
        } catch (Exception $e) {
            return redirect()->route('products.index')->withError($e->getMessage());
        }
    }
}
