-- Crear la base de datos
CREATE DATABASE berilion;
USE berilion;

-- Tabla: Gestionar Cliente
CREATE TABLE Cliente (
    cedula VARCHAR(15) PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    correo VARCHAR(100),
    telefono VARCHAR(20),
    direccion VARCHAR(255),
    organizacion VARCHAR(100),
    sede VARCHAR(100)
);

-- Tabla: Gestionar Personal Técnico
CREATE TABLE PersonalTecnico (
    cedula VARCHAR(15) PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    cargo VARCHAR(50),
    direccion VARCHAR(255),
    correo VARCHAR(100),
    telefono VARCHAR(20),
    cursos_realizados TEXT
);

-- Tabla: Gestionar Solicitudes
CREATE TABLE Solicitudes (
    id_codigo INT AUTO_INCREMENT PRIMARY KEY,
    cliente VARCHAR(15),
    descripcion TEXT,
    sede VARCHAR(100),
    fecha DATE,
    estado_ticket VARCHAR(50),
    tecnico_asignado VARCHAR(15),
    prioridad VARCHAR(20),
    FOREIGN KEY (cliente) REFERENCES Cliente(cedula),
    FOREIGN KEY (tecnico_asignado) REFERENCES PersonalTecnico(cedula)
);

-- Tabla: Gestionar Recursos Tecnológicos
CREATE TABLE RecursosTecnologicos (
    codigo_de_herramientas VARCHAR(20) PRIMARY KEY,
    nombre VARCHAR(100),
    tipo_de_h VARCHAR(100),
    herramientas TEXT,
    materiales TEXT,
    disponibilidad VARCHAR(50),
    cantidad INT
);

-- Tabla: Gestión de Talleres
CREATE TABLE Talleres (
    codigo_taller VARCHAR(20) PRIMARY KEY,
    descripcion_taller TEXT,
    correo VARCHAR(100),
    participante VARCHAR(100),
    encargado VARCHAR(100),
    fecha DATE,
    hora TIME
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    usuario VARCHAR(50) UNIQUE,
    contrasena VARCHAR(255),
    cargo VARCHAR(50)
);

