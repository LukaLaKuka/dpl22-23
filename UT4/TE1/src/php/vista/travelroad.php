<?php require_once("../controlador/GeneratePlaces.php");?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelroad</title>
</head>
<body>
    <h1>Travelroad</h1>
    <h2>Places Visited</h2>
    <?php generateList(true);?>
    <h2>Places not visited yet</h2>
    <?php generateList(false);?>
</body>
</html>