<?php
session_start();
if (isset($_SESSION['mensaje_registro'])) {
    echo "<script>alert('{$_SESSION['mensaje_registro']}');</script>";
    unset($_SESSION['mensaje_registro']); // Limpiar el mensaje para la próxima vez
}
?>

<h1>
    Estoy en login
</h1>