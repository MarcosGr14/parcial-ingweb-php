<?php
require_once 'Avion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Cotización - EL AVIADOR S.A.</title>
</head>
<body>
    <h1>EL AVIADOR S.A. - Detalle de Pago</h1>

    <?php
    try {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception("El formulario debe enviarse mediante el método POST.");
        }

        if (!isset($_POST['id'], $_POST['nombre'], $_POST['tipo'], $_POST['hectareas'])) {
            throw new Exception("Todos los campos del formulario son obligatorios.");
        }

        $idStr = trim($_POST['id']);
        $nombre = trim($_POST['nombre']);
        $tipoStr = trim($_POST['tipo']);
        $hectareasStr = trim($_POST['hectareas']);

        if ($idStr === '' || $nombre === '') {
            throw new Exception("La identificación y el nombre no pueden estar vacíos.");
        }

        if (!is_numeric($idStr) || !is_numeric($tipoStr) || !is_numeric($hectareasStr)) {
            throw new Exception("El ID, tipo de avión y cantidad de hectáreas deben ser numéricos.");
        }

        $id = (int)$idStr;
        $tipo = (int)$tipoStr;
        $hectareas = (float)$hectareasStr;

        if (!in_array($tipo, [0, 1, 2, 3], true)) {
            throw new Exception("El tipo de avión debe ser 0, 1, 2 o 3.");
        }

        if ($hectareas <= 0) {
            throw new Exception("La cantidad de hectáreas debe ser mayor a cero.");
        }

        $avion = new Avion($id, $nombre, $tipo, $hectareas);
        $resultado = $avion->precio();

        if (!is_dir(__DIR__ . "/datos")) {
            mkdir(__DIR__ . "/datos", 0777, true);
        }

        $ar = fopen(__DIR__ . "/datos/clientes.txt", "a") or die("No se pudo abrir clientes.txt");

        $lineaRegistro = "ID: " . $avion->getId() . "\n"
                       . "Nombre: " . $avion->getNombre() . "\n"
                       . "Tipo de avión: " . $avion->getTipo() . "\n"
                       . "Hectáreas: " . number_format($avion->getHectareas(), 2) . "\n"
                       . "Descuento: B/." . number_format($resultado['descuento'], 2) . "\n"
                       . "Precio Final: B/." . number_format($resultado['precioFinal'], 2) . "\n"
                       . "----------------------------------------\n";

        fputs($ar, $lineaRegistro);
        fclose($ar);

        echo "<h2>Información del Servicio</h2>";
        echo "<p><strong>Cliente:</strong> " . htmlspecialchars($avion->getNombre(), ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p><strong>Hectáreas a fumigar:</strong> " . htmlspecialchars(number_format($avion->getHectareas(), 2), ENT_QUOTES, 'UTF-8') . " ha</p>";
        echo "<p><strong>Tipo de avión:</strong> Tipo " . htmlspecialchars((string)$avion->getTipo(), ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p><strong>Descuento (" . htmlspecialchars((string)$resultado['porcentajeDescuento'], ENT_QUOTES, 'UTF-8') . "%):</strong> B/." . htmlspecialchars(number_format($resultado['descuento'], 2), ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p><strong>Precio a pagar:</strong> B/." . htmlspecialchars(number_format($resultado['precioFinal'], 2), ENT_QUOTES, 'UTF-8') . "</p>";

    } catch (Exception $e) {
        echo "<p style='color: red;'><strong>Error:</strong> " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</p>";
    }
    ?>

    <p><a href="f_aviador.php">Realizar otra cotización</a></p>
</body>
</html>
