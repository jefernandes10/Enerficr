<?php

require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $consumo = $_POST['consumo'];
    $valor = $consumo * 0.5; // Cálculo do valor da fatura (exemplo)

    $stmt = $conn->prepare("INSERT INTO faturas (cliente_id, consumo, valor, data_fatura) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$cliente_id, $consumo, $valor]);

    echo "Fatura gerada com sucesso!";
}
?>