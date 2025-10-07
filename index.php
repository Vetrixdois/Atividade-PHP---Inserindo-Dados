<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #e9ecef;
        }
        .actions {
            text-align: center;
        }
        .no-data {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistema de Gerenciamento de Usuários</h1>
        
        <a href="form.php" class="btn">+ Cadastrar Novo Usuário</a>
        
        <?php
        require "banco.php";
        
        try {
            // Buscar todos os usuários
            $sql = "SELECT * FROM usuarios ORDER BY id DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($usuarios) > 0) {
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nome</th>";
                echo "<th>E-mail</th>";
                echo "<th>Ações</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($usuario['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['email']) . "</td>";
                    echo "<td class='actions'>";
                    echo "<a href='edit.php?id=" . $usuario['id'] . "' class='btn btn-warning' style='margin-right: 5px;'>Editar</a>";
                    echo "<a href='delete.php?id=" . $usuario['id'] . "' class='btn btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir este usuário?\")'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<div class='no-data'>";
                echo "<p>Nenhum usuário cadastrado ainda.</p>";
                echo "<p>Clique no botão acima para cadastrar o primeiro usuário!</p>";
                echo "</div>";
            }
            
        } catch(PDOException $e) {
            echo "<p style='color:red;'>Erro ao buscar usuários: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>
</body>
</html>