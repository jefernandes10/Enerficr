<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST['cliente'] ?? null;
    $consumo = $_POST['consumo'] ?? null;
    $valor = $_POST['valor'] ?? null;

    if ($cliente_id && $consumo && $valor) {
        $sql = "INSERT INTO consumo (cliente_id, consumo_kwh, valor_fatura) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("idd", $cliente_id, $consumo, $valor);
            if ($stmt->execute()) {
                echo "<p>Consumo inserido com sucesso!</p>";
            } else {
                echo "<p>Erro ao inserir consumo: " . htmlspecialchars($stmt->error) . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p>Erro ao preparar a consulta: " . htmlspecialchars($conn->error) . "</p>";
        }
    } else {
        echo "<p>Todos os campos são obrigatórios!</p>";
    }
} else {
    echo "<p>Método de requisição inválido.</p>";
}
$conn->close();
?>
<a href="inserir_consumo.php">Voltar</a>
