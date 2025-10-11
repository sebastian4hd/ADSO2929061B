<?php
session_start();
$title = "30 - Sessions";
$descripcion = "Ejercicio sencillo: guardar color favorito en sesión.";

include 'template/header.php';
echo '<section style="padding: 1rem;">';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['color'])) {
    $_SESSION['color'] = $_POST['color'];
}

if (isset($_SESSION['color'])) {
    $color = htmlspecialchars($_SESSION['color']);
    echo "<p>Tu color favorito es: <strong style='color: $color;'>$color</strong></p>";
} else {
    echo "<p>Aún no has elegido un color favorito.</p>";
}

echo '<form method="post">
        <label for="color">Elige tu color favorito:</label>
        <select name="color" id="color">
            <option value="red">Rojo</option>
            <option value="blue">Azul</option>
            <option value="green">Verde</option>
            <option value="purple">Morado</option>
        </select>
        <button type="submit">Guardar</button>
      </form>';

echo '</section>';
include 'template/footer.php';
?>
