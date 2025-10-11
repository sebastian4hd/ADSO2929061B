<?php
$title = '16- Loop For';
$descripcion = 'A loop that repeats a block of code a specific number of times';

include 'template/header.php';

echo "<section style='display: flex; flex-direction: column; gap: 0.5rem;'>";

echo "<h2>Tabla del 5</h2>";

for ($i = 1; $i <= 10; $i++) {
    $resultado = 5 * $i;
    echo "<p>5 × $i = $resultado</p>";
}

echo "</section>";

include 'template/footer.php';
?>
