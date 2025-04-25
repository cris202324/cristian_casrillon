<?php
include("../conexion/conexion.php");
session_start();

$id_empresa = $_SESSION['id_empresa'] ?? 1;

// Obtener tipo de licencia de la empresa
$sql = "SELECT l.id_tipo 
        FROM licencia l
        WHERE l.id_empresa = $id_empresa
        ORDER BY l.tiempo_fin DESC
        LIMIT 1"; // Usamos la licencia más reciente

$resultado = $conexion->query($sql);
$fila = $resultado->fetch_assoc();
$esDemo = $fila['id_tipo'] == 1; // Cambia este valor si el ID demo es otro

// Obtener mesas
$mesas = $conexion->query("SELECT * FROM mesa")->fetch_all(MYSQLI_ASSOC);

// Obtener platos
$platos = $conexion->query("SELECT * FROM platos")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="mesas.css">
    <title>Inicio de Administración</title>
    <script>
        function calcularTotal(select, preciosJSON, totalId) {
            const precios = JSON.parse(preciosJSON);
            let total = 0;
            for (let option of select.selectedOptions) {
                total += parseFloat(precios[option.value] || 0);
            }
            document.getElementById(totalId).innerText = "Total: $" + total.toFixed(2);
        }
    </script>
</head>
<body>
    <h2>🍽️ Inicio de Sesión - Administración de Mesas</h2>

    <?php if (!$esDemo): ?>
        <a href="agregar_plato.php" class="boton-agregar">➕ Añadir Nuevo Plato</a>
    <?php else: ?>
        <button class="boton-agregar" disabled title="Licencia demo: no puedes añadir platos">no puedes  Añadir Nuevo Plato (mejora tu membrecia)</button>
    <?php endif; ?>

    <a href="ver_pedidos.php" class="boton-ver">📋 Ver Pedidos</a>

    <div class="mesas-container">
        <?php foreach ($mesas as $mesa): 
            $precios = [];
            foreach ($platos as $plato) {
                $precios[$plato['id_platos']] = $plato['valor'];
            }
            $preciosJSON = json_encode($precios);
            $totalId = "total_mesa_" . $mesa['id_mesa'];
        ?>
            <div class="mesa-card">
                <h3>Mesa #<?= $mesa['id_mesa'] ?></h3>
                <form action="hacer_pedido.php" method="POST">
                    <input type="hidden" name="id_mesa" value="<?= $mesa['id_mesa'] ?>">

                    <label>Selecciona uno o más platos:</label><br>
                    <select name="id_platos[]" multiple size="4" required onchange="calcularTotal(this, '<?= htmlspecialchars($preciosJSON, ENT_QUOTES) ?>', '<?= $totalId ?>')">
                        <?php foreach ($platos as $plato): ?>
                            <option value="<?= $plato['id_platos'] ?>">
                                <?= $plato['nom_plato'] ?> - $<?= $plato['valor'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <p id="<?= $totalId ?>" class="total">Total: $0.00</p>

                    <button type="submit">Pedir 🍴</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

