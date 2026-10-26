<?php
// Conexión con la base de datos
include 'db.php';

// Inicializar variable para evitar advertencias si no llega POST
$producto = null;

// Obtener datos del producto
if (isset($_POST['cod'])) {
    try {
        $codigoProducto = $_POST['cod'];  //Guarda en la variable lo que se ha enviado
        $stmt = $pdo->prepare("SELECT * FROM producto WHERE cod = ?");  //prepara la consulta para ejecutarla de forma segura con parámetros.
        $stmt->bindParam(1, $codigoProducto); //Asocia la variable al primer ? 
        $stmt->execute(); 
        $producto = $stmt->fetch(PDO::FETCH_ASSOC); //Coge la primera linea y lo guarda en producto
    } catch (PDOException $e) {
        echo "<p>Error en la consulta del producto: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar</title>
</head>

<body>
    <h1>Edición de un producto</h1>

    <?php if ($producto): ?>
        <form method="post" action="actualizar.php">
            <input type="hidden" name="cod" value="<?=($producto['cod']) ?>">

            <label for="nombre_corto">Nombre corto:</label>
            <input type="text" id="nombre_corto" name="nombre_corto" value="<?=($producto['nombre_corto']) ?>" required><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?=($producto['nombre']) ?>" required><br>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?=($producto['descripcion']) ?></textarea><br>

            <label for="PVP">PVP:</label>
            <input type="number" step="0.01" id="PVP" name="PVP" value="<?=($producto['PVP']) ?>" required><br>

            <button type="submit" name="accion" value="actualizar">Actualizar</button>
            <button type="submit" name="accion" value="cancelar" formnovalidate>Cancelar</button>
        </form>
    <?php else: ?>
        <p>Producto no encontrado.</p>
    <?php endif; ?>
</body>

</html>