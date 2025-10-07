<?php
require "banco.php";

// Verificar se o ID foi fornecido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

try {
    // Verificar se o usuário existe
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$usuario) {
        header("Location: index.php");
        exit;
    }
    
    // Excluir o usuário
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();
    
    echo "<p style='color:green;'>Usuário excluído com sucesso!</p>";
    echo "<a href='index.php' style='text-decoration:none; color:blue;'>← Voltar para a lista</a>";
    
} catch(PDOException $e) {
    echo "<p style='color:red;'>Erro ao excluir usuário: " . $e->getMessage() . "</p>";
    echo "<a href='index.php' style='text-decoration:none; color:blue;'>← Voltar para a lista</a>";
}
?>
