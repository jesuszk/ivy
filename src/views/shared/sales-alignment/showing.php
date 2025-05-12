<?php $t = time(); ?>
<?= $this->layout("templates/base", [
    "webTitle" => "SFP AMMX - {$_ENV['SALES_ALIGNMENT']}",
    "cardTitle" => "SFP AMMX - {$_ENV['SALES_ALIGNMENT']}",
    "js" => [path()->js("shared/sales-alignment/showing.js?t={$t}")],
    "backTo" => route('sales.alignment.list')
]); ?>


<div id="processInfo">
    <input type="hidden" id="processo_uuid" value="<?= $processData["processo"]->uuid ?>">
    <input type="hidden" id="etapa_atual" value="<?= $_ENV["SALES_ALIGNMENT"] ?>">
    <input type="hidden" id="etapa_proxima" value="<?= $_ENV["FOUNDRY_ALIGNMENT"] ?>">
    <input type="hidden" id="rota_gravar" value="<?= route('sales.alignment.persist'); ?>">
    <input type="hidden" id="rota_aprovar" value="<?= $_ENV["SALES_ALIGNMENT"]; ?>">
</div>



<form id="formChapter">
    <input type="hidden" name="etapa_vendas_alinhamento_uuid" value="<?= $processData["etapa_vendas_alinhamento"]->uuid ?>">
    <div class="row mb-4">
        <div class="col-12 col-md-3">
            <label for="processo_id" class="form-label">Número SFP <span>*</span></label>
            <input type="text" class="form-control form-control-sm t-center" id="processo_id" value="<?= fourDigits($processData["processo"]->id) ?>" readonly>
            <input type="hidden" name="processo_uuid" value="<?= $processData["processo"]->uuid ?>">
        </div>

        <div class="col-12 col-md-2">
            <label for="criado_em" class="form-label">Data Abertura <span>*</span></label>
            <input type="date" class="form-control form-control-sm t-center" id="criado_em" value="<?= timestampToDate($processData["processo"]->criado_em) ?>" readonly>
        </div>

        <div class="col-12 col-md-2">
            <label for="tipo" class="form-label">Tipo <span>*</span></label>
            <select onchange="handleSelectFamilies(this);" name="tipo" id="tipo" class="form-select form-select-sm t-center">
                <option value="">Escolha</option>
                <?php $options = [$_ENV["RODAS"], $_ENV["FERROVIARIO"], $_ENV["INDUSTRIAL"]]; ?>
                <?php foreach ($options as $idx => $option) { ?>
                    <option value="<?= $option ?>" <?= isSelect($processData["etapa_vendas_alinhamento"]->tipo, $option) ?>><?= $option ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-12 col-md-2" id="container-familia">
            <label for="familia" class="form-label">Família <span>*</span></label>
            <select name="familia" id="familia" class="form-select form-select-sm t-center">
                <option value="">Escolha</option>
                <?php foreach (families_options() as $idx => $family) { ?>
                    <option value="<?= $family ?>" <?= isSelect($processData["etapa_vendas_alinhamento"]->familia, $family) ?>><?= $family ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-12 col-md-3">
            <label for="prazo_entrega" class="form-label">Prazo Entrega <span>*</span></label>
            <input type="date" class="form-control form-control-sm t-center" name="prazo_entrega" id="prazo_entrega" value="<?= $processData["etapa_vendas_alinhamento"]->prazo_entrega ?>">
        </div>
    </div>


    <div class="row mb-4">
        <div class="col-12 col-md-7">
            <label for="documentacao_suplementar" class="form-label">Documentação Suplementar</label>
            <div class="input-group">
                <input type="text" class="form-control form-control-sm" name="documentacao_suplementar" id="documentacao_suplementar" readonly value="<?= $processData["etapa_vendas_alinhamento"]->documentacao_suplementar ?>">
                <button class="btn btn-company d-flex align-items-center justify-content-center" type="button" id="documentacao_suplementar_trigger"><i class="ph ph-monitor-arrow-up fs-5"></i></button>
            </div>
            <small class="text-muted" id="documentacao_suplementar_titulo"><?= $processData["uploads"]["documentacao_suplementar"]->arquivo_nome_original ?? '' ?></small>
        </div>

        <div class="col-12 col-md-5">
            <label for="documentacao_descricao" class="form-label">Descrição</label>
            <input type="text" name="documentacao_descricao" id="documentacao_descricao" class="form-control form-control-sm" value="<?= $processData["etapa_vendas_alinhamento"]->documentacao_descricao ?>">
        </div>
    </div>




    <div class="row mb-3">
        <div class="col-12 col-md-3">
            <label for="receita_linha" class="form-label fw-bold">Receita de linha <span>*</span></label>
            <select name="receita_linha" id="receita_linha" class="form-select form-select-sm t-center">
                <option value="">Escolha</option>
                <?php foreach (receita_options() as $receita) { ?>
                    <option value="<?= $receita ?>" <?= isSelect($processData["etapa_vendas_alinhamento"]->receita_linha, $receita) ?>><?= $receita ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-12 col-md-4">
            <label for="origem" class="form-label fw-bold">Origem <span>*</span></label>
            <input type="text" class="form-control form-control-sm text-center" id="origem" name="origem" value="<?= $processData["etapa_vendas_alinhamento"]->origem ?>">
        </div>
        <div class="col-12 col-md-5">
            <label for="destino" class="form-label fw-bold">Destino <span>*</span></label>
            <input type="text" class="form-control form-control-sm text-center" id="destino" name="destino" value="<?= $processData["etapa_vendas_alinhamento"]->destino ?>">
        </div>
    </div>



    <div class="row mb-5">
        <div class="col-12 col-md-4">
            <label for="solicitante" class="form-label fw-bold">Solicitante</label>
            <input type="text" class="form-control form-control-sm text-center" id="solicitante" name="solicitante" value="<?= $processData["etapa_vendas_alinhamento"]->solicitante ?>">
        </div>
        <div class="col-12 col-md-5">
            <label for="cliente" class="form-label fw-bold">Cliente</label>
            <input type="text" class="form-control form-control-sm text-center" id="cliente" name="cliente" value="<?= $processData["etapa_vendas_alinhamento"]->cliente ?>">
        </div>
        <div class="col-12 col-md-3">
            <label for="prazo_entrega_cliente" class="form-label fw-bold">Data limite (Cliente)</label>
            <input type="date" class="form-control form-control-sm text-center" id="prazo_entrega_cliente" name="prazo_entrega_cliente" value="<?= $processData["etapa_vendas_alinhamento"]->prazo_entrega_cliente ?>">
        </div>
    </div>


    <div class="row mb-5">
        <div class="col-12 mb-3">
            <h4 class="fw-bold"><span>LISTA DE ITENS</span> <button type="button" class="btn btn-company" id="item_add"><i class="ph ph-plus"></i></button></h4>
        </div>

        <div class="col-12" id="items">
            <?php if (
                isset($processData["etapa_vendas_alinhamento_itens"]) &&
                $processData["etapa_vendas_alinhamento_itens"] &&
                count($processData["etapa_vendas_alinhamento_itens"])
            ) { ?>
                <?php $idx = 1; ?>
                <?php foreach ($processData["etapa_vendas_alinhamento_itens"] as $item) { ?>
                    <div class="row item g-2 mb-3 container-item" data-idx="<?= $idx ?>" style="position: relative;">

                        <div class="col-12">
                            <i class="ph ph-trash float-end text-danger" style="position:absolute; right: 20px; top: 20px; cursor: pointer;" onclick="removeItem(this)"></i>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="item_<?= $idx ?>" class="form-label">Item <span>*</span></label>
                            <input type="text" class="form-control form-control-sm" id="item_<?= $idx ?>" name="block_item[<?= $idx ?>][item]" value="<?= $item->item ?>">
                        </div>

                        <div class="col-12 col-md-8">
                            <label for="item_descricao_<?= $idx ?>" class="form-label">Descrição <span>*</span></label>
                            <input type="text" class="form-control form-control-sm" id="item_descricao_<?= $idx ?>" name="block_item[<?= $idx ?>][descricao]" value="<?= $item->descricao ?>">
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="demanda_mes_<?= $idx ?>" class="form-label">Demanda Mês <span>*</span></label>
                            <input type="text" class="form-control form-control-sm" id="demanda_mes_<?= $idx ?>" name="block_item[<?= $idx ?>][demanda_mes]" value="<?= $item->demanda_mes ?>">
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="demanda_total_<?= $idx ?>" class="form-label">Demanda Total <span>*</span></label>
                            <input type="text" class="form-control form-control-sm" id="demanda_total_<?= $idx ?>" name="block_item[<?= $idx ?>][demanda_total]" value="<?= $item->demanda_total ?>">
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="anexo_<?= $idx ?>" class="form-label">Anexo</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm attach" name="block_item[<?= $idx ?>][anexo]" id="anexo_<?= $idx ?>" readonly value="<?= $item->anexo ?>">
                                <button class="btn btn-company d-flex align-items-center justify-content-center is-trigger" type="button" id="anexo_<?= $idx ?>_trigger"><i class="ph ph-monitor-arrow-up fs-5"></i></button>
                            </div>
                            <small class="text-muted" id="anexo_<?= $idx ?>_titulo"><?= $processData["uploads"]["anexo_{$idx}"]->arquivo_nome_original ?? '' ?></small>
                        </div>
                    </div>
                    <?php $idx += 1; ?>
                <?php } ?>
            <?php } else { ?>
                <div class="row item g-2 mb-3 container-item" data-idx="<?= 1 ?>" style="position: relative;">

                    <div class="col-12">
                        <i class="ph ph-trash float-end text-danger" style="position:absolute; right: 20px; top: 20px; cursor: pointer;" onclick="removeItem(this)"></i>
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="item_<?= 1 ?>" class="form-label">Item <span>*</span></label>
                        <input type="text" class="form-control form-control-sm" id="item_<?= 1 ?>" name="block_item[<?= 1 ?>][item]" value="<?= $item->item ?? '' ?>">
                    </div>

                    <div class="col-12 col-md-8">
                        <label for="item_descricao_<?= 1 ?>" class="form-label">Descrição <span>*</span></label>
                        <input type="text" class="form-control form-control-sm" id="item_descricao_<?= 1 ?>" name="block_item[<?= 1 ?>][descricao]" value="<?= $item->descricao ?? '' ?>">
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="demanda_mes_<?= 1 ?>" class="form-label">Demanda Mês <span>*</span></label>
                        <input type="text" class="form-control form-control-sm" id="demanda_mes_<?= 1 ?>" name="block_item[<?= 1 ?>][demanda_mes]" value="<?= $item->demanda_mes ?? '' ?>">
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="demanda_total_<?= 1 ?>" class="form-label">Demanda Total <span>*</span></label>
                        <input type="text" class="form-control form-control-sm" id="demanda_total_<?= 1 ?>" name="block_item[<?= 1 ?>][demanda_total]" value="<?= $item->demanda_total ?? '' ?>">
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="anexo_<?= 1 ?>" class="form-label">Anexo</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm attach" name="block_item[<?= 1 ?>][anexo]" id="anexo_<?= 1 ?>" readonly value="<?= $item->anexo ?? '' ?>">
                            <button class="btn btn-company d-flex align-items-center justify-content-center is-trigger" type="button" id="anexo_<?= 1 ?>_trigger"><i class="ph ph-monitor-arrow-up fs-5"></i></button>
                        </div>
                        <small class="text-muted" id="anexo_<?= 1 ?>_titulo"><?= $processData["uploads"]["anexo_1"]->arquivo_nome_original ?? '' ?></small>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>



    <div class="row mb-5">
        <div class="col-12 col-md-4">
            <label for="frete_tipo" class="form-label fw-bold">Tipo de Frete <span>*</span></label>
            <select name="frete_tipo" id="frete_tipo" class="form-select form-select-sm t-center">
                <option value="">Escolha</option>
                <?php foreach (frete_tipo_options() as $idx => $freteTipo) { ?>
                    <option value="<?= $freteTipo ?>" <?= isSelect($processData["etapa_vendas_alinhamento"]->frete_tipo, $freteTipo) ?>><?= $freteTipo ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-12 col-md-4">
            <label for="frete_tipo_transporte" class="form-label fw-bold">Tipo de Transporte <span>*</span></label>
            <select name="frete_tipo_transporte" id="frete_tipo_transporte" class="form-select form-select-sm t-center">
                <option value="">Escolha</option>
                <?php foreach (frete_tipo_transporte_options() as $idx => $freteTipoTransporte) { ?>
                    <option value="<?= $freteTipoTransporte ?>" <?= isSelect($processData["etapa_vendas_alinhamento"]->frete_tipo_transporte, $freteTipoTransporte) ?>><?= $freteTipoTransporte ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-12 col-md-4">
            <label for="percentual_comissao" class="form-label fw-bold">Percentual de Comissão</label>
            <input type="text" class="form-control form-control-sm text-center" id="percentual_comissao" name="percentual_comissao" value="<?= $processData["etapa_vendas_alinhamento"]->percentual_comissao ?>">
        </div>
    </div>




    <div class="row mb-4">
        <div class="col-12 col-md-4">
            <h6 class="fw-bold">OBSERVAÇÕES</h6>
        </div>

        <div class="col-12 mb-3">
            <textarea name="observacoes" id="observacoes" class="form-control form-control-sm"></textarea>
        </div>
    </div>


    <div class="row mb-4">
        <div class="col-12 col-md-4">
            <h6 class="fw-bold cursor-pointer" id="historico_label">HISTÓRICO <i class="ph ph-caret-down"></i></h6>
        </div>


        <div id="historico" class="row mb-5">
            <?php if ($processData['observacoes']) { ?>
                <!-- <?php foreach ($processData['observacoes'] as $idx => $ob) { ?> -->
                <div class="col-12">
                    <div class="comments p-3 mb-3" style="border: 1px solid #CCC; border-radius: 8px;">
                        <small class="text-muted">Há <b><?= getDiffFrom(new DateTime($ob->criado_em)) ?></b> na etapa <b><?= $ob->etapa ?></b></small><br>
                        <span><b><?= $ob->usuario_nome ?></b>: <?= $ob->descricao ?></span>
                    </div>
                </div>
                <!-- <?php } ?> -->
            <?php } ?>
        </div>


        <div class="row" id="container-buttons">
            <div class="col-12">
                <button type="button" class="btn btn-company btn-sm float-end">Aprovar <i class="ph ph-arrow-right ms-1"></i></button>
                <button type="button" class="btn btn-dark btn-sm float-end me-2" onclick="document.getElementById('modalGravarTrigger').click();">Gravar <i class="ph ph-floppy-disk ms-1"></i></button>
            </div>
        </div>
    </div>
</form>


<?= $this->insert("shared/components/uploads"); ?>
<?= $this->insert("shared/components/store"); ?>