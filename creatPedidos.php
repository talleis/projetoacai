<?php

session_start();
include_once('./conexao.php');
echo "<pre>";
var_dump($_POST);
echo "</pre>";
exit;

$tamanho = $_POST['tamanho'] ?? '';
$adicional = $_POST['adicional'] ?? '';
$celular  = $_POST['celular'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$numero   = $_POST['numero'] ?? '';
$bairro   = $_POST['bairro'] ?? '';
$obs      = $_POST['obs'] ?? '';
$nome     = $_POST['nome'] ?? '';

$valor = $tamanho == '300ml' ? 10.99 : ($tamanho == '500ml' ? 15.99 : ($tamanho == '700ml' ? 20.99 : 0));

$adicionalValor = (isset($_POST['adicional']) && $_POST['adicional'] === 'sim') ? 5.00 : 0;


$preco = floatval($_POST['preco'] ?? 0);


$valorTotal = $valor + $adicionalValor + $preco;

$complementos = $_POST['complemento'] ?? [];
if (!is_array($complementos)) {
    $complementos = [$complementos];
    }
    $complementoss = implode(", ", $complementos);
    
  echo  var_dump($_POST);

$sql = "INSERT INTO pedidos (nome, tamanho, adicional, complemento, celular, valor, endereco, numero, bairro, obs, status) 
        VALUES ('$nome','$tamanho', '$adicional', '$complementoss', '$celular', $valorTotal, '$endereco', '$numero', '$bairro', '$obs')";

if ($conexao->query($sql) === TRUE) {
    (!isset($_SESSION['celular']));
    (header("Location: index.php"));

    include "pontos.php";*/
    header("Location: home.php");
} else {
    echo "Erro: " . $conexao->error;
}

$conexao->close();
