<?php

namespace src\controllers\shared;

use Exception;
use PDOException;
use src\requests\shared\sales_alignment\SalesAlignmentRequest;
use src\services\shared\ProcessService;
use src\services\shared\SalesAlignmentService;
use src\support\Redirect;
use src\support\View;

class SalesAligmentController
{
    function __construct(
        private ProcessService $processService,
        private SalesAlignmentService $salesAlignmentService,
    ) {}

    /**
     * Lista todos os processos que estão parados na etapa
     * @return View
     */
    function list(): View
    {
        $processes = $this->processService->listIn($_ENV['SALES_ALIGNMENT']);
        return view("shared.sales-alignment.index", ["processes" => $processes]);
    }


    /**
     * Exibe a etapa com os todos os dados
     * Caso aconteça algum erro, volta para a listagem
     * @param string $processUuid
     * @return View|Redirect
     */
    function showing(string $processUuid): View|Redirect
    {
        try {
            $processData = $this->processService->findProcessDataAllSteps($processUuid);
            make_log("Acessou o processo na etapa {$_ENV["SALES_ALIGNMENT"]}", $processUuid);
            return view("shared.sales-alignment.showing", ["processData" => $processData]);
        } catch (Exception $e) {
            make_log("Houve um erro ao tentar abrir a SFP. Exception message: {$e->getMessage()}", $processUuid);
            return redirect()->route("sales.alignment.list")->withError("Não foi possível acessar a SFP");
        }
    }


    /**
     * Responsável por salvar os dados
     * Primeiro obtém os dados da request para cada tabela.
     * Então com os dados de cada tabela, tenta realizar a inserção.
     * 
     * Tabelas utilizadas: processo, observacoes, etapa_vendas_alinhamento e etapa_vendas_alinhamento_itens
     * @param SalesAlignmentRequest $request
     * @return Redirect
     */
    function persist(SalesAlignmentRequest $request): Redirect
    {
        try {
            $toProcesso = $request->toProcesso(currentChapter: $request->get('etapa_atual'));
            $toObservacao = $request->toObservacao();
            $toEtapaVendasAlinhamento = $request->toEtapaVendasAlinhamento();
            $toEtapaVendasAlinhamentoItens = $request->toEtapaVendasAlinhamentoItens();


            $this->processService->persist($toProcesso);
            $this->processService->persistObservations($toObservacao);
            $this->salesAlignmentService->persist($toEtapaVendasAlinhamento);
            $this->salesAlignmentService->persistItens($toEtapaVendasAlinhamentoItens);
            $request->log();

            return redirect()->back()->withSuccess("Os dados foram salvos com sucesso 🎉");
        } catch (Exception $e) {
            make_log("Erro ao tentar gravar os dados da SFP. Exception Message: {$e->getMessage()}", $request->get("processo_uuid"));
            return redirect()->back()->withSuccess("Não foi possível salvar os dados. Aguarde um instante e tente novamente.");
        }
    }
}
