 /**
     * Configura evento para esconder/exibir o histórico de observações 
     */
 document.getElementById('historico_label').addEventListener('click', e => {
    let iconElement = e.target.querySelector('i');
    if (iconElement.classList.contains('ph-caret-down')) {
        document.getElementById('historico').classList.add('d-none');
        iconElement.classList.remove('ph-caret-down');
        iconElement.classList.add('ph-caret-up');
    } else if (iconElement.classList.contains('ph-caret-up')) {
        document.getElementById('historico').classList.remove('d-none');
        iconElement.classList.remove('ph-caret-up');
        iconElement.classList.add('ph-caret-down');
    }
});


/**
 * Configura evento para exibir a modal de upload no botão de documentação suplementar
 */
document.getElementById('documentacao_suplementar_trigger').addEventListener('click', e => {
    document.getElementById('uploads_configs').value = JSON.stringify({
        processo_uuid: document.getElementById('processo_uuid').value,
        origem: ETAPAS_VENDAS_ALINHAMENTO,
        origem_campo: "documentacao_suplementar",
        arquivo_descricao: "Documentação Suplementar"
    });
    document.getElementById('centralUploadsTrigger').click();
})



/**
 * Configura evento para adicionar mais um item na grid de itens
 */
document.getElementById('item_add').addEventListener("click", () => {
    const blocks = document.getElementById('items');
    const firstBlock = blocks.querySelector('.container-item');
    const newBlock = firstBlock.cloneNode(true);
    newBlock.querySelectorAll('input').forEach(input => {
        input.value = ''
    });
    newBlock.querySelectorAll('small').forEach(small => small.innerText = '');
    blocks.appendChild(newBlock);
    setTimeout(() => {
        reorganizeIndexes();
    }, 300);
})


/**
 * Execução no evento do botão de adicionar itens.
 * 
 * Reorganiza o ID dos elementos da grid
 * Reconfigura os eventos de click dos campos de uploads
 */
function reorganizeIndexes() {
    let items = document.getElementById('items');
    let childrens = items.children;

    let index = 1;
    for (const c of childrens) {

        for (const label of c.querySelectorAll("label")) {
            let labelFor = label.getAttribute("for");
            label.setAttribute("for", labelFor.substring(0, labelFor.lastIndexOf('_')) + `_${index}`);
        }

        for (const input of c.querySelectorAll("input")) {
            let inputName = input.getAttribute("name");
            input.setAttribute("name", inputName.replace(/\[(\d+)\]/, `[${index}]`));

            let inputId = input.getAttribute("id");
            input.setAttribute("id", inputId.substring(0, inputId.lastIndexOf('_')) + `_${index}`);
        }


        c.querySelector('small').setAttribute('id', `anexo_${index}_titulo`);

        let trigger = c.querySelector(".is-trigger");
        let triggerNew = trigger.cloneNode(true);
        trigger.parentNode.replaceChild(triggerNew, trigger);
        triggerNew.setAttribute('id', `anexo_${index}_trigger`);

        let idxForField = index;
        triggerNew.addEventListener('click', () => {
            document.getElementById('uploads_configs').value = JSON.stringify({
                processo_uuid: document.getElementById('processo_uuid').value,
                origem: ETAPAS_VENDAS_ALINHAMENTO,
                origem_campo: "anexo_" + idxForField,
                arquivo_descricao: "anexo_" + idxForField
            });
            document.getElementById('centralUploadsTrigger').click();
        });

        c.setAttribute('data-idx', index);
        index += 1;
    }

}

/**
 * Remove um item da grid
 * Após a remoção, reoganiza os indexes e atualiza também campos dos uploads
 */
function removeItem(trashClicked) {
    const blocks = document.getElementById('items').children;
    if (blocks.length > 1) {
        trashClicked.parentElement.parentElement.remove();
        console.log(trashClicked.parentElement.parentElement.querySelector('.is-trigger').parentElement.querySelector('input'))
        reorganizeIndexes();
        updateAttachs();
    }
}

/**
 * Atualiza os campos dos uploads de acordo com a nova organização dos elementos da grid
 */
async function updateAttachs() {
    const attachs = document.querySelectorAll(".attach");

    for (const attach of attachs) {
        if (attach.value !== '') {
            const payload = {
                processo_uuid: document.getElementById('processo_uuid').value,
                uuid: attach.value,
                origem_campo: attach.getAttribute('id'),
                arquivo_descricao: attach.getAttribute('id'),
            };

            try {
                const response = await fetch(ROUTE_UPLOADS_UPDATE, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(payload),
                });

                if (!response.ok) {
                    throw new Error(`Erro HTTP: ${response.status}`);
                }

                const data = await response.json();
                console.log('Upload atualizado com sucesso:', data);
            } catch (error) {
                console.error('Erro ao atualizar upload', error);
            }
        }
    }
}



function handleSelectFamilies(selectType) {
    if (selectType.value !== V_FERROVIARIO) {
        hiddenElement(document.getElementById('container-familia'))
    } else {
        showElement(document.getElementById('container-familia'));
    }
}

reorganizeIndexes();