<!DOCTYPE html>
<html lang='es'>

<head>
    <!-- etiquetas meta requeridas -->
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Sitios a visitar</title>
</head>

<body>
    <h1>Travelroad</h1>
    <div>
        <h2>Sitios que quiero visitar</h2>
        <ul>
            @foreach ($wished as $place)
            <li>{{ $place->name }}</li>
            @endforeach
        </ul>
    </div>
</body>

</html>