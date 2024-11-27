<?php
session_start();
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

    <?php
    // Verifica se há uma mensagem na sessão e a exibe
    if (isset($_SESSION['message'])) {
        // Exibe a mensagem
        echo "<p class='" . $_SESSION['msg_type'] . "'>" . $_SESSION['message'] . "</p>";
        
        // Limpa a mensagem da sessão após exibição
        unset($_SESSION['message']);
        unset($_SESSION['msg_type']);
    }
    ?>

    <main>

        <?php if (!empty($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <?php if (isset($_GET['success'])) { echo "<p style='color: green;'>Cadastro realizado com sucesso!</p>"; } ?>
        
        <!-- Seção de Clientes -->
        <section id="clientes">
            <h1>Gerenciamento de Clientes</h1>

        <form action="cadastrar_clientes.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
    
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
    
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone">
    
            <!--<label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco">-->
    
            <button type="submit">Cadastrar Cliente</button>
        </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 ENERFICR - Todos os Direitos Reservados</p>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>
