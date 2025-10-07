<?php
// Configurações de conexão com o banco de dados
$host = 'localhost';
$dbname = 'db_aula';
$username = 'root';
$password = '';

try {
    // Criar conexão PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>