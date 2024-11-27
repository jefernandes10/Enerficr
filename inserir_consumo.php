<?php
require_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENERFICR - Portal Administrativo</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="img/Design_sem_nome__4_-removebg-preview.png" type="image/x-icon">
    <script>
        function calcularValor() {
            const consumo = parseFloat(document.getElementById('consumo').value) || 0;
            const taxa = 0.85; // Define a taxa por kWh
            const valor = consumo * taxa;
            document.getElementById('valor').value = valor.toFixed(2); // Mostra com 2 casas decimais
        }
    </script>
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
    <h1>Inserir Dados de Consumo</h1>
    <form action="processa_consumo.php" method="POST">
        <label for="cliente">Cliente:</label>
        <select id="cliente" name="cliente" required>
            <?php
            // Recuperar clientes do banco de dados
            $sql = "SELECT id, nome FROM clientes";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['id'], ENT_QUOTES) . "'>" 
                        . htmlspecialchars($row['nome'], ENT_QUOTES) . "</option>";
                }
            } else {
                echo "<option value=''>Nenhum cliente encontrado</option>";
            }
            ?>
        </select>

        <label for="data_consumo">Data do Consumo:</label>
        <input type="date" id="data_consumo" name="data_consumo">
        
        <label for="consumo">Consumo (kWh):</label>
        <input type="number" id="consumo" name="consumo" step="0.01" oninput="calcularValor()" required>

        <label for="valor">Valor Total (R$):</label>
        <input type="number" id="valor" name="valor" step="0.01" readonly>

        <button type="submit">Inserir Consumo</button>
    </form>
</body>
</html>
