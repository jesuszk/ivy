<?php

namespace src\controllers\shared;

use Exception;
use src\services\shared\UploadsService;
use src\support\Json;

class UploadsController
{
    function __construct(
        private UploadsService $uploadsService
    ) {}

    /**
     * API - Salva os arquivos na base
     * Sucesso: retorna status como aprovado e uuid do arquivo inserido na tabela uploads.
     * Erro: retorna status como rejeitado e uuid como nulo.
     */
    function save(): Json
    {
        try {
            $this->uploadsService->removePrevious();
            $upload = $this->uploadsService->save();
            return Json::return(["status" => 'aprovado', "uuid" => $upload["uuid"]], 200);
        } catch (Exception $e) {
            return Json::return(['status' => 'rejeitado', 'uuid' => null], 500);
        }
    }

    /**
     * API - Atualiza os dados de um upload
     * @return Json
     */
    function update()
    {
        try {
            $upload = $this->uploadsService->update();
            return Json::return(["status" => 'aprovado'], 200);
        } catch (Exception $e) {
            return Json::return(['status' => 'rejeitado', 'uuid' => null], 500);
        }
    }
}
