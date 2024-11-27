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
                <li><a href="fatura.php">Faturas</a></li>
                <li><a href="relatorios.html">Relatórios</a></li>
                <li><a href="listar_clientes.php">Clientes</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Seção de Faturas -->
        <section id="faturas">
            <h1>Gerar Faturas</h1>
            <form id="faturaForm">
                <label for="cliente">Cliente:</label>
                <select id="cliente" name="cliente" required>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>" 
                                . htmlspecialchars($row['nome'], ENT_QUOTES, 'UTF-8') 
                                . "</option>";
                        }
                    } else {
                        echo "<option value=''>Nenhum cliente encontrado</option>";
                    }
                    ?>

                    <option value="">Selecione o cliente</option>
                    <!-- Opções de clientes dinamicamente carregadas -->
                </select>
                <label for="consumo">Consumo (kWh):</label>
                <input type="number" id="consumo" name="consumo" placeholder="Consumo em kWh" required>
                <label for="valor">Valor Total (R$):</label>
                <input type="number" id="valor" name="valor" placeholder="Valor da Fatura" required>
                <button type="submit">Gerar Fatura</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 ENERFICR - Todos os Direitos Reservados</p>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>
