<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<?php

/* Funcion que imprime la suma de dos valores */
function suma($valor1, $valor2) {
    echo "$valor1 más $valor2 = ".$valor1+$valor2;
}

/* Funcion que imprime la resta de dos valores */
function resta($valor1, $valor2) {
    echo "$valor1 menos $valor2 = ".$valor1-$valor2;
}

/* Funcion que imprime el producto de dos valores */
function producto($valor1, $valor2) {
    echo "$valor1 multiplicado por $valor2 = ".$valor1*$valor2;
}

/* Funcion que imprime la división de dos valores */
function division($valor1, $valor2) {
    echo "$valor1 dividido entre $valor2 = ".$valor1/$valor2;
}

/* Funcion que imprime el resto de una división de dos valores */
function resto($valor1, $valor2) {
    echo "El resto de $valor1/$valor2 = ".$valor1%$valor2;
}

/* Funcion que imprime el resultado del valor1 elevado a valor2 */
function exponente($valor1, $valor2) {
    $resultado=pow($valor1, $valor2);
    echo "$valor1 elevado a $valor2 = $resultado.";
}

/* Funcion que imprime la raiz de valor1 sobre valor2 (si valor2 fuera 2: raíz cuadrada, si valor2 fuera3: raíz cúbica) */
function raiz($valor1, $valor2) {
    $raiz = pow($valor1, 1/$valor2);
    echo "La raiz de $valor1 sobre $valor2 = $raiz";
}

/* Funcion que imprime el porcentaje que ocupa el valor1 con respecto al valor2 */
function porcentaje($valor1, $valor2) {
    $porcentaje = ($valor1 / $valor2)*100;
    echo "$valor1 conforma el $porcentaje% de $valor2";
}

function controlDatos($valor1, $valor2):bool {
    if (is_numeric($valor1) && is_numeric($valor2)) {
        return true;
    }
    return false;
}

function operacion ($operacion, $valor1, $valor2) {
    if ($operacion=="suma") {
        suma($valor1, $valor2);
    } else if ($operacion=="resta") {
        resta($valor1, $valor2);
    } else if ($operacion=="producto") {
        producto($valor1, $valor2);
    } else if ($operacion=="dividir") {
        division($valor1, $valor2);
    } else if ($operacion=="resto") {
        resto($valor1, $valor2);
    } else if ($operacion=="exponente") {
        exponente($valor1, $valor2);
    } else if ($operacion=="raiz") {
        raiz($valor1, $valor2);
    } else {
        porcentaje($valor1, $valor2);
    }
}
?>

<body>
    <header>
        <h1>Calculadora</h1>
    </header>
    
    <main>
        <form action="" method="post" enctype="multipart/form-data">
            <label>
                Valor 1:
            </label>
            <input type="number" name="valor1"/><br/>
            <label>
                Valor 2:
            </label>
            <input type="number" name="valor2"/><br/>
            <select id="operacion" name="operacion">
                <option value="suma">Suma</option>
                <option value="resta">Resta</option>
                <option value="producto">Multiplicación</option>
                <option value="dividir">División</option>
                <option value="resto">Resto</option>
                <option value="exponente">Exponente</option>
                <option value="raiz">Raíz</option>
                <option value="porcentaje">Porcentaje</option>
            </select>
            
            <img src="calculadora.png"><br/>

            <button type="submit" name="submit">Calcular</button>
            <button type="reset">Limpiar campos</button>
            
        </form>
        <br/>

        <?php 
            if (isset($_POST['valor1']) && isset($_POST['valor2'])) {
                $valor1 = $_POST['valor1'];
                $valor2 = $_POST['valor2'];
                $operacion = $_POST['operacion'];
                if (controlDatos($valor1, $valor2)) {
                    operacion($operacion, $valor1, $valor2);
                } else {
                    echo "Datos no válidos";
                }
            }
        ?>
    </main>

    <footer>
        <p>Trabajo realizado por: <a href="https://github.com/Tomhuel">Tomás Nahuel Antela Rizzo</a></p>
    </footer>

</body>
</html>