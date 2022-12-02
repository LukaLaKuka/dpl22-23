<?php 
    require_once("../modelo/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelRoad</title>
</head>
<body>
    <div class="container">
        <h1>My Travel Bucket List</h1>
        <h2>Places I'd like to visit</h2>
        <?php consultCity("f");?>
        <h2>Places I've already been to</h2>
        <?php consultCity("t");?>
    </div>
</body>
</html>