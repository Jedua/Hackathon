CREATE DATABASE medical_db;

USE medical_db;

-- Tabla para tipos de usuario 1. admin, 2. usuario paciente, 3. usuario medico, 4. usuario voluntario
CREATE TABLE rol_usuario (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    tipo TINYINT NOT NULL
);

-- Tabla para usuarios
CREATE TABLE usuarios (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellidoP VARCHAR(50) NOT NULL,
    apellidoM VARCHAR(50) NOT NULL,
    direccion VARCHAR(100),
    email VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(100),
    id_rol_usuario INT,
    FOREIGN KEY (id_rol_usuario) REFERENCES rol_usuario(id)
);

-- Tabla de especialidades médicas
CREATE TABLE especialidades (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) UNIQUE
);

-- Tabla para médicos con referencia a especialidades, Restricción ON DELETE CASCADE para la tabla pacientes
CREATE TABLE medicos (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_usuario INT,
    id_especialidad INT,
    horarios VARCHAR(100),
    num_cedula VARCHAR(20) UNIQUE,
    presentacion VARCHAR(255),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_especialidad) REFERENCES especialidades(id)
);

-- Restricción ON DELETE CASCADE para la tabla pacientes
CREATE TABLE pacientes (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_usuario INT,
    info_inicial TEXT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Restricción ON DELETE CASCADE para la tabla voluntariado
CREATE TABLE voluntarios (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_usuario INT,
    nivel_educacion VARCHAR(100),
    descripcion TEXT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);


CREATE TABLE clinicasMedicas (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_medico INT,
    tipo VARCHAR(20),
    direccion VARCHAR(100),
    FOREIGN KEY (id_medico) REFERENCES medicos(id) ON DELETE CASCADE
);

CREATE TABLE medicamentos (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) UNIQUE
    -- Otros detalles sobre el medicamento si es necesario
);

CREATE TABLE historialMedico (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Diagnostico VARCHAR(255),
    FechaConsulta DATETIME,
    id_medico INT,
    id_paciente INT,
    FOREIGN KEY (id_paciente) REFERENCES pacientes(id) ON DELETE CASCADE,
    FOREIGN KEY (id_medico) REFERENCES medicos(id) ON DELETE CASCADE
);

CREATE TABLE recetas (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_consulta INT,
    FOREIGN KEY (id_consulta) REFERENCES historialMedico(id) ON DELETE CASCADE
);

CREATE TABLE recetaMedicamentos (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    dosis VARCHAR(200),
    dias TINYINT,
    fecha_inicio DATE,
    id_receta INT,
    id_medicamento INT,
    FOREIGN KEY (id_receta) REFERENCES recetas(id) ON DELETE CASCADE,
    FOREIGN KEY (id_medicamento) REFERENCES medicamentos(id) ON DELETE CASCADE
);

-- Crear tabla para registrar inserciones en historialMedico
CREATE TABLE log_historialMedico (
    log_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    accion VARCHAR(100),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pagos (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_consulta INT,
    monto DECIMAL(10, 2),
    fecha_pago DATE,
    metodo_pago VARCHAR(50),
    estado_pago VARCHAR(50),
    FOREIGN KEY (id_consulta) REFERENCES historialMedico(id) ON DELETE CASCADE
);

CREATE TABLE calificaciones (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_consulta INT,
    id_paciente INT,
    calificacion INT,
    comentario TEXT,
    FOREIGN KEY (id_consulta) REFERENCES historialMedico(id) ON DELETE CASCADE,
    FOREIGN KEY (id_paciente) REFERENCES pacientes(id) ON DELETE CASCADE
);

CREATE TABLE eventos (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre_evento VARCHAR(100),
    fecha DATE,
    ubicacion VARCHAR(100),
    descripcion TEXT
);

CREATE TABLE participacion_voluntariado (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_voluntario INT,
    id_evento INT,
    FOREIGN KEY (id_voluntario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_evento) REFERENCES eventos(id) ON DELETE CASCADE
);

CREATE TABLE foro_mensajes (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_usuario INT,
    titulo VARCHAR(100),
    contenido TEXT,
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);


-- Crear disparador para registrar inserciones en historialMedico
DELIMITER //
CREATE TRIGGER trg_insert_historialMedico
AFTER INSERT ON historialMedico
FOR EACH ROW
BEGIN
    INSERT INTO log_historialMedico (accion)
    VALUES ('Nueva inserción en historialMedico');
END//
DELIMITER ;

-- Disparador para validar el rol de los usuarios

DELIMITER //

CREATE TRIGGER trg_rol_usuario_default
BEFORE INSERT ON rol_usuario
FOR EACH ROW
BEGIN
    IF NEW.tipo NOT IN (1, 2, 3, 4) THEN
        SET NEW.tipo = 2; -- Insertar por defecto el valor 2 (usuario paciente)
    END IF;
END//

DELIMITER ;

-- inserciones a la BD

INSERT INTO especialidades (nombre) VALUES
('Cardiología'),
('Dermatología'),
('Gastroenterología'),
('Neurología'),
('Pediatría'),
('Oftalmología'),
('Oncología'),
('Psiquiatría'),
('Endocrinología'),
('Urología'),
('Hematología'),
('Infectología'),
('Nefrología'),
('Reumatología'),
('Geriatría'),
('Neumología'),
('Ginecología'),
('Otorrinolaringología'),
('Traumatología'),
('Radiología'),
('Anestesiología'),
('Hepatología'),
('Oncología Pediátrica'),
('Medicina Interna'),
('Cirugía General'),
('Psicología Clínica'),
('Genética Médica'),
('Neurocirugía'),
('Nutriología'),
('Oncología Radioterápica'),
('Patología Clínica'),
('Medicina Deportiva'),
('Fisioterapia'),
('Medicina Familiar'),
('Medicina del Trabajo'),
('Medicina Nuclear'),
('Psicoterapia'),
('Cirugía Plástica'),
('Cirugía Vascular'),
('Ortopedia'),
('Oncología Quirúrgica');

INSERT INTO medicamentos (nombre) VALUES
('Paracetamol'),
('Ibuprofeno'),
('Amoxicilina'),
('Omeprazol'),
('Aspirina'),
('Loratadina'),
('Ciprofloxacino'),
('Atorvastatina'),
('Metformina'),
('Fluoxetina'),
('Acetaminofén'),
('Cetirizina'),
('Diclofenaco'),
('Clonazepam'),
('Levotiroxina'),
('Losartán'),
('Pantoprazol'),
('Sertralina'),
('Tramadol'),
('Amitriptilina'),
('Furosemida'),
('Prednisona'),
('Ranitidina'),
('Warfarina'),
('Glibenclamida'),
('Esomeprazol'),
('Metoprolol'),
('Insulina'),
('Diazepam'),
('Hidroclorotiazida'),
('Amoxicilina/Ácido Clavulánico'),
('Hidroclorotiazida/Losartán'),
('Sulfametoxazol/Trimetoprima'),
('Ibuprofeno/Paracetamol'),
('Dextrometorfano/Bromhidrato de Clorfenesina'),
('Ciprofloxacino/Dexametasona'),
('Doxiciclina/Metronidazol'),
('Budesonida/Formoterol'),
('Valsartán/Hidroclorotiazida'),
('Naproxeno/Esomeprazol'),
('Levodopa/Carbidopa'),
('Fluticasona/Salmeterol'),
('Lisinopril/Hidroclorotiazida'),
('Ezetimiba/Simvastatina'),
('Bicarbonato de Sodio/Citrato de Sodio'),
('Acetaminofén/Codeína'),
('Lansoprazol/Amoxicilina/Claritromicina'),
('Ácido Acetilsalicílico/Cafeína/Dihidrocodeína'),
('Paracetamol/Pamabrom'),
('Atorvastatina/Amlodipino'),
('Ciprofloxacino/Dexametasona/Hidrocortisona/Neomicina'),
('Metformina/Glibenclamida'),
('Amlodipino/Valsartán'),
('Levofloxacino/Dexametasona'),
('Metronidazol/Miconazol'),
('Pseudoefedrina/Guaifenesina'),
('Acetaminofén/Fenilefrina/Clorfeniramina'),
('Cefuroxima/Axetil/Axetil/Clavulánico'),
('Hidrocortisona/Lidocaína'),
('Naproxeno/Esomeprazol/Magnesio'),
('Fluticasona/Furoato de Vilanterol'),
('Salbutamol/Bromuro de Ipratropio'),
('Sulfato de Neomicina/Bacitracina/Polimixina B'),
('Omeprazol/Amoxicilina/Tinidazol'),
('Ceftriaxona/Sulbactam');

-- Insertar roles de usuarios
INSERT INTO rol_usuario (tipo) VALUES
(1), -- Admin
(2), -- Usuario paciente
(3), -- Usuario médico
(4); -- Usuario Voluntario

-- Insertar usuarios
INSERT INTO usuarios (nombre, apellidoP, apellidoM, direccion, email, contrasena, id_rol_usuario) VALUES
('Admin', 'ApellidoAdminP', 'ApellidoAdminM', 'Dirección de administrador', 'admin@example.com', 'contrasena_admin', 1), -- Admin
('Médico 1', 'ApellidoMedico1P', 'ApellidoMedico1M', 'Dirección de médico 1', 'medico1@example.com', 'contrasena_medico1', 3), -- Médico
('Médico 2', 'ApellidoMedico2P', 'ApellidoMedico2M', 'Dirección de médico 2', 'medico2@example.com', 'contrasena_medico2', 3), -- Médico
('Médico 3', 'ApellidoMedico3P', 'ApellidoMedico3M', 'Dirección de médico 3', 'medico3@example.com', 'contrasena_medico3', 3), -- Médico
('Paciente 1', 'ApellidoPaciente1P', 'ApellidoPaciente1M', 'Dirección de paciente 1', 'paciente1@example.com', 'contrasena_paciente1', 2), -- Paciente
('Paciente 2', 'ApellidoPaciente2P', 'ApellidoPaciente2M', 'Dirección de paciente 2', 'paciente2@example.com', 'contrasena_paciente2', 2), -- Paciente
('Paciente 3', 'ApellidoPaciente3P', 'ApellidoPaciente3M', 'Dirección de paciente 3', 'paciente3@example.com', 'contrasena_paciente3', 2); -- Paciente

-- Insertar datos para médicos
INSERT INTO medicos (id_usuario, id_especialidad, horarios, num_cedula, presentacion) VALUES
(2, 1, 'Horarios del médico 1', '123456', 'Presentación del médico 1'), -- Médico 1
(3, 2, 'Horarios del médico 2', '789012', 'Presentación del médico 2'), -- Médico 2
(4, 3, 'Horarios del médico 3', '345678', 'Presentación del médico 3'); -- Médico 3

-- Insertar datos para pacientes
INSERT INTO pacientes (id_usuario, info_inicial) VALUES
(5, 'Información inicial del paciente 1'), -- Paciente 1
(6, 'Información inicial del paciente 2'), -- Paciente 2
(7, 'Información inicial del paciente 3'); -- Paciente 3
