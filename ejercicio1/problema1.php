<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de Admisión - Academia de Policía</title>
</head>
<body>
<?php
function academia($nombre, $edad, $estatura) {
    if ($edad >= 18 && $edad <= 25 && $estatura >= 1.85) {
        return "¡Felicidades, $nombre! Es aceptado en la academia.";
    } else {
        $motivos = [];
        if ($edad < 18 || $edad > 25) {
            $motivos[] = "la edad debe estar entre 18 y 25 años";
        }
        if ($estatura < 1.85) {
            $motivos[] = "la estatura debe ser igual o mayor a 1.85 m";
        }
        $detalle = implode(" y ", $motivos);
        return "Lo sentimos, $nombre. No cumple con los requisitos para ser aceptado ($detalle).";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['nombre']) && isset($_POST['edad']) && isset($_POST['estatura'])) {
        $nombre = htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8');
        $edad = intval($_POST['edad']);
        $estatura = floatval($_POST['estatura']);

        if ($edad > 0 && $estatura > 0) {
            echo "<h2>Resultado de Admisión</h2>";
            echo "Nombre: " . $nombre . "<br>";
            echo "Edad: " . $edad . " años<br>";
            echo "Estatura: " . number_format($estatura, 2) . " m<br><br>";

            $resultado = academia($nombre, $edad, $estatura);
            echo "<strong>" . $resultado . "</strong><br><br>";
        } else {
            echo "<p style='color: red;'>La edad y la estatura deben ser números mayores a cero.</p>";
        }
    } else {
        echo "<p style='color: red;'>Debe completar todos los campos del formulario.</p>";
    }
} else {
    echo "<p>Acceso no permitido.</p>";
}
?>
    <p><a href="problema1.html">Volver al formulario</a></p>
</body>
</html>
