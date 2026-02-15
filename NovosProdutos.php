<?php


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Gerencial</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<div class="faixaNovosProdutos">
    <P><span>NOVOS PRODUTOS</span> </P>
    <form action="uploadProduto.php" method="POST" enctype="multipart/form-data">
        <div class="descricao">
            <P>Descrição do Produto</P>
            <textarea id="descricao" name="descricao"></textarea>
        </div>
        <div class="enviardescricao">
            <button type="submmit">Enviar Descricão</button><br>
            <input type="file" name="imagem" accept="image/*" required><br>
            <button type="submit">Enviar Imagem</button>
        </div>
    </form>
</div>
<div class="pedidosLista">
    <div class="pedidos" style="display: flex; flex-direction: column;">
        <p>EXEMPLO</p>
        <div class="pedidositem">
        </div>
    </div>