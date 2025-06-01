<?= $this->layout("templates/base", [
    "webTitle" => "Editando Categoria",
    "cardTitle" => "Editando Categoria",
    "backTo" => route("categories.list"),
]) ?>





<form action="<?= route("categories.update") ?>" method="post" id="categoryFormUpdate">

    <div id="configs">
        <input type="hidden" name="uuid" value="<?= $category->uuid ?>">
        <?php if ($to = request()->get("return")) { ?>
            <input type="hidden" name="to" id="to" value="<?= $to ?>">
        <?php } ?>
    </div>

    <div class="row g-3">
        <div class="col-12 col-md-4">
            <label for="name" class="fw-bold">Nome <span>*</span></label>
            <input type="text" class="form-control form-control-sm text-center" name="name" id="name" value="<?= $category->name ?>">
        </div>

        <div class="col-12 col-md-2 d-flex align-items-end">
            <a href="<?= route("categories.delete", ["uuid" => $category->uuid]) ?>" class="btn btn-danger btn-sm me-2"><i class="ph ph-trash"></i></a>
            <button type="submit" class="btn btn-company w-100">Salvar Produto <i class="ph ph-paper-plane-tilt"></i></button>
        </div>
    </div>

</form>