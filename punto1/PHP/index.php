<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Resultado</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $entrada = $_POST["numeros"];
        $valores = explode(",", $entrada);

        echo "<h2>Output:</h2>";
        echo "<ul>";

        foreach ($valores as $valor) {
            $valor = trim($valor); // eliminar espacios

            if (filter_var($valor, FILTER_VALIDATE_INT) !== false) {
                if ($valor % 2 == 0) {
                    echo "<li class='par'>$valor es número par</li>";
                } else {
                    echo "<li class='impar'>$valor es número impar</li>";
                }
            } else {
                echo "<li class='noentero'>$valor no es un número entero</li>";
            }
        }

        echo "</ul>";
    }
    ?>

    <br>
    <a href="index.html">Volver</a>
</body>
</html>
