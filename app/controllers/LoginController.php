<?php
include_once "app/models/UserModel.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();
    $user = $_POST['email'];
    $pass = $_POST['password'];
    $userController->iniciarSesion($user, $pass);
}

class UserController {
    public function iniciarSesion($email, $contrasena) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Inicia la sesión si no está activa
        }
        $userModel = new UserModel();
        $sesionIniciada = $userModel->iniciarSesion($email, $contrasena);
    
        if ($sesionIniciada) {
            $usuario_id = $_SESSION['usuario_id'];
            echo "usuario_id: $usuario_id\n";
            // Si la sesión se inicia correctamente, redirige al usuario según su rol
            $rol = $userModel->obtenerRol($usuario_id); // Usar usuario_id en lugar de email
            echo "ROL: $rol";
            // Resto del código para redirigir según el rol
            switch ($rol) {
                case 1:
                    header("Location: index.php?page=perfil_admin");
                    exit();
                case 2:
                    header("Location: index.php?page=perfil_paciente");
                    exit();
                case 3:
                    header("Location: index.php?page=perfil_medico");
                    exit();
                case 4:
                    header("Location: index.php?page=perfil_voluntario");
                    exit();
                default:
                    // En caso de que el rol no coincida, manejar la situación adecuadamente
                    echo "Error: Rol desconocido";
                    break;
            }
        } else {
            // Manejar error de inicio de sesión
            echo "Error: Credenciales incorrectas";
            // Puedes redirigir a una página de error o mostrar un mensaje en la vista
        }
    }
    
    

    public function cerrarSesion() {
        $userModel = new UserModel();
        $userModel->cerrarSesion();
        
        // Redireccionar a la página de inicio de sesión o a otra página que desees
        header("Location: index.php?page=login");
        exit(); // Detiene la ejecución después de la redirección
    }

    // Otros métodos del controlador según sea necesario
}
?>
