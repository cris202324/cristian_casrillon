<?php
include("../conexion/conexion.php");

// Actualizar empresa si se envía el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_empresa'])) {
    $id_empresa = $_POST['id_empresa'];
    $id_tipo = $_POST['id_tipo'];
    $id_estado = $_POST['id_estado'];

    $conexion->query("UPDATE licencia SET id_tipo = '$id_tipo' WHERE id_empresa = '$id_empresa'");
    $conexion->query("UPDATE empresa SET id_estado = '$id_estado' WHERE id_empresa = '$id_empresa'");
}

// Obtener empresas con tipo de licencia y estado
$empresas = $conexion->query("
    SELECT 
        e.id_empresa, 
        e.nom_empresa, 
        l.id_tipo,
        t.nom_tipo,
        e.id_estado,
        es.tipo_estado
    FROM empresa e
    LEFT JOIN licencia l ON e.id_empresa = l.id_empresa
    LEFT JOIN tipo_l t ON l.id_tipo = t.id_tipo
    LEFT JOIN estado es ON e.id_estado = es.id_estado
")->fetch_all(MYSQLI_ASSOC);

// Obtener tipos de licencia
$tipos = $conexion->query("SELECT * FROM tipo_l")->fetch_all(MYSQLI_ASSOC);

// Obtener estados
$estados = $conexion->query("SELECT * FROM estado")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Empresas Registradas</title>
    <style>
        body { font-family: Arial; padding: 20px; background-color: #f4f6f8; }
        h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #eee; }
        form { margin: 0; }
        select { padding: 5px; }
        .btn { padding: 5px 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #0056b3; }
        .volver { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #28a745; color: white; text-decoration: none; border-radius: 6px; }
        .volver:hover { background: #218838; }
    </style>
</head>
<body>
    <h2>🏢 Empresas Registradas</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre Empresa</th>
                <th>Tipo de Licencia</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empresas as $empresa): ?>
                <tr>
                    <form method="POST">
                        <td><?= $empresa['nom_empresa'] ?></td>
                        <td>
                            <select name="id_tipo">
                                <?php foreach ($tipos as $tipo): ?>
                                    <option value="<?= $tipo['id_tipo'] ?>" <?= $tipo['id_tipo'] == $empresa['id_tipo'] ? 'selected' : '' ?>>
                                        <?= $tipo['nom_tipo'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <select name="id_estado">
                                <?php foreach ($estados as $estado): ?>
                                    <option value="<?= $estado['id_estado'] ?>" <?= $estado['id_estado'] == $empresa['id_estado'] ? 'selected' : '' ?>>
                                        <?= $estado['tipo_estado'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="id_empresa" value="<?= $empresa['id_empresa'] ?>">
                            <button type="submit" class="btn">💾 Guardar</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index_s.php" class="volver">⬅️ Volver al Inicio</a>
</body>
</html>
