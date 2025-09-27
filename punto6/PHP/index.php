<?php

function esEnteroPositivo($num) {
    return is_numeric($num) && intval($num) == $num && intval($num) > 0;
}

function esEntero($num) {
    return is_numeric($num) && intval($num) == $num;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Verificador de Divisibilidad</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="container">
        <h2>Resultado</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $a = trim($_POST["numeroA"] ?? '');
            $b = trim($_POST["numeroB"] ?? '');

            echo '<div class="resultado">';

         
            $errorA = !esEnteroPositivo($a);
            $errorB = !esEnteroPositivo($b);

            if ($errorA && $errorB) {
              
                if (!esEntero($a) && !esEntero($b)) {
                    echo "Los números $a y $b no son enteros.";
                } elseif (!esEnteroPositivo($a) && !esEnteroPositivo($b)) {
                    echo "Los números $a y $b no son enteros positivos.";
                } else {
                    
                    if (!esEntero($a)) {
                        echo "El número $a no es entero positivo.\n";
                        echo "El número $b no es entero positivo.";
                    } else {
                        echo "El número $a no es entero positivo.\n";
                        echo "El número $b no es entero positivo.";
                    }
                }
            } elseif ($errorA) {
                
                if (!esEntero($a)) {
                    echo "El número $a no es entero.";
                } elseif (intval($a) <= 0) {
                    echo "El número $a no es positivo.";
                } else {
                    echo "El número $a no es entero positivo.";
                }
            } elseif ($errorB) {
                
                if (!esEntero($b)) {
                    echo "El número $b no es entero.";
                } elseif (intval($b) <= 0) {
                    echo "El número $b no es positivo.";
                } else {
                    echo "El número $b no es entero positivo.";
                }
            } else {
                
                $a_int = intval($a);
                $b_int = intval($b);
                
                if ($b_int == 0) {
                    echo "El número $b no se puede usar como divisor (división por cero).";
                } else {
                    if ($a_int % $b_int == 0) {
                        echo "El número $a es divisible entre el número $b.";
                    } else {
                        echo "El número $a no es divisible entre el número $b.";
                    }
                }
            }

            echo '</div>';
        } else {
            echo "No se recibieron datos";
        }
        ?>
    </div>
</body>
</html>
