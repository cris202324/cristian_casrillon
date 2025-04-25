<?php
session_start();
include("conexion/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];
    $contraseña = $_POST['contraseña'];

    $sql = "SELECT * FROM usuario WHERE cedula = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if ($contraseña === $usuario['contraseña']) {
            $_SESSION['usuario'] = $usuario;

            if ($usuario['rol'] == 1) {
                header("Location: admin/index_a.php");
                exit;
            } elseif ($usuario['rol'] == 2) {
                header("Location: superadmin/index_s.php");
                exit;
            }
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/login.css"> <!-- Aquí se enlaza el archivo CSS -->
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Inicio de Sesión</h2>
            <form action="login.php" method="POST">
                <div class="textbox">
                    <label for="cedula">Cédula</label>
                    <input type="text" name="cedula" id="cedula" required placeholder="Ingresa tu cédula">
                </div>
                <div class="textbox">
                    <label for="contraseña">Contraseña</label>
                    <input type="password" name="contraseña" id="contraseña" required placeholder="Ingresa tu contraseña">
                </div>
                <button type="submit">Entrar</button>
            </form>
            <div class="error-message">
                <!-- Mensaje de error aquí -->
            </div>
        </div>
    </div>
</body>
</html>
