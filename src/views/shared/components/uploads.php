<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#centralUploads" id="centralUploadsTrigger">
    Central de uploads
</button>

<!-- Modal -->
<div class="modal fade" id="centralUploads">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 t-center" id="centralUploadsLabel">Uploads <i class="ph ph-monitor-arrow-up"></i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="uploads_close"></button>
            </div>
            <div class="modal-body row g-3">

                <!-- Configs to return for fields -->
                <input type="hidden" id="uploads_configs">

                <div class="col-12">
                    <input type="file" name="central_uploads_file" id="central_uploads_file" class="form-control">
                </div>
                <div class="col-12">
                    <button type="button" id="central_uploads_submit" class="btn btn-company float-end">Upload <i class="ph ph-monitor-arrow-up"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById("central_uploads_submit").addEventListener("click", async function() {
        const fileInput = document.getElementById("central_uploads_file");
        const file = fileInput.files[0];

        if (!file) {
            alert("Por favor, selecione um arquivo antes de enviar.");
            return;
        }

        const formData = new FormData();
        formData.append("file", file);
        formData.append("configs", document.getElementById("uploads_configs").value);

        try {
            const response = await fetch(ROUTE_UPLOADS_SAVE, {
                method: "POST",
                body: formData,
            });

            const data = await response.json();

            if (data.status === "aprovado") {
                const uuid = data.uuid;
                let configs = JSON.parse(document.getElementById('uploads_configs').value);
                document.getElementById(configs.origem_campo).value = uuid
                document.getElementById(`${configs.origem_campo}_titulo`).innerText = file.name
                document.getElementById('central_uploads_file').value = "";
                document.getElementById('uploads_close').click();
            } else {
                alert("Arquivo não aprovado.");
            }
        } catch (error) {
            console.error("Erro ao enviar o arquivo:", error);
            alert("Erro de rede ao enviar o arquivo.");
        }
    });
</script>