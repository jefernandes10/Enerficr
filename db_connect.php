<?php
// Informações da conexão
$servername = "sql307.infinityfree.com"; // Nome ou IP do servidor onde está o MySQL
$username = "if0_37800457"; // Nome de usuário do MySQL
$password = "3RdKwi1x0B9"; // Senha do MySQL
$dbname = "if0_37800457_enerficrdb"; // Nome do banco de dados que você criou

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
