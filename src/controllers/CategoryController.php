<?php

namespace src\controllers;

use src\models\Category;
use src\requests\CategoryRequest;

class CategoryController
{
    function __construct() {}
    function list()
    {
        $categories = Category::getAll();

        if (!$categories)
            notification()->error("Não foi possível listar os registros");

        return view('categories.list', ["categories" => ($categories ?? [])]);
    }

    function create()
    {
        $category = Category::create([]);

        if (!$category)
            return redirect()->back()->withError("Não foi possível salvar os dados");

        return redirect()->route("categories.details", ["uuid" => $category->uuid], ["return" => request()->get("return")]);
    }


    function details(string $uuid)
    {
        $category = Category::getByUuid($uuid);

        if (!$category)
            return redirect()->back()->withError("Não foi possível buscar o registro");

        return view("categories.edit", ["category" => $category]);
    }


    function update(CategoryRequest $request)
    {
        $payload = $request->get();
        $category = Category::updateByUuid($payload["uuid"], $payload);

        if (!$category)
            return redirect()->back()->withError("Não foi possível salvar os dados");

        if ($to = request()->get("to"))
            return redirect()->link($to)->withSuccess("A categoria foi adicionada com sucesso");
        
        return redirect()->back()->withSuccess("Os dados foram salvos com sucesso");
    }


    function deactivate(string $uuid)
    {
        $category = Category::getByUuid($uuid);
        $category->deleted_at = date("Y-m-d H:i:s");


        $updated = $category->updateByUuid($uuid, (array) $category);

        if (!$updated)
            return redirect()->back()->withError("Não foi possível desativar o registro");

        return redirect()->back()->withSuccess("Registro desabilitado com sucesso");
    }


    function activate(string $uuid)
    {
        $category = Category::getByUuid($uuid);
        $category->deleted_at = null;


        $updated = $category->updateByUuid($uuid, (array) $category);

        if (!$updated)
            return redirect()->back()->withError("Não foi possível ativar o registro");

        return redirect()->back()->withSuccess("Registro ativado com sucesso");
    }


    function delete(string $uuid)
    {
        $deleted = Category::deleteByUuid($uuid);

        if (!$deleted)
            return redirect()->back()->withError("Não foi possível excluir o registro");

        return redirect()->route("categories.list")->withSuccess("O registro foi excluído com sucesso");
    }
}
