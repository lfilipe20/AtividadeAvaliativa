<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
</head>
<body>
<h2>Lista de Usuários</h2>
<a href="create.php">Cadastrar Novo Usuário</a><br><br>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome Completo</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>
    <?php
    require 'db.php';

    $sql = "SELECT * FROM users";
    $stmt = $pdo->query($sql);
    while ($row = $stmt->fetch()) {
        echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome_completo']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a>
                        <a href='delete.php?id={$row['id']}'>Excluir</a>
                    </td>
                  </tr>";
    }
    ?>
</table>
</body>
</html>