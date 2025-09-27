<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Números Pares e Impares</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>
<body>
    <h1>Identificador de Números Pares e Impares</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $entrada = $_POST["numeros"];
        $valores = explode(",", $entrada);

        echo "<h2>Resultado:</h2>";
        echo "<ul>";

        foreach ($valores as $valor) {
            $valor = trim($valor); 

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
</body>
</html>

