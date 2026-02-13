<?php
include_once('./conexao.php');

$sql = "SELECT * FROM pedidos WHERE `status` = 1";
$result = $conexao->query($sql);
if ($result->num_rows > 0) {
    while ($pedido = $result->fetch_assoc()) {
        echo " ID: ". "#". $pedido["id"] . "<br>";
        echo "Celular: " . $pedido["celular"] . "<br>";
        echo "Valor: R$ " . $pedido["valor"] . "<br>";
        echo "Tamanho: " . $pedido["tamanho"] . "<br>";
        echo "Complemento: " . $pedido["complemento"] . "<br>";
        echo "Adicional: " . $pedido["adicional"] . "<br>";
        echo "Endereço: " . $pedido["endereco"] . "<br>";
        echo  "Nº: " . $pedido["numero"] . "<br>";
        echo "Bairro:" . $pedido["bairro"] . "<br>";
        echo "Obs: " . $pedido["obs"] . "<br>";
        echo '
            <form action="atualizaStatus.php" method="POST">
                <input type="hidden" name="id_pedido" value="' . $pedido['id'] . '">
                <input type="hidden" name="status" value="2">
                <button type="submit">Concluído</button>
            </form>
        ';
        echo "<hr>";  
    }
} else {
    echo "Nenhum pedido aceito no momento.";
}
