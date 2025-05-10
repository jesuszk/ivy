<?php

namespace src\services\shared;

use src\repositories\shared\SalesAlignmentRepository;

class SalesAlignmentService
{
    function __construct(
        private SalesAlignmentRepository $salesAlignmentRepository
    ) {}

    /**
     * Cria um registro com os dados vazios na tabela: etapa_vendas_alinhamento
     * @param string $processUuid
     * @return bool|array<string, mixed>
     */
    function open(string $processUuid): bool|array
    {
        return $this->salesAlignmentRepository->create(["processo_uuid" => $processUuid]);
    }


    function persist(array $data)
    {
        return $this->salesAlignmentRepository->updateByColumn("processo_uuid", $data);
    }

    function persistItens(array $items)
    {
        $table = $_ENV["TABLE_SALES_ALIGNMENT_ITEMS"];

        $this->salesAlignmentRepository->table($table)->deleteByColumn("processo_uuid", $_POST["processo_uuid"]);
        foreach ($items as $idx => $item) {
            $this->salesAlignmentRepository->table($table)->create($item);
        }
    }
}
