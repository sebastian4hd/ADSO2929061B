<?php
$title = '16- Loop Foreach';
$descripcion = 'Loop that iterates over each element of an array';

include 'template/header.php';

echo "<section style='display: flex; gap: 0.2rem;'>";

$signs = array( '♈ Aries','♉ Taurus','♊ Gemini','♋ Cancer','♌ Leo','♍ Virgo','♎ Libra','♏ Scorpio','♐ Sagittarius','♑ Capricorn','♒ Aquarius','♓ Pisces');


foreach ($signs as $sign) {
    echo "<p>$sign</p>";
}

include 'template/footer.php';