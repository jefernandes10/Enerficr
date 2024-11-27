<?php
// Iniciar a sessão
session_start();

// Incluir a conexão com o banco de dados
require_once('db_connect.php');

// Verificar se o ID do cliente foi passado pela URL
if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    // Consulta SQL para excluir o cliente
    $sql = "DELETE FROM clientes WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Vincular o parâmetro e executar a consulta
        $stmt->bind_param("i", $id_cliente);
        if ($stmt->execute()) {
            // Mensagem de sucesso
            $_SESSION['message'] = "Cliente excluído com sucesso!";
            $_SESSION['msg_type'] = "success";
        } else {
            // Mensagem de erro
            $_SESSION['message'] = "Erro ao excluir cliente.";
            $_SESSION['msg_type'] = "error";
        }
        $stmt->close();
    }
} else {
    $_SESSION['message'] = "ID de cliente não encontrado.";
    $_SESSION['msg_type'] = "error";
}

header("Location: listar_clientes.php"); // Redirecionar para a página de listagem
exit;
?>
