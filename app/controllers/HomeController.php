<?php
require_once 'app/models/EspecialidadModel.php';

include_once "app/models/UserModel.php";

class HomeController {
    public function index() {
        $page = 'home';
        include 'app/views/templete.php';
    }

    public function registro() {
        // Tu lógica para la conexión a la base de datos debe estar aquí
        $database = new Database();
        $conexion = $database->conectar();

        // Instancia del modelo de especialidades
        $especialidadModel = new EspecialidadModel($conexion);

        // Obtener las especialidades desde el modelo
        $especialidades = $especialidadModel->obtenerEspecialidades();

        // Lógica para cargar la vista de registro con las especialidades obtenidas
        $page = 'registro';
        include 'app/views/templete.php';

        // Cerrar la conexión después de usarla
        $conexion->close();
    }

    public function login() {
        $page = 'login';
        include 'app/views/templete.php';
    }

    public function userRegistro() {
        $page = 'userRegistro';
       // include 'app/views/templete.php';
        require_once 'app/controllers/UserController.php';
    }

    // Otras funciones del controlador...

}




?>
