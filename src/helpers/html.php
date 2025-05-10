<?php


/**
 * Its responsible for return select when the options are equals
 *
 * @param mixed $variableValue
 * @param mixed $value
 * @return string
 */
function isSelect(mixed $variableValue, mixed $value): string
{
  return ($variableValue == $value) ? "selected" : '';
}

/**
 * Its responsible for return select when the options are equals
 *
 * @param array<int, mixed> $array
 * @param mixed $value
 * @return string
 */
function isSelectArray($array, $value): string
{
  return in_array($value, $array) ? "selected" : '';
}



function pagination(int $length)
{
  $current = $_GET["page"] ?? 1;
  $content = "";
  for ($i = 1; $i <= $length; $i++) {
    $active = ($i == $current) ? "active" : "";
    $color = ($i == $current) ? "style='background-color: var(--company-color); border: var(--company-color);'" : "";
    $content .= "<li class='page-item'><a class='page-link {$active}' {$color} href='?page={$i}'>{$i}</a></li>";
  }

  $pagination = "<nav>
    <ul class='pagination pagination-sm'>
        $content
    </ul>
  </nav>";

  return $pagination;
}


function families_options()
{
  return [
    "Ampara Balanço",
    "Braçadeira",
    "Castanha",
    "Chapa Apoio",
    "Chapa de Desgaste",
    "Chapa de Fricção",
    "Cruzeta",
    "Cunha",
    "Disco Bordeado",
    "Engate",
    "Espelho",
    "Haste de Ligação",
    "Lateral",
    "Mancal",
    "Mandíbula",
    "Ponteira",
    "Ponto Fixo",
    "Quadro Espelho",
    "Rodas",
    "Travessa",
    "Outros Fundidos"
  ];
}



function receita_options()
{
  return [
    "Fundidos Industriais",
    "Componentes Ferroviários",
    "Rodas",
    "Revisão de Preço"
  ];
}




function frete_tipo_options()
{
  return [
    "S/ FRETE",
    "EXW - EX WORKS (named place of delivery) : NA ORIGEM (local de entrega nomeado)",
    "FCA - FREE CARRIER (named place of delivery) : LIVRE NO TRANSPORTADOR (local de entrega nomeado)",
    "FAS - FREE ALONGSIDE SHIP (named port of shipment) : LIVRE AO LADO DO NAVIO (porto de embarque nomeado)",
    "FOB - FREE ON BOARD (named port of shipment) : LIVRE A BORDO (porto de embarque nomeado)",
    "CFR - COST AND FREIGHT (named port fo destination) : CUSTO DE FRETE (porto de destino nomeado)",
    "CIF - COST, INSURANCE AND FREIGHT (named port of destination) : CUSTO, SEGURO E FRETE (porto de destino nomeado)",
    "CPT - CARRIAGE PAID TO (named place of destination) : TRANSPORTE PAGO ATÉ (local de destino nomeado)",
    "CIP - CARRIAGE AND INSURANCE PAID TO (named place of destination) : TRANSPORTE E SEGURO PAGOS ATÉ (local de destino nomeado)",
    "DAT - DELIVERED AT TERMINAL (named terminal at port or place of destination) : ENTREGUE NO TERMINAL (terminal nomeado no porto ou local de destino)",
    "DAP - DELIVERED AT PLACE (named place of destination) : ENTREGUE NO LOCAL (local de destino nomeado)",
    "DDP - DELIVERED DUTY PAID (named place of destination) : ENTREGUE COM DIREITOS PAGOS (local de destino nomeado)"
  ];
}


function frete_tipo_transporte_options()
{
  return  [
    "Modal - Aéreo",
    "Modal - Ferroviário",
    "Modal - Marítimo",
    "Modal - Rodoviário"
  ];
}



function fourDigits(string $n) {
  return str_pad($n, 4, '0', STR_PAD_LEFT);
}