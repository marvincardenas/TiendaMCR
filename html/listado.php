<?php

    //Muestra los errores que puedan haber a la hora de ejecutar

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


// Conexión a la base de datos
include 'db.php';

// Obtener familias
$familias = $pdo->query("SELECT * FROM familia")->fetchAll(PDO::FETCH_ASSOC);

// Manejar selección de familia
$productos = [];

//Comprueba si se ha enviado una familia

if (isset($_POST['familia'])) {
    $familiaSeleccionada = $_POST['familia'];  //Guarda en la variable lo que se ha enviado
    $stmt = $pdo->prepare("SELECT * FROM producto WHERE familia = ?");  //prepara la consulta para ejecutarla de forma segura con parámetros.
    $stmt->execute([$familiaSeleccionada]); //  Sustituye el marcador ? por el valor de $familiaSeleccionada y ejecuta la consulta.
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC); //Recoge todos los registros encontrados y los guarda en el array $productos.
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tarea: Listado de productos de una familia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tarea: Listado de productos de una familia</h1>
    <form method="post" action="listado.php">
        <label for="familia">Seleccione una familia:</label>
        <select name="familia" id="familia">

            <!--Se recorre todas las familias del array-->
            <?php foreach ($familias as $familia): ?>

            <!-- value=" $familia['cod']  establece el código de la familia como valor de la opción.-->
            <!-- isset($familiaSeleccionada): comprueba que la variable esté definida y no sea null.
                 $familiaSeleccionada == $familia['cod']: comprueba si la familia actual es la seleccionada.
                 ? 'selected' : '': si coincide, añade selected para que aparezca marcada; si no, no añade nada.-->
                 
                <option value="<?= $familia['cod'] ?>" <?= isset($familiaSeleccionada) && $familiaSeleccionada == $familia['cod'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($familia['nombre']) ?>
                </option>   
            <?php endforeach; ?>
        </select>
        <button type="submit">Mostrar productos</button>
    </form>

    <?php if (!empty($productos)): ?>
        <h2>Productos de la familia</h2>
        <ul>
            <?php foreach ($productos as $producto): ?>
                <li>
                    
                    <?= htmlspecialchars($producto['nombre_corto']) ?> - <?= htmlspecialchars($producto['PVP']) ?>€
                    <form method="post" action="editar.php" style="display:inline;">
                        <input type="hidden" name="cod" value="<?= $producto['cod'] ?>">
                        <button type="submit">Editar</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>