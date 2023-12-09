<?php
    include_once "app/controllers/UserController.php";

    $userController = new UserController();
    $userController->cerrarSesion();

?>