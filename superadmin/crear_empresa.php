<?php
include("../conexion/conexion.php");

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nom_empresa = $_POST['nom_empresa'];
    $id_estado = $_POST['id_estado'];

    // Validar que los campos no estén vacíos
    if (!empty($nom_empresa) && !empty($id_estado)) {
        // Insertar la nueva empresa en la base de datos
        $sql = "INSERT INTO empresa (nom_empresa, id_estado) VALUES ('$nom_empresa', '$id_estado')";
        
        if ($conexion->query($sql) === TRUE) {
            echo "<p>Empresa creada exitosamente.</p>";
        } else {
            echo "<p>Error al crear la empresa: " . $conexion->error . "</p>";
        }
    } else {
        echo "<p>Todos los campos son requeridos.</p>";
    }
}

// Obtener los estados disponibles para el formulario
$estado_query = "SELECT * FROM estado";
$estado_result = $conexion->query($estado_query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin - Crear Empresa</title>
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
    <h3>🏢 Crear Nueva Empresa</h3>

    <form method="POST" action="crear_empresa.php">
        <label for="nom_empresa">Nombre de la Empresa:</label>
        <input type="text" id="nom_empresa" name="nom_empresa" required><br><br>

        <label for="id_estado">Estado:</label>
        <select name="id_estado" id="id_estado" required>
            <?php while ($row = $estado_result->fetch_assoc()): ?>
                <option value="<?= $row['id_estado'] ?>"><?= $row['tipo_estado'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <button type="submit">Crear Empresa</button>
        <a href="index_s.php" class="btn">⬅️ Volver al Inicio</a>
    </form>
</body>
</html>

<?php
// Cerrar la conexión
$conexion->close();
?>
