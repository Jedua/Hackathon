<div class="logo">
    <h1>CodeSEEKS</h1>
    <img src="public/img/logo_5.png" alt="Logo">
</div>
<input type="checkbox" id="menu-toggle">
<label for="menu-toggle" class="menu-icon" id="menu-text">Abrir Menu</label>
<ul class="menu">
    <li><a href="index.php?page=perfil_admin">Perfil</a></li>
    <li><a href="#">Foro</a></li>
    <li><a href="#">Citas</a></li>
    <li><a href="#">Historial</a></li>
    <li><a href="#">Cerrar sesión</a></li>
    <?php
    //session_start();
    if (isset($_SESSION['usuario_id'])) {
        ?>
        <li><a href="index.php?page=logout">Cerrar Sesión</a></li> <!-- Enlace para cerrar sesión -->
        <?php
    }
    ?>
</ul>