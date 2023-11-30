<?php
require_once 'core/DataBase.php';

class EspecialidadModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerEspecialidades() {
        $query = "SELECT id, nombre FROM especialidades";
        $result = $this->conexion->query($query);

        if (!$result) {
            die("Error en la consulta: " . $this->conexion->error);
        }

        return $result;
    }
}
?>
