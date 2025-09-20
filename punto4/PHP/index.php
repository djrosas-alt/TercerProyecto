<?php
function parseConjunto($str) {
    $items = explode(',', $str);
    $conjunto = [];
    foreach ($items as $item) {
        $num = trim($item);
        if ($num !== '' && is_numeric($num)) {
            $conjunto[] = intval($num);
        }
    } 
    return array_values(array_unique($conjunto));
}

function union($A, $B) {
    return array_values(array_unique(array_merge($A, $B)));
}

function interseccion($A, $B) {
    return array_values(array_intersect($A, $B));
}

function diferencia($A, $B) {
    return array_values(array_diff($A, $B));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Operaciones con Conjuntos</title>
    <link rel="stylesheet" href="CSS/estilos.css">
</head>
<body>
    <div class="container">
        <h2>Resultado</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conjuntoA = isset($_POST["conjuntoA"]) ? $_POST["conjuntoA"] : '';
            $conjuntoB = isset($_POST["conjuntoB"]) ? $_POST["conjuntoB"] : '';
            $operacion = isset($_POST["operacion"]) ? $_POST["operacion"] : '';

            $A = parseConjunto($conjuntoA);
            $B = parseConjunto($conjuntoB);

            echo '<div class="resultado">';

            if (empty($A) || empty($B)) {
                echo "Por favor ingrese ambos conjuntos con números enteros válidos.";
            } else {
                switch ($operacion) {
                    case 'union':
                        $res = union($A, $B);
                        echo "Unión (A ∪ B):\n{ " . implode(", ", $res) . " }";
                        break;
                    case 'interseccion':
                        $res = interseccion($A, $B);
                        echo "Intersección (A ∩ B):\n{ " . implode(", ", $res) . " }";
                        break;
                    case 'diferenciaAB':
                        $res = diferencia($A, $B);
                        echo "Diferencia (A - B):\n{ " . implode(", ", $res) . " }";
                        break;
                    case 'diferenciaBA':
                        $res = diferencia($B, $A);
                        echo "Diferencia (B - A):\n{ " . implode(", ", $res) . " }";
                        break;
                    default:
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
