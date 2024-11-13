
<?php
require_once 'db_connect.php';

// Cadastro de novos clientes

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];

    $stmt = $conn->prepare("INSERT INTO clientes (nome, email, endereco, telefone) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $endereco, $telefone]);

    echo "Cliente cadastrado com sucesso!";
}
?>
