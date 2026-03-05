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
const PRECO_BROWNIE = 12.0;

function detectarModalAberto() {
  const modais = [
    "modal-acai",
    "modal-brownie",
    "modal-barca",
    "modal-acaitradicional",
  ];
  for (let id of modais) {
    const modal = document.getElementById(id);
    if (modal && modal.style.display === "block") return id;
  }
  return null;
}

function calcularPreco(modalId) {
  let total = 0;

  if (modalId === "modal-acai") {
    const tamanho = document.querySelector(
      "#modal-acai input[name='tamanho']:checked",
    );
    const adicional = document.querySelector(
      "#modal-acai input[name='adicional']:checked",
    );
    if (tamanho) total += parseFloat(tamanho.dataset.preco || 0);
    if (adicional) total += parseFloat(adicional.dataset.preco || 0);
  }

  if (modalId === "modal-acaitradicional") {
    const tamanho = document.querySelector(
      "#modal-acaitradicional select[name='tamanho']",
    );
    if (tamanho) total += parseFloat(tamanho.value);
  }

  if (modalId === "modal-brownie") {
    total += PRECO_BROWNIE;
    const adicional = document.querySelector(
      "#modal-brownie input[name='adicional']:checked",
    );
    if (adicional) total += PRECO_ADICIONAL;
  }

  if (modalId === "modal-barca") {
    total += PRECO_BARCA;
    const adicional = document.querySelector(
      "#modal-barca input[name='adicional']:checked",
    );
    if (adicional) total += PRECO_ADICIONAL;
  }

  return total.toFixed(2);
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelectorAll("form[action='creatPedidos.php']")
    .forEach((form) => {
      form.addEventListener("submit", function (e) {
        e.preventDefault();

        const tamanho =
          this.querySelector('input[name="tamanho"]:checked')?.value ||
          "não escolhido";
        const adicional =
          this.querySelector('input[name="adicional"]:checked')?.value ||
          "nenhum";

        const complementos =
          [...this.querySelectorAll('input[name="complemento[]"]:checked')]
            .map((el) => el.value)
            .join(", ") || "nenhum";

        const precoTamanho =
          this.querySelector('input[name="tamanho"]:checked')?.dataset.preco ||
          0;
        const precoAdicional =
          this.querySelector('input[name="adicional"]:checked')?.dataset
            .preco || 0;

        const total = (
          parseFloat(precoTamanho) + parseFloat(precoAdicional)
        ).toFixed(2);

        const resumo = `
Resumo do pedido:

Tamanho: ${tamanho}
Adicional: ${adicional}
Complementos: ${complementos}

Total: R$ ${total}

Confirmar pedido?
`;

        if (confirm(resumo)) {
          this.submit();
        }
      });
    });
});
