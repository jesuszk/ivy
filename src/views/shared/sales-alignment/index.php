<?= $this->layout("templates/base", [
    "webTitle" => "SFP AMMX - {$_ENV['SALES_ALIGNMENT']}",
    "cardTitle" => "SFP AMMX - {$_ENV['SALES_ALIGNMENT']}",
]); ?>



<div class="row mb-3">
    <div class="col-12">
        <a href="<?= route("process.open") ?>" class="btn btn-company float-end">Iniciar nova SFP <i class="ph ph-stack-plus"></i></a>
    </div>
</div>


<table class="table-responsive">
    <thead>
        <tr>
            <th>Número</th>
            <th>Abertura</th>
            <th>Iniciador</th>
            <th>Estado</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>

        <?php if (isset($processes) && count($processes)) { ?>
            <?php foreach ($processes as $idx => $process) { ?>
                <tr>
                    <td><?= $process->id ?></td>
                    <td><?= $process->criado_em ?></td>
                    <td><?= $process->iniciador_nome ?></td>
                    <td><?= $process->estado ?></td>
                    <td>
                        <a href="<?= route("sales.alignment.showing", ["uuid" => $process->uuid]) ?>" class="btn btn-company">
                            <i class="ph ph-arrow-square-out"></i>
                        </a>

                        <a href="#" class="btn btn-dark">
                            <i class="ph ph-dots-three-circle"></i>
                        </a>

                        <!-- para devs -->
                        <a href="#" class="btn btn-dark">
                            <i class="ph ph-bug"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5">Nenhum processo encontrado nesta etapa <i class="ph ph-confetti text-success"></i></td>
            </tr>
        <?php } ?>
    </tbody>
</table>