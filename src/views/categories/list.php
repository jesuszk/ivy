<?php
$this->layout("templates/base", [
    "webTitle" => "Ivy - Listando produtos",
    "cardTitle" => "Listagem de produtos",
    "styles" => [
        path()->css("table.css")
    ],
]);
?>


<a href="<?= route("categories.create"); ?>" class="btn btn-company mb-3">Nova Categoria</a>

<table class="table-responsive" id="productsTable">
    <thead>
        <tr>
            <th>id</th>
            <th>Categoria</th>
            <th>Desabilitado Em</th>
            <th>&nbsp;</th>
        </tr>
    </thead>


    <tbody>
        <?php if ($categories && count($categories)) { ?>
            <?php foreach ($categories as $i => $category) { ?>
                <tr>
                    <td><?= $category->id ?></td>
                    <td><?= $category->name ?></td>
                    <td><?= dateConvert($category->deleted_at, "d/m/Y H:i:s"); ?></td>
                    <td>
                        <?php if (!$category->deleted_at) { ?>
                            <a href="<?= route("categories.deactivate", ["uuid" => $category->uuid]) ?>" class="btn btn-danger"><i class="ph ph-x"></i></a>
                        <?php } else { ?>
                            <a href="<?= route("categories.activate", ["uuid" => $category->uuid]) ?>" class="btn btn-success"><i class="ph ph-arrow-counter-clockwise"></i></a>
                        <?php } ?>
                        <a href="<?= route("categories.details", ["uuid" => $category->uuid]) ?>" class="btn btn-company">Detalhes</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5">Nenhum produto encontrado. <a href="<?= route("categories.create") ?>">Adicionar Produto <i class="ph ph-arrow-square-out"></i></a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>