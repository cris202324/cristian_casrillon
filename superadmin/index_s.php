<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 50px;
        }
        h1 {
            color: #333;
        }
        .botones {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 30px;
        }
        .botones a {
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .botones a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Panel de Administración</h1>
    <div class="botones">
        <a href="crear_licencia.php">Crear Licencia</a>
        <a href="crear_empresa.php">Crear Empresa</a>
        <a href="crear_tipli.php">Crear tipo de Licencia</a>
        <a href="crear_admin.php">Crear Administrador</a>
        <a href="ver_empresa.php">Ver Empresas</a>
        <a href="ver_usuarios.php">Ver Administradores</a>
        <a href="../login.php">Cerrar Sesión</a>
    </div>
</body>
</html>
