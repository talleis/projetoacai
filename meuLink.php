<?php
session_start();
include_once('./conexao.php');

// Verifica se usuário está logado
if (!isset($_SESSION['celular'])) {
    header("Location: index.php");
    exit;
}

$celular = $_SESSION['celular'];

// Busca dados do usuário
$sql = "SELECT id, nome, codigo_referral FROM usuario WHERE celular = '$celular'";
$result = $conexao->query($sql);

if ($result->num_rows == 0) {
    echo "Usuário não encontrado!";
    exit;
}

$usuario = $result->fetch_assoc();

// Se não tiver código (para usuários antigos), gera um
if (empty($usuario['codigo_referral'])) {
    $prefixo = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $usuario['nome']), 0, 3));
    $prefixo = str_pad($prefixo, 3, 'X');
    $novo_codigo = $prefixo . $usuario['id'] . rand(100, 999);
    
    $update = "UPDATE usuario SET codigo_referral = '$novo_codigo' WHERE id = " . $usuario['id'];
    $conexao->query($update);
    $usuario['codigo_referral'] = $novo_codigo;
}

// Gera o link completo
$link_indicacao = "http://" . $_SERVER['HTTP_HOST'] . "/projetoacai/index.php?ref=" . $usuario['codigo_referral'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Link de Indicação</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>
        .container-link {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .link-box {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border: 2px dashed #4CAF50;
        }
        
        .link-text {
            font-size: 18px;
            color: #4CAF50;
            word-break: break-all;
            font-weight: bold;
        }
        
        .btn-copiar {
            background: #4CAF50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin: 10px 0;
        }
        
        .btn-copiar:hover {
            background: #45a049;
        }
        
        .info {
            margin-top: 20px;
            padding: 15px;
            background: #e8f5e9;
            border-radius: 5px;
            color: #2e7d32;
        }
        
        .btn-voltar {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        
        .btn-voltar:hover {
            background: #da190b;
        }
        
        .estatisticas {
            margin-top: 30px;
            text-align: left;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        
        .nivel {
            margin: 10px 0;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container-link">
        <h1>Olá, <?php echo htmlspecialchars($usuario['nome']); ?>!</h1>
        <h2>🌟 Seu Link de Indicação 🌟</h2>
        
        <div class="link-box">
            <p class="link-text" id="link"><?php echo $link_indicacao; ?></p>
        </div>
        
        <button class="btn-copiar" onclick="copiarLink()">📋 Copiar Link</button>
        
        <div class="info">
            <p>Compartilhe esse link com seus amigos!<br>
            Quando eles se cadastrarem e fizerem compras, você ganha comissões!</p>
        </div>
        
        <div class="estatisticas">
    <h3>📊 Sua Rede e Ganhos</h3>
    
    <?php
    // Busca estatísticas completas da rede até 7 níveis
    $stats = [];
    for ($i = 1; $i <= 7; $i++) {
        $stats[$i] = 0;
    }
    
    // Função recursiva para contar níveis (simplificada)
    function contarNivel($conexao, $usuario_id, $nivel_atual, &$stats) {
        if ($nivel_atual > 7) return;
        
        $sql = "SELECT id FROM usuario WHERE indicado_por_id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $stats[$nivel_atual]++;
            contarNivel($conexao, $row['id'], $nivel_atual + 1, $stats);
        }
    }
    
    contarNivel($conexao, $usuario['id'], 1, $stats);
    
    // Busca comissões por nível
    $comissoes_nivel = [];
    $sql_com = "SELECT nivel, SUM(valor) as total 
                FROM comissoes 
                WHERE usuario_id = ? 
                GROUP BY nivel";
    $stmt = $conexao->prepare($sql_com);
    $stmt->bind_param("i", $usuario['id']);
    $stmt->execute();
    $result_com = $stmt->get_result();
    
    while ($row = $result_com->fetch_assoc()) {
        $comissoes_nivel[$row['nivel']] = $row['total'];
    }
    
    // Total geral
    $sql_total = "SELECT SUM(valor) as total FROM comissoes WHERE usuario_id = ?";
    $stmt = $conexao->prepare($sql_total);
    $stmt->bind_param("i", $usuario['id']);
    $stmt->execute();
    $total_geral = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
    ?>
    
    <table style="width:100%; border-collapse: collapse; margin: 10px 0;">
        <tr style="background: #4CAF50; color: white;">
            <th style="padding: 8px;">Nível</th>
            <th style="padding: 8px;">Pessoas</th>
            <th style="padding: 8px;">Ganhos</th>
        </tr>
        <?php for ($i = 1; $i <= 7; $i++): ?>
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 8px;">Nível <?php echo $i; ?></td>
            <td style="padding: 8px;"><?php echo $stats[$i] ?? 0; ?> pessoas</td>
            <td style="padding: 8px; color: #4CAF50; font-weight: bold;">
                R$ <?php echo number_format($comissoes_nivel[$i] ?? 0, 2, ',', '.'); ?>
            </td>
        </tr>
        <?php endfor; ?>
        <tr style="background: #e8f5e9; font-weight: bold;">
            <td colspan="2" style="padding: 8px;">TOTAL</td>
            <td style="padding: 8px; color: #4CAF50;">R$ <?php echo number_format($total_geral, 2, ',', '.'); ?></td>
        </tr>
    </table>
</div>