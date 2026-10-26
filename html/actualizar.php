<?php

include 'db.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    if($_POST['accion']=='actualizar'){
        
        //Actualizar datos del producto
        $stmt = $pdo->prepare("UPDATE producto SET nombre_corto =?,nombre=?,descripcion=?,PVP=? WHERE cod=?"); //Consulta a la base de datos
        $stmt-> execute([$_POST['nombre_corto'],$_POST['nombre'],$_POST['descripcion'],$_POST['PVP'],$_POST['cod']]); //envía los cinco valores en el mismo orden que los marcadores ?.
        $mensaje="Se han actualizado los datos";
    }else{
        $mensaje="Actualizacion cancelada";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizacion del producto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Actualizacion de producto</h1>
    <p><?= $mensaje ?></p>
    <form method="get" action="listado.php">
        <button type="submit">Continuar</button>
    </form>
</body>
</html>