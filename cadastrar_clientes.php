<?php
// Iniciar a sessão para usar variáveis de sessão
session_start();

// Incluindo a conexão com o banco de dados
require_once('db_connect.php');

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta e sanitiza os dados
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    // Prepara a query para inserir os dados no banco
    $sql = "INSERT INTO clientes (nome, email, telefone) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $telefone);

    // Executa a query e redireciona se bem-sucedido
    if ($stmt->execute()) {
        // Definir mensagem de sucesso na sessão
        $_SESSION['message'] = "Cadastro realizado com sucesso!";
        $_SESSION['msg_type'] = "success"; // Mensagem de sucesso
    } else {
        // Definir mensagem de erro na sessão
        $_SESSION['message'] = "Erro ao cadastrar cliente. Tente novamente!";
        $_SESSION['msg_type'] = "error"; // Mensagem de erro
    }

    // Redireciona para a página de cadastro com o formulário limpo
    header("Location: clientes.php");
    exit();
}
?>
