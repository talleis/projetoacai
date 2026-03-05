<?php
session_start();
include_once('./conexao.php');

if (!isset($_SESSION['celular'])) {
    header("Location: index.php");
    exit;
}

$celular = $_SESSION['celular'];

// Busca dados do usuário
$sql_user = "SELECT id, nome, pontos FROM usuario WHERE celular = '$celular'";
$result_user = $conexao->query($sql_user);
$user = $result_user->fetch_assoc();

// Busca comissões do usuário
$sql_comissoes = "SELECT c.*, p.nome as produto, p.valor as valor_pedido 
                  FROM comissoes c
                  JOIN pedidos p ON c.transacao_id = p.id
                  WHERE c.usuario_id = " . $user['id'] . "
                  ORDER BY c.data DESC";
$result_comissoes = $conexao->query($sql_comissoes);

// Total por nível
$sql_total_nivel = "SELECT nivel, SUM(valor) as total, COUNT(*) as qtd 
                    FROM comissoes 
                    WHERE usuario_id = " . $user['id'] . "
                    GROUP BY nivel";
$result_niveis = $conexao->query($sql_total_nivel);
$totais_nivel = [];
while ($row = $result_niveis->fetch_assoc()) {
    $totais_nivel[$row['nivel']] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Minhas Comissões</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; }
        .container { max-width: 800px; margin: 20px auto; background: white; padding: 20px; border-radius: 10px; }
        .header { background: #4CAF50; color: white; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .nivel-card { background: #f9f9f9; padding: 15px; margin: 10px 0; border-radius: 5px; border-left: 5px solid #4CAF50; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #4CAF50; color: white; padding: 10px; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        .total { font-size: 24px; color: #4CAF50; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Olá, <?php echo $user['nome']; ?></h1>
            <h2>💰 Saldo total: R$ <?php echo number_format($user['pontos'], 2, ',', '.'); ?></h2>
        </div>

        <h2>Comissões por Nível</h2>
        <?php for ($i = 1; $i <= 7; $i++): 
            $total = $totais_nivel[$i]['total'] ?? 0;
            $qtd = $totais_nivel[$i]['qtd'] ?? 0;
        ?>
        <div class="nivel-card">
            <strong>Nível <?php echo $i; ?>:</strong>
            R$ <?php echo number_format($total, 2, ',', '.'); ?> 
            (<?php echo $qtd; ?> comissões)
        </div>
        <?php endfor; ?>

        <h2>Histórico de Comissões</h2>
        <?php if ($result_comissoes->num_rows > 0): ?>
        <table>
            <tr>
                <th>Data</th>
                <th>Nível</th>
                <th>Valor</th>
                <th>Produto</th>
                <th>Valor do Pedido</th>
            </tr>
            <?php while ($com = $result_comissoes->fetch_assoc()): ?>
            <tr>
                <td><?php echo date('d/m/Y H:i', strtotime($com['data'])); ?></td>
                <td><?php echo $com['nivel']; ?>º</td>
                <td style="color: #4CAF50; font-weight: bold;">R$ <?php echo number_format($com['valor'], 2, ',', '.'); ?></td>
                <td><?php echo $com['produto']; ?></td>
                <td>R$ <?php echo number_format($com['valor_pedido'], 2, ',', '.'); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php else: ?>
        <p style="text-align: center; padding: 20px;">Você ainda não tem comissões.</p>
        <?php endif; ?>
        
        <p style="margin-top: 20px;">
            <a href="home.php">Voltar para Home</a> | 
            <a href="meulink.php">Ver Link de Indicação</a>
        </p>
    </div>
</body>
</html>