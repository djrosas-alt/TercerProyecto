<?php
class Nodo {
    public $valor;
    public $izq;
    public $der;

    function __construct($valor) {
        $this->valor = $valor;
        $this->izq = null;
        $this->der = null;
    }
}

class ArbolBinario {
    public function construirPreIn($preorden, $inorden) {
        if (count($preorden) == 0 || count($inorden) == 0) return null;

        $raizValor = array_shift($preorden);
        $raiz = new Nodo($raizValor);
        $pos = array_search($raizValor, $inorden);

        $inIzq = array_slice($inorden, 0, $pos);
        $inDer = array_slice($inorden, $pos + 1);

        $preIzq = array_slice($preorden, 0, count($inIzq));
        $preDer = array_slice($preorden, count($inIzq));

        $raiz->izq = $this->construirPreIn($preIzq, $inIzq);
        $raiz->der = $this->construirPreIn($preDer, $inDer);

        return $raiz;
    }

    public function construirPostIn($postorden, $inorden) {
        if (count($postorden) == 0 || count($inorden) == 0) return null;

        $raizValor = array_pop($postorden);
        $raiz = new Nodo($raizValor);
        $pos = array_search($raizValor, $inorden);

        $inIzq = array_slice($inorden, 0, $pos);
        $inDer = array_slice($inorden, $pos + 1);

        $postIzq = array_slice($postorden, 0, count($inIzq));
        $postDer = array_slice($postorden, count($inIzq));

        $raiz->izq = $this->construirPostIn($postIzq, $inIzq);
        $raiz->der = $this->construirPostIn($postDer, $inDer);

        return $raiz;
    }

    public function imprimir($nodo, $nivel = 0) {
        if ($nodo == null) return "";
        $out = $this->imprimir($nodo->der, $nivel + 1);
        $out .= str_repeat("   ", $nivel) . $nodo->valor . "\n";
        $out .= $this->imprimir($nodo->izq, $nivel + 1);
        return $out;
    }
}

$resultado = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $preorden = !empty($_POST["preorden"]) ? explode(",", str_replace(" ", "", $_POST["preorden"])) : [];
    $inorden = !empty($_POST["inorden"]) ? explode(",", str_replace(" ", "", $_POST["inorden"])) : [];
    $postorden = !empty($_POST["postorden"]) ? explode(",", str_replace(" ", "", $_POST["postorden"])) : [];

    $arbol = new ArbolBinario();

    if (!empty($preorden) && !empty($inorden)) {
        $raiz = $arbol->construirPreIn($preorden, $inorden);
        $resultado = "<h2>Árbol reconstruido (Pre + In)</h2><pre class='arbol'>" . $arbol->imprimir($raiz) . "</pre>";
    } elseif (!empty($postorden) && !empty($inorden)) {
        $raiz = $arbol->construirPostIn($postorden, $inorden);
        $resultado = "<h2>Árbol reconstruido (Post + In)</h2><pre class='arbol'>" . $arbol->imprimir($raiz) . "</pre>";
    } else {
        $resultado = "<p class='error'> Debes ingresar Inorden y además Preorden o Postorden.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Árbol Binario</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>
<body>
<div class="contenedor">
    <h1>Construcción de Árbol Binario</h1>
    <form method="POST">
        <label>Preorden:</label>
        <input type="text" name="preorden" placeholder="A,B,D,E,C" value="<?php echo $_POST['preorden'] ?? ''; ?>">

        <label>Inorden:</label>
        <input type="text" name="inorden" placeholder="D,B,E,A,C" value="<?php echo $_POST['inorden'] ?? ''; ?>">

        <label>Postorden:</label>
        <input type="text" name="postorden" placeholder="D,E,B,C,A" value="<?php echo $_POST['postorden'] ?? ''; ?>">

        <button type="submit">Construir Árbol</button>
    </form>

    <div class="resultado">
        <?php echo $resultado; ?>
    </div>
</div>
</body>
</html>
