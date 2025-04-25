<?php
include("../conexion/conexion.php");

// Obtener las empresas disponibles para que el superadministrador las asigne
$empresas = $conexion->query("SELECT id_empresa, nom_empresa FROM empresa")->fetch_all(MYSQLI_ASSOC);

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $id_empresa = $_POST['id_empresa'];

    // Validar que todos los campos sean completados
    if (!empty($cedula) && !empty($nombre) && !empty($edad) && !empty($id_empresa)) {
        // Insertar el nuevo usuario administrador en la base de datos
        $sql = "INSERT INTO usuario (cedula, nombre, edad, rol, id_empresa) 
                VALUES ('$cedula', '$nombre', '$edad', 1, '$id_empresa')";
        
        if ($conexion->query($sql) === TRUE) {
            echo "<p>Usuario administrador creado exitosamente.</p>";
        } else {
            echo "<p>Error al crear el usuario: " . $conexion->error . "</p>";
        }
    } else {
        echo "<p>Todos los campos son requeridos.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Super Admin - Crear Administrador</title>
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
    <h3>📝 Crear Nuevo Administrador</h3>

    <form method="POST" action="crear_admin.php">
        <label for="cedula">Cédula:</label>
        <input type="text" id="cedula" name="cedula" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required><br><br>

        <label for="id_empresa">Empresa:</label>
        <select name="id_empresa" id="id_empresa" required>
            <?php foreach ($empresas as $empresa): ?>
                <option value="<?= $empresa['id_empresa'] ?>"><?= $empresa['nom_empresa'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Crear Administrador</button>
        <a href="index_s.php" class="btn">⬅️ Volver al Inicio</a>
    </form>
</body>
</html>
