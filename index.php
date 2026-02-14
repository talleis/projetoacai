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

<body class="global">
  <header>
    <div class="topo">
      <div class="logo">
        <img src="imagens/logo.jpg.jpg" alt="Logo Açaí">
        <h1>Açaí Mania</h1>
      </div>
      <div class="botoes">
        <div class="cadastro-botao">
          <button onclick="abrirModal('modal-cadastro')">Cadastrar</button>
        </div>
        <div class="cadastro-botao">
          <button onclick="abrirModal('modal-entrar')">login</button>
        </div>
      </div>
    </div>
    <div class="mania">
      <h2> A MANIA DE SER O <span>MELHOR</span></h2>
    </div>

  </header>

  <!-- Modal de cadastro -->
  <div id="modal-cadastro" class="modal">
    <div class="modal-conteudo">
      <span class="fechar" onclick="fecharModal('modal-cadastro')">&times;</span>
      <h2>Cadastre-se para acumular pontos:</h2>
      <form action="creatusuario.php" method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="celular">Celular:</label><br>
        <input type="text" id="celular" name="celular" required><br><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>

        <button type="submit">Confirmar Cadastro</button>
      </form>
    </div>
  </div>

  <div id="modal-entrar" class="modal">
    <div class="modal-conteudo">
      <span class="fechar" onclick="fecharModal('modal-entrar')">&times;</span>
      <h2></h2>
      <form action="loginusuario.php" method="post">
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

  </section>

</html>