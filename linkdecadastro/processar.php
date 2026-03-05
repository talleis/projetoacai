<?php
session_start();
include_once('./conexao.php');

// Percentuais por nível (você define)
$percentuais = [
    1 => 0.10, // 10% - indicação direta
    2 => 0.05, // 5%  - neto
    3 => 0.03, // 3%  - bisneto
    4 => 0.02, // 2%  - 4º nível
    5 => 0.01, // 1%  - 5º nível
    6 => 0.005, // 0.5% - 6º nível
    7 => 0.0025 // 0.25% - 7º nível
];

// Dados da compra (isso viria do seu sistema de compras)
$usuario_comprador_id = $_POST['usuario_id'] ?? 0; // Quem comprou
$valor_compra = $_POST['valor'] ?? 0; // Valor da compra
$descricao = $_POST['descricao'] ?? 'Compra no app';

if ($usuario_comprador_id <= 0 || $valor_compra <= 0) {
    die("Dados inválidos");
}

// 1. Registrar a transação
$sql_transacao = "INSERT INTO transacoes (usuario_id, valor, descricao) 
                  VALUES (?, ?, ?)";
$stmt = $conexao->prepare($sql_transacao);
$stmt->bind_param("ids", $usuario_comprador_id, $valor_compra, $descricao);
$stmt->execute();
$transacao_id = $conexao->insert_id;

// 2. Processar comissões em até 7 níveis
$nivel = 1;
$usuario_atual = $usuario_comprador_id;

while ($nivel <= 7) {
    
    // Busca quem indicou o usuário atual
    $sql = "SELECT indicado_por_id FROM usuario WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $usuario_atual);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        break;
    }
    
    $row = $result->fetch_assoc();
    $indicador_id = $row['indicado_por_id'];
    
    // Se não tem indicador, para aqui
    if (!$indicador_id) {
        break;
    }
    
    // Calcula comissão para este nível
    $comissao = $valor_compra * $percentuais[$nivel];
    
    // Registra a comissão
    $sql_comissao = "INSERT INTO comissoes (usuario_id, transacao_id, nivel, valor) 
                     VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql_comissao);
    $stmt->bind_param("iiid", $indicador_id, $transacao_id, $nivel, $comissao);
    $stmt->execute();
    
    // Atualiza pontos totais do indicador
    $sql_update = "UPDATE usuario SET pontos = pontos + ? WHERE id = ?";
    $stmt = $conexao->prepare($sql_update);
    $stmt->bind_param("di", $comissao, $indicador_id);
    $stmt->execute();
    
    // Prepara próximo nível
    $usuario_atual = $indicador_id;
    $nivel++;
}

echo "Compras processadas com sucesso!";
echo "<br><a href='meulink.php'>Ver meus ganhos</a>";
?>