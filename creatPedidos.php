<?php
session_start();
include_once('./conexao.php');

$tamanho = $_POST['tamanho'] ?? '';
$adicional = $_POST['adicional'] ?? '';
$celular  = $_POST['celular'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$numero   = $_POST['numero'] ?? '';
$bairro   = $_POST['bairro'] ?? '';
$obs      = $_POST['obs'] ?? '';
$nome     = $_POST['nome'] ?? '';
$entrega = 0;

$valor = 0;

if ($nome == "Ninhotella") {
    if ($tamanho == '300ml') $valor = 20.99;
    if ($tamanho == '500ml') $valor = 28.99;
    if ($tamanho == '700ml') $valor = 34.99;
}

if ($nome == "Tradicional") {
    if ($tamanho == '300ml') $valor = 10.99;
    if ($tamanho == '500ml') $valor = 15.99;
    if ($tamanho == '700ml') $valor = 20.99;
}

if ($nome == "Brownie") {
    $valor = 11.99;
}

if ($nome == "Barca 1.5 litros") {
    $valor = 49.99;
}

if ($adicional == "Creme de Nutella" || $adicional == "Creme De Nutella") {
    $valor += 5.00;
}

if ($adicional == "Creme de Ninho" || $adicional == "Creme De Leite Ninho") {
    $valor += 5.00;
}

$valorTotal = $valor + $entrega;

$complementos = $_POST['complemento'] ?? [];
if (!is_array($complementos)) {
    $complementos = [$complementos];
}
$complementoss = implode(", ", $complementos);

// ========== SISTEMA DE MULTINÍVEL ==========

// Percentuais por nível
$percentuais = [
    1 => 0.01, 
    2 => 0.005, 
    3 => 0.003, 
    4 => 0.002, 
    5 => 0.001, 
    6 => 0.0005, 
    7 => 0.00025 
];

// 1. Buscar o ID do comprador pelo celular
$sql_busca = "SELECT id FROM usuario WHERE celular = '$celular'";
$result_busca = $conexao->query($sql_busca);

if ($result_busca && $result_busca->num_rows > 0) {
    $comprador = $result_busca->fetch_assoc();
    $comprador_id = $comprador['id'];
    
    // 2. Inserir o pedido
    $sql = "INSERT INTO pedidos (nome, tamanho, adicional, complemento, celular, valor, endereco, numero, bairro, obs) 
            VALUES ('$nome','$tamanho', '$adicional', '$complementoss', '$celular', $valorTotal, '$endereco', '$numero', '$bairro', '$obs')";
    
    if ($conexao->query($sql) === TRUE) {
        $pedido_id = $conexao->insert_id;
        
        // 3. PROCESSAR COMISSÕES MULTINÍVEL
        $nivel = 1;
        $usuario_atual = $comprador_id;
        
        while ($nivel <= 7) {
            
            // Busca quem indicou o usuário atual
            $sql_indicador = "SELECT indicado_por_id FROM usuario WHERE id = $usuario_atual";
            $result_indicador = $conexao->query($sql_indicador);
            
            if ($result_indicador->num_rows == 0) {
                break;
            }
            
            $row = $result_indicador->fetch_assoc();
            $indicador_id = $row['indicado_por_id'];
            
            // Se não tem indicador, para aqui
            if (!$indicador_id) {
                break;
            }
            
            // Calcula comissão para este nível
            $comissao = $valorTotal * $percentuais[$nivel];
            
            // CORREÇÃO: Inserir na comissoes com o pedido_id (já que removemos a FK)
            $sql_comissao = "INSERT INTO comissoes (usuario_id, transacao_id, nivel, valor, data) 
                             VALUES ($indicador_id, $pedido_id, $nivel, $comissao, NOW())";
            
            if ($conexao->query($sql_comissao)) {
                // Atualiza pontos do indicador
                $sql_update = "UPDATE usuario SET pontos = COALESCE(pontos, 0) + $comissao WHERE id = $indicador_id";
                $conexao->query($sql_update);
            }
            
            // Prepara próximo nível
            $usuario_atual = $indicador_id;
            $nivel++;
        }
        
        // Redirecionamento
        header("Location: index.php");
        exit;
        
    } else {
        echo "Erro no pedido: " . $conexao->error;
    }
} else {
    echo "Usuário não encontrado com este celular: $celular";
}

$conexao->close();
?>