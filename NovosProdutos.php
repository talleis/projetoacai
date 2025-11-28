<?php


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Gerencial</title>
    <link rel="stylesheet" href="style.css">
</head>
<div class="faixaNovosProdutos">
    <P><span>NOVOS PRODUTOS</span> </P>
    <form action="uploadProduto.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="imagem" accept="image/*" required>
        <button type="submmit">Enviar Imagem</button>
        <P>Descrição do Produto</P>
        <label><input type="text" id="descricao" name="descricao" required></label><br>
        <button type="submmit">Enviar Descricão</button>
</div>
<div class="pedidosLista">
    <div class="pedidos" style="display: flex; flex-direction: column;">
        <p>EXEMPLO</p>
        <div class="pedidositem">
            <?php include_once('uploadProduto.php') ?>
        </div>
    </div>