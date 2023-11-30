<?php
// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidoP = $_POST['apellidoP'];
    $apellidoM = $_POST['apellidoM'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $userType = $_POST['userType'];

    // Incluir el archivo que contiene el modelo de usuario
    include_once "app/models/UserModel.php";

    // Crear una instancia del modelo de usuario
    $userModel = new UserModel();

    // Mostrar los datos en un elemento <p>
    echo "<p>Nombre: $nombre</p>";
    echo "<p>Nombre: $apellidoP</p>";
    echo "<p>Nombre: $apellidoM</p>";
    echo "<p>Dirección: $direccion</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Contraseña: $contrasena</p>";
    echo "<p>Tipo de usuario: $userType</p>";

    // Realizar las acciones necesarias con los datos recibidos
    // Por ejemplo, guardar los datos en una base de datos
    $data = $_POST;
    if ($userType === 'paciente') {
        $info = $data['info'];
        echo "<p>info del paciente: $nombre</p>";
        // Llamar al método insertarUsuario del modelo para pacientes
        $userModel->insertarUsuario($nombre, $apellidoP, $apellidoM, $direccion, $email, $contrasena, $userType, $info);
    } elseif ($userType === 'medico') {
        // Obtener y establecer los datos específicos de médicos
        $id_especialidad = $data['id_especialidad'];
        $horarios = $data['horarios'];
        $num_cedula = $data['num_cedula'];
        $presentacion = $data['presentacion'];
        echo "<p>id_especialidad: $id_especialidad</p>";
        echo "<p>horarios: $horarios</p>";
        echo "<p>Num de cedula: $num_cedula</p>";
        echo "<p>presentacion: $presentacion</p>";
        // Llamar al método insertarUsuario del modelo para médicos
        $userModel->insertarUsuario($nombre, $apellidoP, $apellidoM, $direccion, $email, $contrasena, $userType, null, $num_cedula, $id_especialidad, $horarios, $presentacion);

    }elseif ($userType === 'voluntario') {
        $nivel_estudios = $data['nivel_estudios'];
        $info_voluntario = $data['info_voluntario'];
        echo "<p>nivel_estudios: $nivel_estudios</p>";
        echo "<p>info_voluntario: $info_voluntario</p>";
    
        var_dump($info_voluntario);

        if (!empty($info_voluntario)) {
            // Llamar al método insertarUsuario del modelo para voluntarios
            $userModel->insertarUsuario($nombre, $apellidoP, $apellidoM, $direccion, $email, $contrasena, $userType, null, null, null, null, null, $nivel_estudios, $info_voluntario);
        } else {
            echo "La información del voluntario está vacía.";
        }
    }
    
    // Mostrar un mensaje de éxito o redireccionar a una página de éxito
    session_start();
    // ... (tu código para el registro exitoso)
    $_SESSION['mensaje_registro'] = "Registro exitoso. ¡Gracias por registrarte!";
    header("Location: index.php?page=login");
    exit;
} else {
    // Si no se ha enviado el formulario, redireccionar a la página de registro
    header("Location: formulario_registro.html");
    exit;
}
?>
