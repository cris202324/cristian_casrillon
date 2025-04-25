<?php
include("../conexion/conexion.php");

$pedidos = $conexion->query("
    SELECT p.id_pedido, m.id_mesa, pl.nom_plato, pl.valor, p.total
    FROM pedidos p
    JOIN mesa m ON m.id_mesa = p.id_mesas
    JOIN platos pl ON pl.id_platos = p.id_platos
    ORDER BY p.id_pedido DESC
")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ver Pedidos</title>
    <link rel="stylesheet" href="mesas.css">
</head>
<body>
    <h2>📋 Pedidos Registrados</h2>
    <table border="1">
        <tr>
            <th>ID Pedido</th>
            <th>Mesa</th>
            <th>Plato</th>
            <th>Valor</th>
            <th>Total</th>
        </tr>
        <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?= $pedido['id_pedido'] ?></td>
                <td><?= $pedido['id_mesa'] ?></td>
                <td><?= $pedido['nom_plato'] ?></td>
                <td>$<?= $pedido['valor'] ?></td>
                <td>$<?= $pedido['total'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="index_a.php" class="boton-volver">volver a inicio</a>
</body>
</html>
