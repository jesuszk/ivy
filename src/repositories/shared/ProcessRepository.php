<?php

namespace src\repositories\shared;

use Exception;
use PDOException;
use src\database\Database;
use src\repositories\Querio;

class ProcessRepository extends Querio
{
    protected string $table = "processo";


    function rollback(string $processUuid)
    {
        $db = (Database::setConfig())::get();
        $tables = [
            $_ENV["TABLE_PROCESS"] => "uuid",
            $_ENV["TABLE_SALES_ALIGNMENT"] => "processo_uuid",
            $_ENV["TABLE_SALES_ALIGNMENT_ITEMS"] => "processo_uuid"
        ];
        foreach ($tables as $table => $column) {
            try {
                $stmt = $db->prepare("DELETE FROM {$table} WHERE {$column} = :processUuid");
                $stmt->execute([":processUuid" => $processUuid]);
            } catch (PDOException $e) {
                dd($e);
            }
        }
    }


    function findProcessDataAllSteps(string $processUuid)
    {
        $tables =  [
            $_ENV["TABLE_PROCESS"] => [
                "column" => "uuid",
                "isOne" => true
            ],
            $_ENV["TABLE_SALES_ALIGNMENT"] => [
                "column" => "processo_uuid",
                "isOne" => true
            ],
            $_ENV["TABLE_OBSERVATIONS"] => [
                "column" => "processo_uuid",
                "isOne" => false
            ],
            $_ENV["TABLE_SALES_ALIGNMENT_ITEMS"] => [
                "column" => "processo_uuid",
                "isOne" => false
            ],
            $_ENV["TABLE_UPLOADS"] => [
                "column" => "processo_uuid",
                "isOne" => false
            ],
        ];
        $data = [];
        foreach ($tables as $table => $column) {
            if ($column['isOne'])
                $data[$table] = $this->table($table)->getByColumn($column["column"], $processUuid);
            else
                $data[$table] = $this->table($table)->getByColumnMany($column["column"], $processUuid);
        }
        $organizados = [];

        if ($data["uploads"]) {
            foreach ($data["uploads"] as $item) {
                if (isset($item->origem_campo)) {
                    $organizados[$item->origem_campo] = $item;
                }
            }   
            $data[$_ENV["TABLE_UPLOADS"]] = $organizados;
        }
        return $data;
    }



    function listIn(string $chapter)
    {
        return $this->select(['*'])->getByColumnMany(column: "etapa_atual", value: $chapter);
    }
}
