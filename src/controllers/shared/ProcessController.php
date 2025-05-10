<?php

namespace src\controllers\shared;

use Exception;
use src\services\shared\ProcessService;
use src\services\shared\SalesAlignmentService;
use src\support\Redirect;

class ProcessController
{
    function __construct(
        private ProcessService $processService,
        private SalesAlignmentService $salesAlignmentService
    ) {}

    /**
     * Responsável por realizar a abertura da SFP
     * Insere dados nas tabelas: processo, etapa_vendas_alinhamento
     * Caso aconteça algum problema com as etapas, apaga tudo o que foi inserido.
     * 
     * Sucesso: redireciona para a visualização do processo na etapa de vendas alinhamento
     * Erro: rediciona para a tela de listagem de sfps de vendas alinhamento
     * @return Redirect
     */
    function open(): Redirect
    {
        $process = $this->processService->open();

        try {
            $salesAlignment = $this->salesAlignmentService->open($process["uuid"]);
            make_log(conteudo: "SFP Iniciada", processo_uuid: $process["uuid"]);
            return redirect()->route("sales.alignment.showing", ["uuid" => $process["uuid"]])->withSuccess("A SFP {$process["id"]} foi iniciada com sucesso. 🎉");
        } catch (Exception $e) {
            $this->processService->rollback($process["uuid"]);
            return redirect()->route("sales.alignment.list")->withError("Não foi possível iniciar a SFP 📢");
        }
    }
}
