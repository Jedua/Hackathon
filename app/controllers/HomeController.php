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

    public function cerrarSesion() {
        session_start();
        unset($_SESSION['usuario_id']); // Elimina el usuario de la sesión
        session_destroy(); // Destruye la sesión

        // Redirecciona a la página de inicio o a donde desees después de cerrar sesión
        header("Location: index.php"); // Cambia la ubicación según tu necesidad
        exit();
    }

    public function userRegistro() {
        $page = 'userRegistro';
       // include 'app/views/templete.php';
        require_once 'app/controllers/UserController.php';
    }

    public function userLogin() {
        $page = 'userLogin';
       // include 'app/views/templete.php';
        require_once 'app/controllers/LoginController.php';
    }

    public function perfilAdmin() {
        $page = 'administrador_perfil';
        require_once 'app/views/templete.php';
    }

    public function perfilPaciente() {
        $page = 'paciente_perfil';
        require_once 'app/views/templete.php';
    }

    public function perfilMedico() {
        $page = 'medico_perfil';
        require_once 'app/views/templete.php';
    }

    public function perfilVoluntario() {
        $page = 'voluntario_perfil';
        require_once 'app/views/templete.php';
    }

    public function paginaForo() {
        $page = 'forum_view';
        require_once 'app/views/templete.php';
    }

    public function paginaCitas() {
        $page = 'paginaCitas';
        require_once 'app/views/templete.php';
    }
    
    // Otras funciones del controlador...
    
    
}

?>
