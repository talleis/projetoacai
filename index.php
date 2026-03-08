<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Açai_mania</title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <header>
    <div class="topo">
      <div class="logo">
        <img src="imagens/logo.jpg.jpg" alt="Logo Açaí">
        <h1>Açaí Mania</h1>
      </div>
      <div class="botoes">
        <div class="cadastro-botao">
          <button onclick="abrirModal('modal-cadastro',)">Cadastrar</button>
        </div>
        <div class="cadastro-botao">
          <button onclick="abrirModal('modal-entrar')">Entrar</button>
        </div>
      </div>
    </div>
    <div class="mania">
      <h2> A MANIA DE SER O <span>MELHOR</span></h2>
      <a href="link-para-contatos" class="contatos">
        <img src="imagens/Instragam.png" alt="instagram">
        <img src="imagens/Whatsapp.png" alt="Whatsapp">
        <span>Contatos</span>
      </a>
    </div>
  </header>

  <!-- Modal de cadastro -->
  <div id="modal-cadastro" class="modal">
    <div class="modal-cadastro">
      <span class="fechar" onclick="fecharModal('modal-cadastro')">&times;</span>
      <h2>Cadastre-se para acumular pontos:</h2>
      
      <!-- Mensagem de indicação (opcional) -->
      <div id="indicacao-info" class= "indicacao" >
        🎉 Você está sendo indicado por um amigo!
      </div>
      
      <form action="creatusuario.php" method="post" class="login">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="celular">Celular:</label><br>
        <input type="text" id="celular" name="celular" required><br><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>
        
        <!-- CAMPO OCULTO PARA O CÓDIGO DE INDICAÇÃO -->
        <input type="hidden" id="codigo_indicador" name="codigo_indicador" value="">

        <button type="submit">Confirmar Cadastro</button>
      </form>
    </div>
  </div>

  <!-- Modal de entrar -->
  <div id="modal-entrar" class="modal">
    <div class="modal-conteudo-entrar">
      <span class="fechar" onclick="fecharModal('modal-entrar')">&times;</span>
      <h2></h2>
      <form action="loginusuario.php" method="post" class="login">
        <label for="celular">celular:</label><br>
        <input type="text" id="celular" name="celular" required><br><br>

        <label for="senha">senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>

        <button type="submit">entrar</button>
      </form>
    </div>
  </div>

  <!-- Faixa de destaque -->
  <div class="faixa-destaque">
    <h2>🍓 Escolha como satisfazer a sua vontade</h2>
  </div>
  
  <?php include_once('produtos.php'); ?>

  <script>
  // Funções dos modals (SUAS FUNÇÕES ORIGINAIS)
  function abrirModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
  }

  function fecharModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
  }

  // Fecha modal se clicar fora
  window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
      event.target.style.display = 'none';
    }
  }

  // NOVA FUNÇÃO: pegar parâmetro da URL
  function getParameterByName(name) {
    const url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
    const results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
  }

  // Quando a página carregar, verifica se tem ref na URL
  document.addEventListener('DOMContentLoaded', function() {
    const codigoReferral = getParameterByName('ref');
    
    if (codigoReferral) {
      // Coloca o código no campo oculto
      document.getElementById('codigo_indicador').value = codigoReferral;
      
      // Mostra a mensagem (opcional)
      document.getElementById('indicacao-info').style.display = 'block';
    }
  });
  </script>

</body>
</html>