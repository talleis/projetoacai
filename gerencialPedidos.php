<?php

?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Mostrar Pedidos</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="topo2">
        <div class="pedidosLista">
            <div class="pedidos" style="display: flex; flex-direction: column;">
                <p>NOVOS PEDIDOS</p>
                <div class="pedidositem">
                    <?PHP include_once('buscaPedidos.php') ?>
                </div>
            </div>
        </div>
        <div class="pedidosLista">
            <div class="pedidos" style="display: flex; flex-direction: column;">
                <p>PREPARANDO</p>
                <div class="pedidositem">
                    <?php include_once('pedidoAceito.php') ?>
                </div>
            </div>
        </div>
        <div class="pedidosLista">
            <div class="pedidos" style="display: flex; flex-direction: column;">
                <p>CONCLUIDOS</p>
                <div class="pedidositem">
                    <?PHP include_once('pedidosConcluidos.php') ?>
                </div>
            </div>
        </div>
        <div class="pedidosLista">
            <div class="pedidos" style="display: flex; flex-direction: column;">
                <p> RECUSADOS</p>
                <div class="pedidositem">
                    <?PHP include_once('pedidosrecusados.php') ?>
                </div>
            </div>
        </div>


    </div>
</body>

</html>