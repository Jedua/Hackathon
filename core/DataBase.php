<?php
class Database {
    private $host = "localhost";
    private $usuario = "root";
    private $password = "";
    private $baseDeDatos = "medical_db";

    public function conectar() {
        $conexion = new mysqli($this->host, $this->usuario, $this->password, $this->baseDeDatos);

        if ($conexion->connect_error) {
            die("Error en la conexión: " . $conexion->connect_error);
        }

        return $conexion;
    }
}

?>