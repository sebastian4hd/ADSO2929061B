<?php
$title = "31 - Send Mail (Simulado)";
$descripcion = "Simulación del envío de correo electrónico en entorno local.";

include 'template/header.php';
echo '<section style="padding: 1rem; max-width: 500px;">';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $to = htmlspecialchars($_POST['to']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    echo "<h3 style='color: green;'>✅ Correo simulado exitosamente.</h3>";
    echo "<p><strong>Para:</strong> $to</p>";
    echo "<p><strong>Asunto:</strong> $subject</p>";
    echo "<p><strong>Mensaje:</strong><br>" . nl2br($message) . "</p>";
}

echo '
    <form action="" method="post" style="display: flex; flex-direction: column; gap: 0.7rem; margin-top: 1rem;">
        <input type="email" name="to" placeholder="Correo destinatario" required>
        <input type="text" name="subject" placeholder="Asunto" required>
        <textarea name="message" placeholder="Mensaje" required rows="5"></textarea>
        <input type="submit" value="Simular envío">
    </form>
';

echo '</section>';
include 'template/footer.php';
?>
