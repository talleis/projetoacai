<?php
session_start();
include_once('./conexao.php');

$celular = $_SESSION['celular'];

$sql = "SELECT pontos FROM usuario WHERE celular = '$celular'";
$result = $conexao->query($sql);

if ($result && $result->num_rows > 0) {
    $coinAcai = $result->fetch_assoc();
    $_SESSION['pontos'] = $coinAcai['pontos'];
} else {
    $_SESSION['pontos'] = 0; // valor padrão se não encontrar
}

$conexao->close();
?>