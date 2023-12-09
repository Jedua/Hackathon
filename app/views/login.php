<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia la sesión si no está activa
}

if (isset($_SESSION['mensaje_registro'])) {
    echo "<script>alert('{$_SESSION['mensaje_registro']}');</script>";
    unset($_SESSION['mensaje_registro']); // Limpiar el mensaje para la próxima vez
}

?>
 <main class="login-container">
    <div class="login-container">
            <form action="index.php?page=userLogin" method="POST" class="login-form">
                <h2>Iniciar Sesión</h2>
                <div class="input-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Iniciar Sesión</button>
            </form>
    </div>
</main>