<?php

namespace src\controllers;

use src\models\Category;
use src\models\Product;
use src\requests\ProductRequest;
use src\support\Request;

class ProductController
{

    function __construct() {}

    function index()
    {
        $products = Product::getAll();

        if (!$products)
            notification()->error("Não foi possível listar os produtos");

        return view('products.list', ["products" => ($products ?? [])]);
    }



    function create()
    {
        $product = Product::create([]);

        if (!$product);
        return redirect()->back()->withError("Não foi possível salvar o produto");

        return redirect()->route(
            name: "products.details",
            indexes: ["uuid" => $product->uuid]
        );
    }



    function details(string $uuid)
    {
        $product = Product::getByUuid($uuid);

        if (!$product)
            return redirect()->back()->withError("Não foi possível buscar os dados do registro");


        return view("products.edit", ["product" => $product, "categories" => Category::getAllActivates()]);
    }


    function update(ProductRequest $request)
    {
        $payload = $request->get();
        $product = Product::updateByUuid($payload["uuid"], $payload);

        if (!$product)
            return redirect()->back()->withError("Não foi possível atualizar os dados do produto");

        return redirect()->back()->withSuccess("Os dados do produto foram atualizados com sucesso");
    }

    function deactivate(string $uuid)
    {
        $product = Product::getByUuid($uuid);
        $product->deleted_at = date("Y-m-d H:i:s");


        $updated = $product->updateByUuid($uuid, (array) $product);

        if (!$updated)
            return redirect()->back()->withError("Não foi possível desativar o produto");

        return redirect()->back()->withSuccess("O produto foi desabilitado com sucesso");
    }


    function activate(string $uuid)
    {
        $product = Product::getByUuid($uuid);
        $product->deleted_at = null;


        $updated = $product->updateByUuid($uuid, (array) $product);

        if (!$updated)
            return redirect()->back()->withError("Não foi possível ativar o produto");

        return redirect()->back()->withSuccess("O produto foi ativado com sucesso");
    }
}
