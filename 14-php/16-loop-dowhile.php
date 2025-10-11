<?php
$title = '16- Loop Do While';
$descripcion = '';

include 'template/header.php';

echo "<section style='display: flex; flex-direction: column; gap: 0.5rem;'>";

$i = 1;
$contador = 0;

do {
    if ($i % 2 == 0) {
        $cuadrado = $i * $i;
        echo "<p style='padding: 0.4rem 0.6rem; border: 2px solid #0006;'>Número: $i — Cuadrado: $cuadrado</p>";
        $contador++;
    }
    $i++;
} while ($contador < 5);

echo "</section>";

include 'template/footer.php';
?>
