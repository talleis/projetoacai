<?php
session_start();

if (!isset($_SESSION['nome']) && isset($_COOKIE['login_token'])) {
    $token = $_COOKIE['login_token'];

    // Verifica o token no banco de dados
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE token_login = ?");
    $stmt->execute([$token]);
    $usuario = $stmt->fetch();

    if ($usuario) {
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['pontos'] = $usuario['pontos'];
    } else {
        header("Location: loginusuario.php");
        exit;
    }
} elseif (!isset($_SESSION['nome'])) {
    header("Location: loginusuario.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Açaí Mania</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="topo">
            <div class="logo">
                <img src="imagens/logo.jpg.jpg" alt="Logo Açaí">
                <h1>Açaí Mania</h1>
            </div>

            <!-- Botões do topo -->
            <div>
                <?php if (isset($_SESSION['nome'])): (isset($_SESSION['pontos'])); ?>

                    <div style="display: flex; flex-direction:column;">
                        <div style="display: flex; flex-direction:row; align-items: center;gap: 10px; justify-content: flex-end;">
                            <p>Bem-vindo, <strong><?php echo $_SESSION['nome']; ?></strong>!</p>
                            <a href="logout.php"><button class="botaosair">Sair</button></a>
                        </div>
                        <div>
                            <p class="pontos">Seus Maniacoin
                                <img src=imagens/coinacai.jpg.png alt="coin acai" width="30px" height="30px">
                                <strong><?php echo $_SESSION['pontos'] ?></strong>
                        </div>
                        </p>
                    </div>
                <?php else: ?>
                    <div class="cadastro-botao">
                        <button onclick="abrirModal('modal-sair')">sair</button>
                    </div>
            </div>
        </div>
    <?php endif; ?>
    </div>
    </div>
    <div>
      <h2> O Melhor e mais delicioso Açaí da Região </h2>
    </div>
    </header>

    <!-- Faixa de destaque -->
    <div class="faixa-destaque">
        <h2>🍓 Escolha como satisfazer a sua vontade</h2>
    </div>
    <?php include_once('produtos.php'); ?>

    </section>

    <script src="script.js"></script>
</body>

</html>