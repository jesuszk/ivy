<?php

namespace src\repositories\shared;

use Exception;
use PDOException;
use src\repositories\Querio;

class UploadsRepository extends Querio
{
    protected string $table = "uploads";

    /**
     * Desc: Salva os dados na tabela
     * Tabela: uploads
     * @param array<string, mixed> $data
     * @return array<mixed, mixed>|false
     */
    function do(array $data): array|false
    {
        try {
            return $this->create($data);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
