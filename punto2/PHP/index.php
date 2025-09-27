<?php
function fibonacci($n) {
    $serie = [];
    if ($n == 0) return $serie;
    if ($n >= 1) $serie[] = 0;
    if ($n >= 2) $serie[] = 1;
    for ($i = 2; $i < $n; $i++) {
        $serie[] = $serie[$i-1] + $serie[$i-2];
    }
    return $serie;
}


function factorial($n) {
    if ($n == 0 || $n == 1) return 1;
    $fact = 1;
    for ($i = 2; $i <= $n; $i++) {
        $fact *= $i;
    }
    return $fact;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Calculadora Fibonacci y Factorial</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>
<body>
    <div class="container">
        <h2>Resultado</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $num = intval($_POST["numero"]);
            $operacion = $_POST["operacion"];

            echo '<div class="resultado">';
            if ($num < 0) {
                echo "Por favor ingrese un número entero positivo.";
            } else {
                if ($operacion == "fibonacci") {
                    $fib = fibonacci($num);
                    echo "Sucesión de Fibonacci con $num términos:\n";
                    echo implode(", ", $fib);
                } elseif ($operacion == "factorial") {
                    $fact = factorial($num);
                    echo "Factorial de $num:\n";
                    echo $fact;
                } else {
                    echo "Operación no válida.";
                }
            }
            echo '</div>';
        } else {
            echo "No se recibieron datos.";
        }
        ?>
        <p><a href="index.html">Volver</a></p>
    </div>
</body>
</html>

