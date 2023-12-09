<?php
session_start();
$loggedIn = isset($_SESSION['usuario_id']); // Verifica si el usuario está conectado
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/nav.css">
    <link rel="stylesheet" href="public/css/form_registro.css">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="public/css/home.css">
    <link rel="stylesheet" href="public/css/footer.css">  
    <title>Medical</title>
</head>

<body>
    <header>
        <nav>
            <?php
            if ($loggedIn) {
                include 'app/views/nav_logged_in.php'; // Incluir nav para sesión iniciada
            } else {
                include 'app/views/nav_logged_out.php'; // Incluir nav para sesión cerrada
            }
            ?>
        </nav>
    </header>
    <main>
        <?php include 'app/views/' . $page . '.php'; ?>
    </main>
    <footer>
        <?php include 'app/views/footer.php'; ?>
    </footer>
</body>

</html>
