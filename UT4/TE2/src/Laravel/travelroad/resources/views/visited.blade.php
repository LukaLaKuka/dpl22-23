<!DOCTYPE html>
<html lang='es'>

<head>
    <!-- etiquetas meta requeridas -->
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href='./img/logo.ico' rel=='shortcut icon' />
    <title>Sitios visitados</title>
</head>

<body>
    <h1>Travelroad</h1>
    <div>
        <h2>Sitios que ya he visitado</h2>
        <ul>
            @foreach ($visited as $place)
            <li>{{ $place->name }}</li>
            @endforeach
        </ul>
    </div>
</body>

</html>