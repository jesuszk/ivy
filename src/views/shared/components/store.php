<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalGravar" id="modalGravarTrigger">
    trigger gravar
</button>

<!-- Modal -->
<div class="modal fade" id="modalGravar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header style-message">
                <h1 class="modal-title fs-5 t-center" id="modalGravarLabel">💾 Gravar dados da etapa</h1>
                <button type="button" class="btn-close d-none" data-bs-dismiss="modal" id="modalGravarClose"></button>
            </div>
            <div class="modal-body row g-3">

                <p>1️⃣ Os dados serão gravados, mas o processo continuará na mesma etapa.</p>
                <p>2️⃣ Se os dados forem gravados, as informações anteriores serão perdidas permanentementes.</p>

                <div class="col-12">
                    <button type="button" id="modalGravarSubmit" class="btn btn-company float-end" onclick="persistData()">Sim, gravar <i class="ph ph-floppy-disk"></i></button>
                    <button type="button" class="btn btn-danger float-end me-2" onclick="document.getElementById('modalGravarClose').click()">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function persistData() {
        let method = 'POST';
        let routePersist = document.getElementById('rota_gravar').value;
        let forChapter = document.getElementById('etapa_atual').value;
        let formChapter = document.getElementById("formChapter");

        formChapter.setAttribute('action', routePersist);
        formChapter.setAttribute('method', method);

        let hiddenInputCurrent = document.createElement("input");
        hiddenInputCurrent.setAttribute("type", "hidden");
        hiddenInputCurrent.setAttribute("name", "etapa_atual");
        hiddenInputCurrent.setAttribute("value", forChapter);
        formChapter.appendChild(hiddenInputCurrent);

        let hiddenInputLog = document.createElement("input");
        hiddenInputLog.setAttribute("type", "hidden");
        hiddenInputLog.setAttribute("name", "log");
        hiddenInputLog.setAttribute("value", "Salvando dados do processo");
        formChapter.appendChild(hiddenInputLog);

        formChapter.submit();
    }
</script>