<?php

include_once('./conexao.php');

#salvar no banco novos produtos
if (!isset($_FILES["imagem"]) ||!isset($_POST["descricao"])) {
    echo "nenhum novo produto";

exit;
}


$imagem = $_FILES["imagem"];
$descricao = $_POST["descricao"];

echo $descricao;
if (empty($imagem["name"]) || empty($descricao)) {
    echo "nenhum novo produto";
    exit;
}
$sql = "INSERT INTO produtos (imagem,descricao) 
        VALUES ('$imagem', '$descricao')";
        