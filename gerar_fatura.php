<?php
// db_connect.php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "enerficrdb";

// Criar conexão
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Checar a conexão
if ($mysqli->connect_error) {
    die("Conexão falhou: " . $mysqli->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar se o campo 'periodo' foi enviado e não está vazio
    if (isset($_POST['periodo']) && !empty($_POST['periodo'])) {
        // Receber os dados do formulário
        $cliente_id = $_POST['cliente_id'];
        $consumo = $_POST['consumo'];
        $valor = $_POST['valor'];
        $data_fatura = $_POST['data_fatura'];
        $periodo = $_POST['periodo']; // Recebe o valor do campo 'periodo'

        // Verificar se os dados do cliente são válidos
        if (!empty($cliente_id) && !empty($consumo) && !empty($valor)) {
            // Preparar a query para inserção
            $query = "INSERT INTO faturas (cliente_id, consumo, valor, data_fatura, periodo) VALUES (?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query);

            if ($stmt) {
                // Associar os parâmetros
                $stmt->bind_param("iddss", $cliente_id, $consumo, $valor, $data_fatura, $periodo);

                // Executar a consulta
                if ($stmt->execute()) {
                    echo "Fatura gerada com sucesso!";
                    // Redirecionar ou limpar o formulário após sucesso, se necessário
                    header("Location: gerar_fatura.php"); // Redireciona de volta para a mesma página
                    exit;
                } else {
                    echo "Erro ao gerar a fatura.";
                }

                // Fechar a declaração
                $stmt->close();
            } else {
                echo "Erro ao preparar a consulta.";
            }
        } else {
            echo "Preencha todos os campos corretamente!";
        }
    } else {
        echo "O campo 'Período' não pode estar vazio!";
    }
}

// Fechar a conexão
$mysqli->close();


// Consultar os clientes do banco de dados
$sql = "SELECT id, nome FROM clientes";
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
    <!-- Mostrar mensagem de sucesso ou erro -->
    <?php if (isset($msg_sucesso)) { echo "<p style='color: green;'>$msg_sucesso</p>"; } ?>
    <?php if (isset($msg_erro)) { echo "<p style='color: red;'>$msg_erro</p>"; } ?>

    <form id="faturaForm" method="POST">
        <label for="cliente">Escolha o Cliente:</label>
        <select id="cliente" name="cliente" required>
            <option value="">Selecione o cliente</option>
            <?php
            // Exibir a lista de clientes
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['nome'], ENT_QUOTES, 'UTF-8') . "</option>";
                }
            } else {
                echo "<option value=''>Nenhum cliente encontrado</option>";
            }
            ?>
        </select>
        
        <label for="consumo">Consumo (kWh):</label>
        <input type="number" name="consumo" required>

        <label for="valor">Valor Total (R$):</label>
        <input type="number" name="valor" required>

        <label for="data_fatura">Data da Fatura:</label>
        <input type="date" name="data_fatura" required>

        <!-- Campo para o período -->
        <label for="periodo">Período (Mês/Ano):</label>
        <input type="text" name="periodo" id="periodo" required placeholder="MM/YYYY">

        <button type="submit">Gerar Fatura</button>
    </form>
</body>
</html>

<?php
// Fechar a conexão com o banco
$conn->close();
?>
