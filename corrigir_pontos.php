<?php
include_once('./conexao.php');

echo "<h2>🔧 Corrigindo Pontos dos Usuários</h2>";

// 1. Primeiro, garante que a coluna aceita 0 como padrão
$conexao->query("ALTER TABLE usuario MODIFY COLUMN pontos DECIMAL(10,2) NOT NULL DEFAULT 0");

// 2. Atualiza todos os NULL para 0
$conexao->query("UPDATE usuario SET pontos = 0 WHERE pontos IS NULL");
echo "✅ Usuários com NULL corrigidos para 0<br>";

// 3. Recalcula todos os pontos baseado nas comissões
$sql_usuarios = "SELECT id, nome FROM usuario";
$result = $conexao->query($sql_usuarios);

while ($user = $result->fetch_assoc()) {
    $id = $user['id'];
    
    // Calcula total de comissões
    $sql_com = "SELECT COALESCE(SUM(valor), 0) as total FROM comissoes WHERE usuario_id = $id";
    $res_com = $conexao->query($sql_com);
    $total = $res_com->fetch_assoc()['total'];
    
    // Atualiza os pontos
    $update = "UPDATE usuario SET pontos = $total WHERE id = $id";
    if ($conexao->query($update)) {
        echo "✅ {$user['nome']} - Pontos atualizados: R$ " . number_format($total, 2, ',', '.') . "<br>";
    }
}

echo "<br><br>";
echo "<a href='ver_minhas_comissoes.php' style='padding: 10px 20px; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px;'>Ver Minhas Comissões</a>";
?>