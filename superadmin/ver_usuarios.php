<?php
include("../conexion/conexion.php");

// Obtener usuarios administradores junto con el nombre de la empresa
$adminUsers = $conexion->query("
    SELECT usuario.cedula, usuario.nombre, usuario.edad, empresa.nom_empresa 
    FROM usuario 
    JOIN empresa ON usuario.id_empresa = empresa.id_empresa 
    WHERE usuario.rol = 1
")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Super Admin - Lista de Administradores</title>
    <link rel="stylesheet" href="mesas.css">
    <style>
        body { font-family: Arial; background-color: #f0f2f5; padding: 20px; }
        h2 { text-align: center; color: #333; }
        table { width: 70%; margin: auto; border-collapse: collapse; background-color: #fff; }
        th, td { padding: 10px; text-align: center; border: 1px solid #ccc; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .btn-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            text-align: center;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>🔐 Panel de Super Administrador</h2>
    <h3>👥 Usuarios con Rol de Administrador</h3>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Empresa</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($adminUsers as $admin): ?>
                <tr>
                    <td><?= $admin['cedula'] ?></td>
                    <td><?= $admin['nombre'] ?></td>
                    <td><?= $admin['edad'] ?></td>
                    <td><?= $admin['nom_empresa'] ?></td>
                    <td>
                        <a href="eliminar_admin.php?id=<?= $admin['cedula'] ?>" onclick="return confirm('¿Estás seguro de eliminar este administrador?')">🗑️ Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div>
    <a href="index_s.php" class="btn">⬅️ Volver al Inicio</a>
    </div>
</body>
</html>

