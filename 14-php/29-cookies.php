<?php

$title = "29 - Cookies";
$descripcion = "Learn how to work with cookies in PHP.";

$name = $_POST['cookie_name'] ?? '';
$value = $_POST['cookie_value'] ?? '';
$message = '';

// **Procesar cookies ANTES de enviar salida**
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($name) || empty($value)) {
        $message = "<p style='color: red;'>Por favor, ingresa nombre y valor para la cookie.</p>";
    } else {
        setcookie($name, $value, time() + 3600, "/");
        $_COOKIE[$name] = $value;
        $message = "<p style='color: green;'>La cookie <strong>" . htmlspecialchars($name) . "</strong> ha sido creada con valor <strong>" . htmlspecialchars($value) . "</strong>.</p>";
    }
}

include 'template/header.php'; // Aquí ya empieza la salida

echo '<section style="padding: 1rem; max-width: 400px;">';

echo '<h2>Cookies</h2>';

echo '
<form action="" method="post" style="display: flex; flex-direction: column; gap: 0.7rem; margin-bottom: 1rem;">
    <input type="text" name="cookie_name" placeholder="Nombre de la cookie" value="' . htmlspecialchars($name) . '" required>
    <input type="text" name="cookie_value" placeholder="Valor de la cookie" value="' . htmlspecialchars($value) . '" required>
    <input type="submit" value="Crear Cookie">
</form>
';

echo $message;

if (!empty($_COOKIE)) {
    echo '<h3>Cookies actuales:</h3><ul>';
    foreach ($_COOKIE as $key => $val) {
        echo '<li><strong>' . htmlspecialchars($key) . '</strong>: ' . htmlspecialchars($val) . '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>No hay cookies definidas aún.</p>';
}

echo '</section>';

include 'template/footer.php';
?>
