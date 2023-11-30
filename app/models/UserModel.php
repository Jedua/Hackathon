<?php
include_once "core/DataBase.php"; 

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insertarUsuario($nombre, $apellidoP, $apellidoM, $direccion, $email, $contrasena, $userType, $info = null, $num_cedula = null, $id_especialidad = null, $horarios = null, $presentacion = null, $nivel_estudios = null, $descripcion = null) {
        $conexion = $this->db->conectar();

        if ($userType === 'paciente') {
            $query = "INSERT INTO usuarios (nombre, apellidoP, apellidoM, direccion, email, contrasena, id_rol_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($query);
            $idRolUsuario = 2; // Rol de paciente
            $stmt->bind_param("ssssssi", $nombre, $apellidoP, $apellidoM, $direccion, $email, $contrasena, $idRolUsuario);

            if ($stmt->execute()) {
                $idUsuarioInsertado = $stmt->insert_id;
                $queryPaciente = "INSERT INTO pacientes (id_usuario, info_inicial) VALUES (?, ?)";
                $stmtPaciente = $conexion->prepare($queryPaciente);
                $stmtPaciente->bind_param("is", $idUsuarioInsertado, $info);
                $stmtPaciente->execute();
                return true;
            }
        } elseif ($userType === 'medico') {
            $query = "INSERT INTO usuarios (nombre, apellidoP, apellidoM, direccion, email, contrasena, id_rol_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($query);
            $idRolUsuario = 3; // Rol de médico
            $stmt->bind_param("ssssssi", $nombre, $apellidoP, $apellidoM, $direccion, $email, $contrasena, $idRolUsuario);
        
            if ($stmt->execute()) {
                $idUsuarioInsertado = $stmt->insert_id;
                $queryMedico = "INSERT INTO medicos (id_usuario, id_especialidad, horarios, num_cedula, presentacion) VALUES (?, ?, ?, ?, ?)";
                $stmtMedico = $conexion->prepare($queryMedico);
                $stmtMedico->bind_param("iisss", $idUsuarioInsertado, $id_especialidad, $horarios, $num_cedula, $presentacion);
            
                if ($stmtMedico->execute()) {
                    return true;
                }
            }
        } elseif ($userType === 'voluntario') {
            $query = "INSERT INTO usuarios (nombre, apellidoP, apellidoM, direccion, email, contrasena, id_rol_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($query);
            $idRolUsuario = 4; // Rol de voluntario
            $stmt->bind_param("ssssssi", $nombre, $apellidoP, $apellidoM, $direccion, $email, $contrasena, $idRolUsuario);
    
            if ($stmt->execute()) {
                $idUsuarioInsertado = $stmt->insert_id;
                $queryVoluntario = "INSERT INTO voluntarios (id_usuario, nivel_educacion, descripcion) VALUES (?, ?, ?)";
                $stmtVoluntario = $conexion->prepare($queryVoluntario);
                $stmtVoluntario->bind_param("iss", $idUsuarioInsertado, $nivel_estudios, $descripcion);
    
                if ($stmtVoluntario->execute()) {
                    return true;
                }
            }
        }

        return false;
    }
}
?>
