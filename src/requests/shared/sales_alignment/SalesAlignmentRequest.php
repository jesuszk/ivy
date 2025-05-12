<?php

namespace src\requests\shared\sales_alignment;

use src\requests\Request;

class SalesAlignmentRequest extends Request
{


    protected bool $ignoreRules = true;
    protected array $rules = [];


    function toEtapaVendasAlinhamento(): array
    {
        $columns = ["processo_uuid", "tipo", "familia", "prazo_entrega", "documentacao_suplementar", "documentacao_descricao", "receita_linha", "origem", "destino", "solicitante", "cliente", "prazo_entrega_cliente", "frete_tipo", "frete_tipo_transporte", "percentual_comissao"];
        $data = $this->get();
        return request()->emptyToNull(array_only($data, $columns));
    }

    function toEtapaVendasAlinhamentoItens(): array
    {
        $itens = [];
        foreach ($_POST["block_item"] as $idx => $item) {
            $itens[] = request()->emptyToNull(array_merge($item, ["processo_uuid" => $this->get("processo_uuid"), "etapa_vendas_alinhamento_uuid" => $this->get("etapa_vendas_alinhamento_uuid")]));
        }
        return $itens;
    }
}
