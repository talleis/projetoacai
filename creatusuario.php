<?php
session_start();
include_once('./conexao.php');

$nome    = $_POST['nome'] ?? '';
$email   = $_POST['email'] ?? '';
$celular = $_POST['celular'] ?? '';
$senha   = $_POST['senha'] ?? '';


$sql = "SELECT * FROM usuario WHERE celular = '$celular'";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
 
    echo "Celular já cadastrado!";
    
    exit;
}

$sql = "INSERT INTO usuario (nome, email, celular, senha) 
        VALUES ('$nome', '$email', '$celular', '$senha')";

if ($conexao->query($sql) === TRUE) {
   
    $_SESSION['celular'] = $celular;
    header("Location: home.php");
    exit;
} else {
    echo "Erro ao cadastrar: " . $conexao->error;
}

$conexao->close();
?>
