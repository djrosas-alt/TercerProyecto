<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="CSS/estilos.css">
</head>
<body>
    <h1>Resultados</h1>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $entrada = $_POST["numeros"] ?? '';
    $valores = array_map('trim', explode(",", $entrada));


    $numeros = [];
    foreach ($valores as $valor) {
        if ($valor === '') continue;
        if (is_numeric($valor)) {
            $numeros[] = floatval($valor);
        }
    }

    if (count($numeros) > 0) {
        sort($numeros);
        $n = count($numeros);


        $promedio = array_sum($numeros) / $n;


        if ($n % 2 == 0) {
            $mid = $n / 2;
            $mediana = ($numeros[$mid - 1] + $numeros[$mid]) / 2;
        } else {
            $mediana = $numeros[floor($n / 2)];
        }


        $frecuencias = [];
        foreach ($numeros as $num) {

            $key = (string)$num;
            if (!isset($frecuencias[$key])) $frecuencias[$key] = 0;
            $frecuencias[$key]++;
        }

        $maxFrecuencia = max($frecuencias);
        $modas = array_map('floatval', array_keys($frecuencias, $maxFrecuencia));

        echo "<p><strong>Números ingresados:</strong> " . implode(", ", $numeros) . "</p>";
        echo "<ul>";
        echo "<li><strong>Promedio:</strong> " . round($promedio, 4) . "</li>";
        echo "<li><strong>Mediana:</strong> " . round($mediana, 4) . "</li>";
        echo "<li><strong>Moda(s):</strong> " . implode(", ", $modas) . " (frecuencia: $maxFrecuencia)</li>";
        echo "</ul>";
    } else {
        echo "<p class='error'> No se ingresaron números válidos.</p>";
    }
}
?>

    <br>
    <a href="index.html">Volver</a>
</body>
</html>

