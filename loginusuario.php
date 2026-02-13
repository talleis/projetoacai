<?php
session_start();
include_once('./conexao.php');

$celular = $_POST['celular'];
$senha = $_POST['senha'];

// Consulta ao banco
$sql = "SELECT * FROM usuario WHERE celular = '$celular' AND senha = '$senha'";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    session_regenerate_id(true);

    // Gera token
    $token = bin2hex(random_bytes(16));
    $userId = $usuario['celular']; // Corrigido: pega o ID do usuário

    // Salva o token no banco
    $stmt = $conexao->prepare("UPDATE usuario SET token_login = ? WHERE celular = ?");
    $stmt->bind_param("si", $token, $userId);
    $stmt->execute();

    // Define cookie com validade de 30 dias
    setcookie("login_token", $token, time() + (86400 * 30), "/", "", true, true);

    // Define variáveis de sessão
    
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['celular'] = $usuario['celular'];
    $_SESSION['pontos'] = $usuario['pontos'];
    $_SESSION['token'] = $token;
    $_SESSION['gerencial'] = $usuario['gerencial'];
    require_once 'coinAcai.php';

    if ($usuario['gerencial'] == 1) {
        header("Location: gerencial.php");
    } else {
        header("Location: home.php");
    }
    exit;
} else {
    echo "Celular ou senha incorretos.";
}

$conexao->close();
?>