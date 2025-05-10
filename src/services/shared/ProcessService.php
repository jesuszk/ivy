<?php

namespace src\services\shared;

use src\repositories\shared\ProcessRepository;

class ProcessService
{
    function __construct(
        private ProcessRepository $processRepository
    ) {}

    /**
     * Cria um registro na tabela processo apenas com os dados iniciais
     * @return array<string, mixed>|bool
     */
    function open(): array|bool
    {
        return $this->processRepository->create([
            "iniciador_chave" => $_SESSION["usuarioLogin"],
            "iniciador_nome" => $_SESSION["usuarioNome"],
            "etapa_atual" => $_ENV["SALES_ALIGNMENT"],
            "estado" => $_ENV["STATE_OPENED"]
        ]);
    }

    /**
     * Caso aconteça algum erro na abertura do processo, realiza o rollback excluindo os dados de todas as tabelas secundárias.
     * @param string $processUuid
     * @return null
     */
    function rollback(string $processUuid): null
    {
        return $this->processRepository->rollback($processUuid);
    }

    /**
     * Obtém os dados de todas as etapas do processo
     * @param string $processUuid
     * @return array<string, mixed>
     */
    function findProcessDataAllSteps(string $processUuid): array
    {
        return $this->processRepository->findProcessDataAllSteps($processUuid);
    }

    /**
     * Lista todos os processos em uma etapa específica
     * @param string $chapter
     * @return array<int, mixed>|bool
     */
    function listIn(string $chapter)
    {
        return $this->processRepository->listIn(chapter: $chapter);
    }

    /**
     * Salva os dados na tabela processo
     * @param array $data
     * @return bool|array<string, mixed>
     */
    function persist(array $data): bool|array
    {
        return $this->processRepository->updateByUuid($data["uuid"], $data);
    }

    /**
     * Salva os dados na tabela de observações
     * @param array $data
     * @return bool|array<string, mixed>
     */
    function persistObservations(array $data): bool|array
    {
        if (notEmpty($data["descricao"]))
            return $this->processRepository->table($_ENV["TABLE_OBSERVATIONS"])->create($data);
        return false;
    }
}
