<?php
include("../conexion/conexion.php");

// Función para generar un código de barras aleatorio de 11 dígitos
function generarCodigoBarras() {
    return strval(mt_rand(10000000000, 99999999999));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nom_plato'];
    $valor = $_POST['valor'];
    $codigo = generarCodigoBarras();

    $stmt = $conexion->prepare("INSERT INTO platos (nom_plato, valor, codigo_barras) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $nombre, $valor, $codigo);
    $stmt->execute();

    header("Location: index_a.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Añadir Plato</title>
    <link rel="stylesheet" href="mesas.css">
</head>
<body>
    <h2>➕ Añadir Nuevo Plato</h2>
    <form action="agregar_plato.php" method="POST" class="form-agregar">
        <label>Nombre del Plato:</label><br>
        <input type="text" name="nom_plato" required><br><br>

        <label>Valor ($):</label><br>
        <input type="number" name="valor" min="0" required><br><br>

        <button type="submit">Guardar 🍽️</button>
    </form>
    <a href="index_a.php" class="boton-volver">⬅️ Volver</a>
</body>
</html>
