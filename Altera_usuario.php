<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>
<body>
<h2>Editar Usuário</h2>
<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    if ($user) {
        ?>
        <form action="edit.php?id=<?= $id ?>" method="post">
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome_completo" value="<?= $user['nome_completo'] ?>" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required><br><br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha"><br><br>
            <button type="submit">Salvar</button>
        </form>
        <?php
    } else {
        echo "Usuário não encontrado.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $nome_completo = $_POST['nome_completo'];
    $email = $_POST['email'];
    $senha = !empty($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_BCRYPT) : null;

    try {
        if ($senha) {
            $sql = "UPDATE users SET nome_completo = ?, email = ?, senha = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome_completo, $email, $senha, $id]);
        } else {
            $sql = "UPDATE users SET nome_completo = ?, email = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome_completo, $email, $id]);
        }
        echo "Usuário atualizado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao atualizar usuário: " . $e->getMessage();
    }
}
?>
</body>
</html>