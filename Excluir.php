<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        echo "Usuário excluído com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao excluir usuário: " . $e->getMessage();
    }
}
?>
<a href="index.php">Voltar para a lista de usuários</a>