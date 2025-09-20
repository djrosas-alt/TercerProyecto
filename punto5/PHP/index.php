<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <div class="contenedor">
    <h1>Resultado de la búsqueda</h1>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $texto  = $_POST["texto"] ?? '';
    $buscar = $_POST["buscar"] ?? '';

    if ($texto !== '' && $buscar !== '') {

        $buscar_escapado = preg_quote($buscar, '/');
        $resultado = preg_replace(
            "/($buscar_escapado)/i",
            '<span class="resaltado">$1</span>',
            $texto
        );

        echo "<p><strong>Texto ingresado con coincidencias resaltadas:</strong></p>";
        echo "<div class='resultado'>$resultado</div>";
    } else {
        echo "<p class='error'> Debes ingresar un texto y una palabra/frase a buscar.</p>";
    }
}
?>

    <br>
    <a href="index.html" class="volver">⬅ Volver</a>
  </div>
</body>
</html>
