<?php

namespace src\controllers;

use Exception;
use RedirectHeader;
use src\requests\products\ProductStoreRequest;
use src\requests\products\ProductUpdateRequest;
use src\services\ProductService;
use src\support\View;

class ProductController
{
    public function __construct(private ProductService $ProductService) {}

    public function index()
    {
        try {
            $products = $this->ProductService->getAll();
            return view('products.index', ['products' => $products]);
        } catch (Exception $e) {
            notification()->error($e->getMessage());
            return view('products.index', ['products' => []]);
        }
    }

    public function store(ProductStoreRequest $request): RedirectHeader
    {
        try {
            $this->ProductService->create($request->get());
            notification()->success('Product created successfully');
            return redirect()->route('products.index');
        } catch (Exception $e) {
            notification()->error($e->getMessage());
            return redirect()->route('products.index');
        }
    }

    public function delete(string $uuid): RedirectHeader
    {
        try {
            $this->ProductService->delete($uuid);
            notification()->success('Product deleted successfully');
        } catch (Exception $e) {
            notification()->error($e->getMessage());
        } finally {
            return redirect()->route('products.index');
        }
    }

    public function edit(string $uuid)
    {
        try {
            $product = $this->ProductService->getByUuid($uuid);
            return view('products.edit', ['product' => $product]);
        } catch (Exception $e) {
            notification()->error($e->getMessage());
            return redirect()->route('products.index');
        }
    }

    public function update(ProductUpdateRequest $request, string $uuid): RedirectHeader
    {
        try {
            $this->ProductService->update($uuid, $request->get());
            notification()->success('Product updated successfully');
        } catch (Exception $e) {
            notification()->error($e->getMessage());
        } finally {
            return redirect()->route('products.index');
        }
    }
}
