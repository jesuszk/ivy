<?php
$this->layout("templates/base", [
    "webTitle" => "Ivy - Listando produtos",
    "cardTitle" => "Listagem de produtos",
    "styles" => [
        path()->css("table.css")
    ],
]);
?>


<a href="<?= route("products.create"); ?>" class="btn btn-company mb-3">Novo Produto</a>

<table class="table-responsive" id="productsTable">
    <thead>
        <tr>
            <th>id</th>
            <th>Produto</th>
            <th>Preço</th>
            <th>Estoque Mín.</th>
            <th>Desabilitado Em</th>
            <th>&nbsp;</th>
        </tr>
    </thead>


    <tbody>
        <?php if ($products && count($products)) { ?>
            <?php foreach ($products as $i => $product) { ?>
                <tr>
                    <td><?= $product->id ?></td>
                    <td><?= $product->name ?></td>
                    <td>R$ <?= $product->price ?></td>
                    <td><?= $product->stock_min ?></td>
                    <td><?= dateConvert($product->deleted_at, "d/m/Y H:i:s"); ?></td>
                    <td>
                        <?php if (!$product->deleted_at) { ?>
                            <a href="<?= route("products.deactivate", ["uuid" => $product->uuid]) ?>" class="btn btn-danger"><i class="ph ph-x"></i></a>
                        <?php } else { ?>
                            <a href="<?= route("products.activate", ["uuid" => $product->uuid]) ?>" class="btn btn-success"><i class="ph ph-arrow-counter-clockwise"></i></a>
                        <?php } ?>
                        <a href="<?= route("products.details", ["uuid" => $product->uuid]) ?>" class="btn btn-company">Ver Produto</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5">Nenhum produto encontrado. <a href="<?= route("products.create") ?>">Adicionar Produto <i class="ph ph-arrow-square-out"></i></a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>