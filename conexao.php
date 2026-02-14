<?php 

$host = "localhost"; 
$usuario = "root"; 
$senha= "5288"; 
$banco= "acai_mania";




$conexao = mysqli_connect($host, $usuario, $senha, $banco);
if (!$conexao) {
    
    die("Conexão falhou: " . mysqli_connect_error());
}
  if ($conexao){ 
  var_dump($conexao);
    die("Conexão realizada com sucesso: " . mysqli_connect_error());
            
}