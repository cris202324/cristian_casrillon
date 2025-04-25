<?php
// Conexión a la base de datos
include("../conexion/conexion.php");

// Obtener tipos de licencia
$tipo_query = "SELECT * FROM tipo_l";
$tipo_result = $conexion->query($tipo_query);
$tipos = $tipo_result->fetch_all(MYSQLI_ASSOC);

// Obtener empresas
$empresa_query = "SELECT * FROM empresa";
$empresa_result = $conexion->query($empresa_query);
$empresas = $empresa_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Licencia</title>
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
    <h2>📄 Crear Nueva Licencia</h2>
    <form method="POST" action="guardar_licencia.php">
        <label>Tipo de Licencia:</label>
        <select name="id_tipo" required>
            <option value="">Seleccione un tipo</option>
            <?php foreach ($tipos as $tipo): ?>
                <option value="<?= $tipo['id_tipo'] ?>"><?= $tipo['nom_tipo'] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Fecha de Inicio:</label>
        <input type="date" name="fecha_inicio" required>

        <label>Fecha de Finalización:</label>
        <input type="date" name="fecha_final" required>

        <label>Empresa:</label>
        <select name="id_empresa" required>
            <option value="">Seleccione una empresa</option>
            <?php foreach ($empresas as $empresa): ?>
                <option value="<?= $empresa['id_empresa'] ?>"><?= $empresa['nom_empresa'] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Estado:</label>
        <select name="estado" required>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>

        <button type="submit">Crear Licencia</button>
    </form>

    <div class="btn-container">
        <a href="index_s.php" class="btn-volver">⬅️ Volver al Inicio</a>
    </div>
</body>
</html>
