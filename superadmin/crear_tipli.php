<?php
include("../conexion/conexion.php");

// Obtener las empresas disponibles para que el superadministrador las asigne
$empresas = $conexion->query("SELECT id_empresa, nom_empresa FROM empresa")->fetch_all(MYSQLI_ASSOC);

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nom_tipo = $_POST['nom_tipo'];
    $duracion = $_POST['duracion'];
    $valor_monetario = $_POST['valor'];
    $id_empresa = $_POST['id_empresa'];

    // Validar que todos los campos sean completados
    if (!empty($nom_tipo) && !empty($duracion) && !empty($valor_monetario) && !empty($id_empresa)) {
        // Insertar el nuevo tipo de licencia en la base de datos
        $sql = "INSERT INTO tipo_l (nom_tipo, duracion, valor_monetario, id_empresa) 
                VALUES ('$nom_tipo', '$duracion', '$valor_monetario', '$id_empresa')";
        
        if ($conexion->query($sql) === TRUE) {
            echo "<p>Licencia creada exitosamente.</p>";
        } else {
            echo "<p>Error al crear la licencia: " . $conexion->error . "</p>";
        }
    } else {
        echo "<p>Todos los campos son requeridos.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Super Admin - Crear Licencia</title>
    <link rel="stylesheet" href="mesas.css">
    <style>
        body { font-family: Arial; padding: 20px; background-color: #f4f6f8; }
        h2 { color: #333; }
        form { background: #fff; padding: 20px; border-radius: 10px; width: 400px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        button, .btn-volver {
            margin-top: 15px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        button:hover, .btn-volver:hover {
            background: #0056b3;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>🔐 Panel de Super Administrador</h2>
    <h3>📝 Crear Nueva Licencia</h3>

    <form method="POST" action="crear_licencia.php">
        <label for="nom_tipo">Nombre del Tipo de Licencia:</label>
        <input type="text" id="nom_tipo" name="nom_tipo" required><br><br>

        <label for="duracion">Duración (en días):</label>
        <input type="number" id="duracion" name="duracion" required><br><br>

        <label for="valor">Valor Monetario:</label>
        <input type="text" id="valor" name="valor" required><br><br>

        <button type="submit">Crear Licencia</button>
        <a href="index_s.php" class="btn">⬅️ Volver al Inicio</a>
    </form>
</body>
</html>
