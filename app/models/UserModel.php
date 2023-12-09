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

    public function iniciarSesion($email, $contrasena) {
        $conexion = $this->db->conectar();
        $query = "SELECT id, nombre, id_rol_usuario FROM usuarios WHERE email = ? AND contrasena = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ss", $email, $contrasena);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows === 1) {
            $usuario = $result->fetch_assoc();
    
            // Obtener el rol del usuario
            $rol = $this->obtenerRol($email);
    
            // Iniciar sesión (crear variables de sesión)
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario'] = $usuario['nombre'];
            $_SESSION['rol'] = $rol; // Utilizar el rol obtenido
    
            return true;
        }
    
        return false; // Si las credenciales no son válidas
    }
    
    public function obtenerRol($usuario_id) {
        $conexion = $this->db->conectar();
    
        // Preparar la consulta para obtener el nombre del rol
        $query = "SELECT r.tipo FROM usuarios u
                  JOIN rol_usuario r ON u.id_rol_usuario = r.id
                  WHERE u.id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("i", $usuario_id);
        
        // Ejecutar la consulta
        $stmt->execute();
        $stmt->bind_result($tipoRol);
        $stmt->fetch();
        
        // Cerrar la conexión y devolver el nombre del rol
        $stmt->close();
        $conexion->close();
    
        return $tipoRol;
    }
    
    
    // Función para verificar si el usuario está autenticado
    public function estaAutenticado() {
        return isset($_SESSION['usuario']);
    }

    // Función para cerrar sesión
    public function cerrarSesion() {
        // Destruir todas las variables de sesión
        session_start();
        session_destroy();
    }

    public function obtenerNombreUsuario($idUsuario) {
        $conexion = $this->db->conectar();// Lógica para obtener el nombre de usuario desde la base de datos
        // SELECT nombre FROM usuarios WHERE id = $idUsuario
        // Supongamos que $nombre es el nombre obtenido de la base de datos
        $nombre = "Nombre de Usuario"; // Ejemplo, reemplaza con la lógica real de la base de datos
        return $nombre;
    }
}
?>
