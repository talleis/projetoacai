<?php
session_start();
include_once('./conexao.php');

$nome    = $_POST['nome'] ?? '';
$email   = $_POST['email'] ?? '';
$celular = $_POST['celular'] ?? '';
$senha   = $_POST['senha'] ?? '';
$codigo_indicador = $_POST['codigo_indicador'] ?? '';

function gerarCodigoReferral($nome, $id) {
    $prefixo = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $nome), 0, 3));
    $prefixo = str_pad($prefixo, 3, 'X');
    return $prefixo . $id . rand(100, 999);
}

// Verifica se celular já existe
$sql = "SELECT * FROM usuario WHERE celular = '$celular'";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    echo "Celular já cadastrado!";
    echo "<br><a href='javascript:history.back()'>Voltar</a>";
    exit;
}

// Insere o usuário (agora com token_login)
$sql = "INSERT INTO usuario (nome, email, celular, senha, token_login, pontos) 
        VALUES ('$nome', '$email', '$celular', '$senha', NULL, 0)";

if ($conexao->query($sql) === TRUE) {
    
    $novo_id_usuario = $conexao->insert_id;
    $codigo_referral = gerarCodigoReferral($nome, $novo_id_usuario);
    
    // Verifica se veio código de indicação
    $indicado_por_id = 'NULL';
    if (!empty($codigo_indicador)) {
        $sql_busca = "SELECT id FROM usuario WHERE codigo_referral = '$codigo_indicador'";
        $result_busca = $conexao->query($sql_busca);
        if ($result_busca && $result_busca->num_rows > 0) {
            $row = $result_busca->fetch_assoc();
            $indicado_por_id = $row['id'];
        }
    }
    
    // Atualiza com código referral e indicação
    $sql_update = "UPDATE usuario 
                   SET codigo_referral = '$codigo_referral', 
                       indicado_por_id = $indicado_por_id 
                   WHERE id = $novo_id_usuario";
    $conexao->query($sql_update);
    
    $_SESSION['celular'] = $celular;
    header("Location: home.php");
    exit;
} else {
    echo "Erro ao cadastrar: " . $conexao->error;
    echo "<br><a href='javascript:history.back()'>Voltar</a>";
}

$conexao->close();
?>