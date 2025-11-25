<?php
include_once('./conexao.php');

$sql = "SELECT * FROM pedidos WHERE `status` = 0";
$result = $conexao->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        echo "ID: " . "#". $row["id"]. "   " . $row["nome"]."<br><br>";
        echo "Tamanho:" . $row["tamanho"]. "<br>";
        echo "Adicional:" . $row["adicional"]. "<br>";
        echo "Complemento:" . $row["complemento"]. "<br>";
        echo "Celular:" . $row["celular"]. "<br>";
        echo "Valor: R$ " . $row["valor"]. "<br>";
        echo "Endereço: " . $row["endereco"] . "<br>";
        echo  "Nº: " . $row["numero"] . "<br>";
        echo "Bairro:" . $row["bairro"] . "<br>";
        echo "Obs: " . $row["obs"] . "<br>";
       
        require 'botao.php';
        echo "<hr>";

    }
} else {
    echo "0 resultados";


}
?>