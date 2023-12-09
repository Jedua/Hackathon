<div class="container">
        <h2>Registro de usuario</h2>
        <form id="registrationForm" action="index.php?page=userRegistro" method="post">
        <div class="input-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="apellidoP">Apellido Paterno:</label>
            <input type="text" id="apellidoP" name="apellidoP" required>
            <label for="apellidoM">Apellido Materno:</label>
            <input type="text" id="apellidoM" name="apellidoM" required>
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
        </div>
 
        <div class="input-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
        </div>
        <div class="input-group">
            <label for="userType">Selecciona tu tipo de usuario:</label><br>
            <input type="radio" id="tipo_paciente" name="userType" value="paciente" checked>
            <label for="tipo_paciente">Paciente</label>
            <input type="radio" id="tipo_medico" name="userType" value="medico">
            <label for="tipo_medico">Médico</label>
            <input type="radio" id="tipo_voluntario" name="userType" value="voluntario">
            <label for="tipo_voluntario">Voluntario</label>
        </div>
        <!-- Campos para paciente -->
        <div id="pacienteFields" class="input-group" style="display: none;">
            <label for="info">Información para pacientes:</label>
            <textarea id="info" name="info" rows="4" cols="50"></textarea>
        </div>
         <!-- Campos para voluntario-->
         <div id="voluntarioFields" class="input-group" style="display: none;">
            <label for="nivel_estudios">Estudios:</label>
            <select name="nivel_estudios" id="nivel_estudios">
                <option value="primaria">Primaria</option>
                <option value="secundaria">Secundaria</option>
                <option value="Preparatoria">Preparatoria</option>
                <option value="bachillerato">Bachillerato</option>
                <option value="licenciatura">Licenciatura</option>
                <option value="Ingenieria">Ingenieria</option>
                <option value="maestria">Maestria</option>
                <option value="doctorado">Doctorado</option>
            </select>

            <label for="info_voluntario">Información para voluntarios:</label>
            <textarea id="info_voluntario" name="info_voluntario" rows="4" cols="50"></textarea>
        </div>
        <!-- Campos para médico -->
        <div id="medicoFields" class="input-group" style="display: none;">
            <label for="num_cedula">Número de cédula:</label>
            <input type="text" id="num_cedula" name="num_cedula">

            <label for="id_especialidad">Especialidad:</label>
            <select id="id_especialidad" name="id_especialidad">
                <?php while ($row = mysqli_fetch_assoc($especialidades)) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                <?php } ?>
            </select>

            <label for="horarios">Horarios:</label>
            <input type="text" id="horarios" name="horarios">

            <label for="presentacion">Presentación:</label>
            <textarea id="presentacion" name="presentacion"></textarea>
        </div>
        <div class="input-group">
            <input type="submit" value="Registrarse">
        </div>
    </form>
    </div>

    <script>
        const pacienteFields = document.getElementById('pacienteFields');
        const medicoFields = document.getElementById('medicoFields');
        const voluntarioFields = document.getElementById('voluntarioFields');
        const tipoPaciente = document.getElementById('tipo_paciente');
        const tipoMedico = document.getElementById('tipo_medico');
        const tipoVoluntario = document.getElementById('tipo_voluntario');

        function toggleFields() {
            if (tipoPaciente.checked) {
                pacienteFields.style.display = 'block';
                medicoFields.style.display = 'none';
                voluntarioFields.style.display = 'none';
            } else if (tipoMedico.checked) {
                medicoFields.style.display = 'block';
                pacienteFields.style.display = 'none';
                voluntarioFields.style.display = 'none';
            } else if (tipoVoluntario.checked){
                medicoFields.style.display = 'none';
                pacienteFields.style.display = 'none';
                voluntarioFields.style.display = 'block';
            }
        }

        tipoPaciente.addEventListener('change', toggleFields);
        tipoMedico.addEventListener('change', toggleFields);
        tipoVoluntario.addEventListener('change',toggleFields);

        toggleFields(); // Llamar a la función inicialmente para mostrar los campos adecuados
    </script>