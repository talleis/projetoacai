<?php
include_once('./conexao.php');

$id = $_POST['id_pedido'];
$status = $_POST['status'];

$sql = "UPDATE pedidos SET `status` = $status WHERE id = $id";

if ($conexao->query($sql) === TRUE) {
    /*include "pontos.php";*/
    header("Location: gerencial.php");
    exit;
} else {
    echo "Erro: " . $conexao->error;
}
$conexao->close();
