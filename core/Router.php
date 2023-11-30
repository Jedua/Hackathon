<?php
require_once 'app/controllers/HomeController.php';

class Router {
    public function route() {
        $page = isset($_GET['page']) ? $_GET['page'] : 'index';
        $controller = new HomeController();

        switch ($page) {
            case 'registro':
                $controller->registro();
                break;
            case 'login':
                $controller->login(); // Agrega el método para cargar la vista de login
                break;
            case 'home':
                $controller->index();
                break;
            case 'userRegistro':
                    $controller->userRegistro();
                    break;
            default:
                $controller->index();
                break;
        }
    }
}
?>
