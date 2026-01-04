
function abrirModal(id) {
    const modal = document.getElementById(id);
    if (modal) modal.style.display = "block";
}


function fecharModal(id) {
    const modal = document.getElementById(id);
    if (modal) modal.style.display = "none";
}


const PRECO_ADICIONAL = 5; 
const PRECO_BARCA = 49.99;
const PRECO_BROWNIE = 12.00;


function detectarModalAberto() {
    const modais = ["modal-acai", "modal-brownie", "modal-barca", "modal-acaitradicional"];
    for (let id of modais) {
        const modal = document.getElementById(id);
        if (modal && modal.style.display === "block") return id;
    }
    return null;
}

function calcularPreco(modalId) {
    let total = 0;

    if (modalId === "modal-acai") {
        const tamanho = document.querySelector("#modal-acai select[name='tamanho']");
        const adicional = document.querySelector("#modal-acai input[name='adicional']");

        if (tamanho) total += parseFloat(tamanho.value);
        if (adicional && adicional.checked) total += PRECO_ADICIONAL;
    }

    if (modalId === "modal-acaitradicional") {
        const tamanho = document.querySelector("#modal-acaitradicional select[name='tamanho']");
        if (tamanho) total += parseFloat(tamanho.value);
    }

    if (modalId === "modal-brownie") {
        total += PRECO_BROWNIE;
        const adicional = document.querySelector("#modal-brownie input[name='adicional']");
        if (adicional && adicional.checked) total += PRECO_ADICIONAL;
    }

    if (modalId === "modal-barca") {
        total += PRECO_BARCA;
        const adicional = document.querySelector("#modal-barca input[name='adicional']");
        if (adicional && adicional.checked) total += PRECO_ADICIONAL;
    }

    return total.toFixed(2);
}

document.addEventListener("click", function (e) {
    if (!e.target.classList.contains("btn-finalizar")) return;

    const modalId = e.target.getAttribute("data-modal");
    const preco = calcularPreco(modalId);

    document.getElementById("valorFinal").innerText = preco;

   
    abrirModal("modal-confirmar");
});

document.getElementById("confirmarPedidoBtn").addEventListener("click", function () {
    const modalId = detectarModalAberto();
    if (!modalId) return alert("Erro: Nenhum modal detectado.");

    const form = document.querySelector(`#${modalId} form`);
    if (form) form.submit();
});

document.querySelector("button[onclick=\"abrirModal('modal-confirmacao')\"]")
    .addEventListener("click", function (e) {
        e.preventDefault(); // evita submit

        const modalId = detectarModalAberto();
        if (!modalId) return alert("Erro: Nenhum modal aberto para confirmar");

        // 1. PEGAR OS VALORES DO MODAL ATUAL
        const tamanho = document.querySelector(`#${modalId} select[name='tamanho']`);
        const complementos = document.querySelectorAll(`#${modalId} input[name='complementos']:checked`);
        const adicionais = document.querySelectorAll(`#${modalId} input[name='adicional']:checked`);

        const preco = calcularPreco(modalId);

        // 2. MONTAR OS TEXTOS PARA O MODAL DE CONFIRMAÇÃO
        document.getElementById("conf-tamanho").innerText = tamanho ? tamanho.options[tamanho.selectedIndex].text : "-";

        document.getElementById("conf-complementos").innerText =
            complementos.length > 0
                ? [...complementos].map(c => c.value).join(", ")
                : "Nenhum";

        document.getElementById("conf-adicionais").innerText =
            adicionais.length > 0
                ? [...adicionais].map(a => a.value).join(", ")
                : "Nenhum";

        document.getElementById("conf-preco").innerText = preco;

        // 3. ABRIR MODAL
        abrirModal("modal-confirmacao");
    });
