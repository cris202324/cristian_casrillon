<?php
$conexion = new mysqli("localhost", "root", "", "mesas");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
