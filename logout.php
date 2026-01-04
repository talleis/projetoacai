<?php
session_start();
include_once('./conexao.php');

setcookie("login_token", "", time() - 3600, "/"); // Expira o cookie

// Remove o token do banco
$stmt = $conexao->prepare("UPDATE usuario SET token_login = NULL WHERE celular = ?");
$stmt->execute([$_SESSION['id']]);


session_unset();
session_destroy();
header("Location: index.php");
exit;
?>
