<?= $this->layout("templates/base", [
    "webTitle" => "Editando Produto",
    "cardTitle" => "Editando Produto",
    "backTo" => route("products.list"),
]) ?>





<form action="<?= route("products.update") ?>" method="post" id="productFormUpdate">

    <div id="configs">
        <input type="hidden" name="uuid" value="<?= $product->uuid ?>">
    </div>

    <div class="row g-3">
        <div class="col-12 col-md-4">
            <label for="name" class="fw-bold">Nome <span>*</span></label>
            <input type="text" class="form-control form-control-sm text-center" name="name" id="name" value="<?= $product->name ?>">
        </div>

        <div class="col-12 col-md-2">
            <label for="price" class="fw-bold">Preço <span>*</span></label>
            <input type="number" step="0.01" class="form-control form-control-sm text-center" name="price" id="price" value="<?= $product->price ?>">
        </div>

        <div class="col-12 col-md-2">
            <label for="stock_min" class="fw-bold">Estoque Mínimo <span>*</span></label>
            <input type="text" class="form-control form-control-sm text-center" name="stock_min" id="stock_min" value="<?= $product->stock_min ?>">
        </div>

        <div class="col-12 col-md-2">
            <label for="category_id" class="fw-bold">Categoria <span>*</span> <a href="<?= route("categories.create") . "?return=" . currentUrl() ?>" class="text-success"><i class="ph ph-plus"></i></a></label>
            <select name="category_id" id="category_id" class="form-select form-select-sm text-center">
                <option value="">Selecione</option>
                <?php foreach ($categories as $i => $category) { ?>
                    <option value="<?= $category->id ?>" <?= isSelect($product->category_id, $category->id) ?>><?= $category->name ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-12 col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-company w-100">Salvar Produto <i class="ph ph-paper-plane-tilt"></i></button>
        </div>
    </div>

</form>