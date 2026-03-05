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
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icone" href="favicon.png" />
</head>

<body>
    <header>
        <div class="topo">
            <div class="logo">
                <img src="imagens/logo.jpg.jpg" alt="Logo Açaí">
                <h1>Açaí Mania</h1>
            </div>
            <div>
                <?php if (isset($_SESSION['nome'])): (isset($_SESSION['pontos'])); ?>

                    <div class="menu">
                        <div class="text-menu">
                            <p>Bem-vindo, <strong><?php echo $_SESSION['nome']; ?></strong>!</p>
                            <a href="logout.php"><button class="botaosair">Sair</button></a>
                        </div>
                        <div>
                                                        <!-- No menu ou onde preferir -->
                            <a href="ver_minhas_comissoes.php" style="background: #4CAF50; color: white; padding: 10px; text-decoration: none; border-radius: 5px;">
                                💰 Minhas Comissões
                            </a>
                            <p class="pontos">Seus Maniacoin
                                <img src=imagens/coinacai.jpg.png alt="coin acai" width="30px" height="30px">
                                <strong><?php echo $_SESSION['pontos'] ?></strong>
                        </div>
                                                        <!-- Coloque isso onde quiser no seu home.php -->
                                <div class="menu-indicacao">
                                    <a href="meulink.php" class="btn-indicacao">
                                        🔗 Meu Link de Indicação
                                    </a>
                                </div>

                                <!-- CSS para o botão (adicione no seu style.css) -->
                                <style>
                                .btn-indicacao {
                                    display: inline-block;
                                    padding: 10px 20px;
                                    background: #4CAF50;
                                    color: white;
                                    text-decoration: none;
                                    border-radius: 5px;
                                    font-weight: bold;
                                    margin: 10px;
                                }
                                .btn-indicacao:hover {
                                    background: #45a049;
                                }
                                </style>
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