<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/nav.css">
    <link rel="stylesheet" href="public/css/form_registro.css">
    <title>Medical</title>
</head>
<body>
    <header>
        <nav>
            <?php include 'app/views/nav_logout.php'; ?>
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
