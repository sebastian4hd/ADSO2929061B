<?php
$title = "32 - Exceptions";
$descripcion = "Ejercicio mejorado: manejo de excepciones con formulario y validación.";

include 'template/header.php';
echo '<section style="padding: 1rem; max-width: 400px;">';

function dividir($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        throw new Exception("Ambos valores deben ser numéricos.");
    }
    if ($b == 0) {
        throw new Exception("No se puede dividir entre cero.");
    }
    return $a / $b;
}

echo '
<form method="post">
    <label>Dividendo:</label><br>
    <input type="text" name="a" required><br><br>
    
    <label>Divisor:</label><br>
    <input type="text" name="b" required><br><br>
    
    <button type="submit">Dividir</button>
</form><br>
';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST['a'];
    $b = $_POST['b'];

    try {
        $resultado = dividir($a, $b);
        echo "<p style='color: green;'>Resultado: $a ÷ $b = $resultado</p>";
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    }
}

echo '</section>';
include 'template/footer.php';
?>
