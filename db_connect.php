<?php
// Informações da conexão
$servername = "localhost"; // Nome ou IP do servidor onde está o MySQL
$username = "root"; // Nome de usuário do MySQL
$password = "root"; // Senha do MySQL
$dbname = "enerficrdb"; // Nome do banco de dados que você criou

// Criar a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se a conexão falhou
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Definir charset para evitar problemas com caracteres especiais
$conn->set_charset("utf8");

// A conexão foi bem-sucedida
?>
