<?php
require "banco.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar os dados de entrada
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    
    // Validar se os campos não estão vazios
    if (empty($nome) || empty($email)) {
        echo "<p style='color:red;'>Por favor, preencha todos os campos!</p>";
        exit;
    }
    
    // Validar formato do email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>Por favor, insira um email válido!</p>";
        exit;
    }
    
    try {
        // Preparar a query SQL
        $sql = "INSERT INTO usuarios (nome, email) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        
        // Bind dos parâmetros
        $stmt->bindValue(1, $nome);
        $stmt->bindValue(2, $email);
        
        // Executar a query
        $stmt->execute();
        
        echo "<p style='color:green;'>Usuário cadastrado com sucesso!</p>";
        echo "<a href='index.php' style='text-decoration:none; color:blue;'>← Voltar para a lista</a>";
        
    } catch(PDOException $e) {
        echo "<p style='color:red;'>Erro ao cadastrar: " . $e->getMessage() . "</p>";
    }
}
?>