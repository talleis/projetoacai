<?php

include_once('./conexao.php');

if (!isset($_SESSION['celular'])) {
    die(header("Location: index.php"));
        #"Erro: usuário não identificado!"#
}

$usuario_celular = $_SESSION['celular']; 

$sql = "SELECT valor FROM pedidos 
        WHERE celular = '$usuario_celular'
        ORDER BY id DESC
        LIMIT 1";

$resultado = $conexao->query($sql);

if ($resultado->num_rows == 0) {
    die("Nenhum pedido encontrado para esse usuário.");
}

$pedido = $resultado->fetch_assoc();
$valorPedido = floatval($pedido['valor']);

$pontos = $valorPedido / 100;


$sql = "SELECT pontos FROM usuario WHERE celular = '$usuario_celular'";
$result = $conexao->query($sql);
$linha = $result->fetch_assoc();

$pontosAtuais = floatval($linha['pontos'] ?? 0);

$novoTotal = $pontosAtuais + $pontos;


$sqlUpdate = "UPDATE usuario SET pontos = $novoTotal WHERE celular = '$usuario_celular'";

if ($conexao->query($sqlUpdate)) {
    $_SESSION['pontos'] = $novoTotal;
    echo "Pontos atualizados: " . number_format($novoTotal, 2, ',', '.');
} else {
    echo "Erro ao atualizar pontos!";
}
?>
