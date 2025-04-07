<?php

namespace src\Controllers;

use src\Services\ProductService;
use src\Support\View;

class ProductController
{
    public function __construct(private ProductService $productService)
    {
    }

    public function index()
    {
        $products = $this->productService->getAll();
        return View::render('products.index', ['products' => $products]);
    }

    public function create()
    {
        return View::render('products.create');
    }

    public function store()
    {
        $data = $_POST;
        $this->productService->create($data);
        return header('Location: /products');
    }

    public function show(string $uuid)
    {
        $product = $this->productService->getByUuid($uuid);
        return View::render('products.show', ['product' => $product]);
    }

    public function edit(string $uuid)
    {
        $product = $this->productService->getByUuid($uuid);
        return View::render('products.edit', ['product' => $product]);
    }

    public function update(string $uuid)
    {
        $data = $_POST;
        $this->productService->update($uuid, $data);
        return header('Location: /products');
    }

    public function destroy(string $uuid)
    {
        $this->productService->delete($uuid);
        return header('Location: /products');
    }
}
