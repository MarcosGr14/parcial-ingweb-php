<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>EL AVIADOR S.A. - Cotización de Fumigación</title>
</head>
<body>
    <h1>EL AVIADOR S.A. - Cotización de Fumigación</h1>
    <p>Complete el siguiente formulario para calcular el precio final de fumigación:</p>

    <form action="p_aviador.php" method="POST">
        <div>
            <label for="id">Identificación (ID):</label>
            <input type="number" id="id" name="id" required>
        </div>
        <br>
        <div>
            <label for="nombre">Nombre del cliente:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <br>
        <div>
            <label for="tipo">Tipo de avión:</label>
            <select id="tipo" name="tipo" required>
                <option value="0">Tipo 0 (B/. 1,000 / ha)</option>
                <option value="1">Tipo 1 (B/. 800 / ha)</option>
                <option value="2">Tipo 2 (B/. 600 / ha)</option>
                <option value="3">Tipo 3 (B/. 400 / ha)</option>
            </select>
        </div>
        <br>
        <div>
            <label for="hectareas">Cantidad de hectáreas:</label>
            <input type="number" id="hectareas" name="hectareas" min="0.01" step="0.01" required>
        </div>
        <br>
        <button type="submit">Calcular Precio</button>
    </form>
</body>
</html>

