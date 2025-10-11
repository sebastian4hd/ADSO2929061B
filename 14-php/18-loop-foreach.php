<?php
$title = '16- Loop Foreach';
$descripcion = 'Loop that iterates over each key-value pair in an associative array';

include 'template/header.php';

echo "<section style='display: flex; flex-direction: column; gap: 0.5rem;'>";

$languages = array(
    'Python' => 1991,
    'JavaScript' => 1995,
    'Java' => 1995,
    'C++' => 1985,
    'PHP' => 1995,
    'Go' => 2009
);

foreach ($languages as $language => $year) {
    echo "<p><strong>$language</strong> fue creado en <strong>$year</strong>.</p>";
}

echo "</section>";

include 'template/footer.php';
?>
