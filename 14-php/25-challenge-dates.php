<?php  
$title  = '25- challengue-dates';
$descripcion = '';

include 'template/header.php';
?>

<section style="margin-top: 2rem;">
    <form method="post">
        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
        <input type="submit" value="Calcular Edad">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['fecha_nacimiento'])) {
        $fecha_nacimiento = new DateTime($_POST['fecha_nacimiento']);
        $fechaActual = new DateTime(); 
        $edad = $fechaActual->diff($fecha_nacimiento);
        echo "<p>Tu edad es: <strong>{$edad->y} años</strong></p>";
    }
    ?>
</section>

<?php
include 'template/footer.php';
