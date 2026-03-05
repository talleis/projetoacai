<?php
session_start();
include_once('./conexao.php');

// USAR ?? PARA EVITAR WARNINGS
$celular = $_POST['celular'] ?? '';
$senha = $_POST['senha'] ?? '';

// Verifica se os campos não estão vazios
if (empty($celular) || empty($senha)) {
    echo "Celular e senha são obrigatórios.";
    exit;
}

// Consulta ao banco (USE PREPARED STATEMENTS PARA SEGURANÇA)
$sql = "SELECT * FROM usuario WHERE celular = ? AND senha = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("ss", $celular, $senha); // "ss" = string, string
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    session_regenerate_id(true);

    // Gera token
    $token = bin2hex(random_bytes(16));
    $userId = $usuario['id']; // CORRIGIDO: usa ID, não celular
    $celularUsuario = $usuario['celular']; // Guarda o celular

    // Salva o token no banco - CORRIGIDO: usa ID ou CELULAR corretamente
    $stmtUpdate = $conexao->prepare("UPDATE usuario SET token_login = ? WHERE id = ?");
    $stmtUpdate->bind_param("si", $token, $userId); // "si" = string, integer (ID é int)
    $stmtUpdate->execute();

    // Define cookie com validade de 30 dias
    setcookie("login_token", $token, time() + (86400 * 30), "/", "", true, true);

    // Define variáveis de sessão
    $_SESSION['id'] = $usuario['id']; // Adiciona ID na sessão
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['celular'] = $usuario['celular'];
    $_SESSION['pontos'] = $usuario['pontos'] ?? 0;
    $_SESSION['token'] = $token;
    $_SESSION['gerencial'] = $usuario['gerencial'] ?? 0;
    
    // Verifica se coinAcai.php existe antes de incluir
    if (file_exists('coinAcai.php')) {
        require_once 'coinAcai.php';
    }

    if (($usuario['gerencial'] ?? 0) == 1) {
        header("Location: gerencial.php");
    } else {
        header("Location: home.php");
    }
    exit;
} else {
    echo "Celular ou senha incorretos.";
    echo "<br><a href='javascript:history.back()'>Voltar</a>";
}

$conexao->close();
?>