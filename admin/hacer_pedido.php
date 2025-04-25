<?php
include("../conexion/conexion.php");

$id_mesa = $_POST['id_mesa'];
$id_platos = $_POST['id_platos']; // array de platos

$total = 0;

// Obtener precios y sumar
foreach ($id_platos as $id_plato) {
    $consulta = $conexion->prepare("SELECT valor FROM platos WHERE id_platos = ?");
    $consulta->bind_param("i", $id_plato);
    $consulta->execute();
    $resultado = $consulta->get_result();
    $fila = $resultado->fetch_assoc();
    $total += $fila['valor'];

    // Guardar pedido individual con total
    $insert = $conexion->prepare("INSERT INTO pedidos (id_mesas, id_platos, total) VALUES (?, ?, ?)");
    $insert->bind_param("iid", $id_mesa, $id_plato, $total);
    $insert->execute();
}

header("Location: index_a.php");
exit;
?>
