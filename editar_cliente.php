<?php
// Iniciar a sessão
session_start();

// Incluir a conexão com o banco de dados
require_once('db_connect.php');

// Verificar se o ID do cliente foi passado pela URL
if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    // Consulta SQL para obter os dados do cliente
    $sql = "SELECT * FROM clientes WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id_cliente);
        $stmt->execute();
        $result = $stmt->get_result();
        $cliente = $result->fetch_assoc();

        // Verificar se o cliente foi encontrado
        if (!$cliente) {
            $_SESSION['message'] = "Cliente não encontrado.";
            $_SESSION['msg_type'] = "error";
            header("Location: listar_clientes.php");
            exit;
        }
    }
}

// Processar o envio do formulário para editar o cliente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];

    // Atualizar os dados do cliente
    $sql = "UPDATE clientes SET nome = ?, email = ?, endereco = ? WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssi", $nome, $email, $endereco, $id_cliente);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Cliente atualizado com sucesso!";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "Erro ao atualizar cliente.";
            $_SESSION['msg_type'] = "error";
        }
        $stmt->close();
        header("Location: listar_clientes.php");
        exit;
    }
}
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

    <h1>Editar Cliente</h1>

    <?php
    if (isset($_SESSION['message'])) {
        echo "<p class='" . $_SESSION['msg_type'] . "'>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']);
        unset($_SESSION['msg_type']);
    }
    ?>

    <!-- Formulário de edição de cliente -->
    <form action="editar_cliente.php?id=<?php echo $cliente['id']; ?>" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($cliente['email']); ?>" required>

        <label for="endereco">Telefone:</label>
        <input type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($cliente['telefone']); ?>" required>

        <button type="submit">Atualizar Cliente</button>
    </form>

</body>
</html>
