<?= $this->layout("templates/base", [
    "webTitle" => "SFP AMMX - Páginas",
    "cardTitle" => "SFP AMMX - Páginas",
]); ?>


<?php
$etapasDiferentesDeRodas = [
    ["id" => "n", "titulo" => "Vendas Alinhamento", "estado" => "Em Produção <i class='ph ph-check-circle text-success'></i>", "link" => "sales.alignment.list"],
    ["id" => "n", "titulo" => "Eng. Fundição Alinhamento", "estado" => "Offline <i class='ph ph-x-circle text-danger'></i>", "link" => "sales.alignment.list"],
    ["id" => "n", "titulo" => "Vendas Aprovação", "estado" => "Offline <i class='ph ph-x-circle text-danger'></i>", "link" => "sales.alignment.list"],
    ["id" => "n", "titulo" => "Eng. Fundição Aprovação", "estado" => "Offline <i class='ph ph-x-circle text-danger'></i>", "link" => "sales.alignment.list"],
    ["id" => "n", "titulo" => "Compras Serviços", "estado" => "Offline <i class='ph ph-x-circle text-danger'></i>", "link" => "sales.alignment.list"],
    ["id" => "n", "titulo" => "Compras Ferramentais", "estado" => "Offline <i class='ph ph-x-circle text-danger'></i>", "link" => "sales.alignment.list"],
    ["id" => "n", "titulo" => "Compras Componentes", "estado" => "Offline <i class='ph ph-x-circle text-danger'></i>", "link" => "sales.alignment.list"],
    ["id" => "n", "titulo" => "Logística", "estado" => "Offline <i class='ph ph-x-circle text-danger'></i>", "link" => "sales.alignment.list"],
    ["id" => "n", "titulo" => "Expedição", "estado" => "Offline <i class='ph ph-x-circle text-danger'></i>", "link" => "sales.alignment.list"],
    ["id" => "n", "titulo" => "Controladoria", "estado" => "Offline <i class='ph ph-x-circle text-danger'></i>", "link" => "sales.alignment.list"],
    ["id" => "n", "titulo" => "Vendas Destino", "estado" => "Offline <i class='ph ph-x-circle text-danger'></i>", "link" => "sales.alignment.list"],
    ["id" => "n", "titulo" => "Preço Aprovado", "estado" => "Offline <i class='ph ph-x-circle text-danger'></i>", "link" => "sales.alignment.list"],
];
?>

<table class="table-responsive">
    <thead>
        <tr>
            <th>Índice</th>
            <th>Página</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($etapasDiferentesDeRodas as $idx => $etapa) { ?>
            <tr>
                <td><?= $idx + 1 ?></td>
                <td><?= $etapa['titulo'] ?> <a target="_blank" href="<?= route($etapa["link"]) ?>"><i class="ph ph-arrow-square-out"></i></a></td>
                <td><?= $etapa['estado'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>