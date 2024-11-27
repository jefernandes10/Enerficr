<?php
require_once 'db_connect.php';

// Verifica se o ID do cliente foi passado
if (isset($_GET['cliente_id'])) {
    $cliente_id = intval($_GET['cliente_id']);

    // Recupera informações do cliente
    $sql_cliente = "SELECT * FROM clientes WHERE id = ?";
    $stmt_cliente = $conn->prepare($sql_cliente);
    $stmt_cliente->bind_param("i", $cliente_id);
    $stmt_cliente->execute();
    $result_cliente = $stmt_cliente->get_result();
    $cliente = $result_cliente->fetch_assoc();

    // Recupera informações de consumo do cliente
    $sql_consumo = "SELECT * FROM consumos WHERE cliente_id = ? ORDER BY data_insercao DESC LIMIT 1";
    $stmt_consumo = $conn->prepare($sql_consumo);
    $stmt_consumo->bind_param("i", $cliente_id);
    $stmt_consumo->execute();
    $result_consumo = $stmt_consumo->get_result();
    $consumo = $result_consumo->fetch_assoc();

    if ($cliente && $consumo) {
        // Dados encontrados, prosseguir com a geração da fatura
        ob_start(); // Inicia buffer de saída
        ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Fatura</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <h1>Fatura de Consumo</h1>
            <h2>Dados do Cliente</h2>
            <p><strong>Nome:</strong> <?= htmlspecialchars($cliente['nome']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($cliente['email']) ?></p>
            <p><strong>Telefone:</strong> <?= htmlspecialchars($cliente['telefone']) ?></p>
            <p><strong>Endereço:</strong> <?= htmlspecialchars($cliente['endereco']) ?></p>

            <h2>Dados de Consumo</h2>
            <p><strong>Consumo (kWh):</strong> <?= htmlspecialchars($consumo['consumo_kwh']) ?></p>
            <p><strong>Valor Total (R$):</strong> <?= htmlspecialchars(number_format($consumo['valor_total'], 2, ',', '.')) ?></p>
            <p><strong>Data:</strong> <?= htmlspecialchars($consumo['data_insercao']) ?></p>
        </body>
        </html>
        <?php
        $html = ob_get_clean();

        // Gerar PDF
        require_once 'fpdf.php';
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->WriteHTML($html);
        $pdf->Output('D', 'Fatura.pdf'); // Baixar diretamente
    } else {
        echo "<p>Cliente ou consumo não encontrado.</p>";
    }
} else {
    echo "<p>ID do cliente não fornecido.</p>";
}
?>
