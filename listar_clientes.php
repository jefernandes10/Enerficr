<?php
// Iniciar a sessão para exibir mensagens de sucesso/erro
session_start();

// Incluir a conexão com o banco de dados
require_once('db_connect.php');

// Consulta SQL para obter todos os clientes
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENERFICR - Portal Administrativo</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="img/Design_sem_nome__4_-removebg-preview.png" type="image/x-icon">
</head>
<body>

    <header>
        <div class="logo">
            <a href="index.html">
            <img src="img/ENERFICR__3_-removebg-preview.png" alt="ENERFICR"></a>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="index.html">Início</a></li>
                <li><a href="clientes.php">Cadastro Clientes</a></li>
                <li><a href="inserir_consumo.php">Consumo</a></li>
                <li><a href="relatorios.html">Relatórios</a></li>
                <li><a href="listar_clientes.php">Clientes</a></li>
            </ul>
        </nav>
    </header>
<body>

    <h1>Clientes Cadastrados</h1>

    <?php
    // Verificar se há uma mensagem de sessão para exibir
    if (isset($_SESSION['message'])) {
        echo "<p class='" . $_SESSION['msg_type'] . "'>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']); // Limpa a mensagem após exibição
        unset($_SESSION['msg_type']); // Limpa o tipo de mensagem
    }
    ?>

    <!-- Tabela para exibir os clientes -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verificar se há clientes cadastrados
            if ($result->num_rows > 0) {
                // Exibir os dados de cada cliente
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['telefone'] . "</td>";
                    echo "<td><a href='editar_cliente.php?id=" . $row['id'] . "'>Editar</a> | <a href='deletar_cliente.php?id=" . $row['id'] . "'>Excluir</a></td>";
                    echo "<td>
                    <a href='gerar_fatura.php?cliente_id=" . $row['id'] . "' class='btn btn-primary'>Gerar Fatura</a>
                </td>"; // Botão de Gerar Fatura
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum cliente encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
