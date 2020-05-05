/* CREACION BASE DE DATOS*/
drop database if exists db_app;
create database if not exists db_app character set utf8 collate utf8_general_ci;
use db_app;

-- -----------------------------------------------------------------------------

/* CREACION DE TABLAS */
drop table if exists tbl_imagenes;
create table if not exists tbl_imagenes
(
    id    int(11) auto_increment unique,
    file0 varchar(255) not null,
    constraint pk_idImagenes primary key (id)
) ENGINE = InnoDb;


drop table if exists tbl_sexo;
create table if not exists tbl_sexo
(
    id   int(11) auto_increment unique,
    sexo varchar(255) not null,
    constraint pk_idSexo primary key (id)
) ENGINE = InnoDb;


drop table if exists tbl_provincias;
create table if not exists tbl_provincias
(
    id        int(11) auto_increment unique,
    provincia varchar(255) not null,
    constraint pk_idProvincias primary key (id)
) ENGINE = InnoDb;


drop table if exists tbl_comunas;
create table if not exists tbl_comunas
(
    id           int(11) auto_increment unique,
    comuna       varchar(255) not null,
    id_provincia int(11)      not null,
    constraint pk_idcomunas primary key (id),
    constraint fk_tblcomunas_tblprovincias foreign key (id_provincia) references tbl_provincias (id)
) ENGINE = InnoDb;


drop table if exists tbl_establecimientos;
create table if not exists tbl_establecimientos
(
    id                        int(11) auto_increment unique,
    rut_establecimiento       varchar(255) not null unique,
    nombre_establecimiento    varchar(255) not null,
    direccion_establecimiento varchar(255) not null,
    id_comuna                 int(11)      not null,
    fono_establecimiento      varchar(15)  not null,
    email_establecimiento     varchar(100) not null,
    id_imagen                 int(11)      null,
    created_at                datetime     not null,
    updated_at                datetime     not null,
    constraint pk_idEstablecimientos primary key (id),
    constraint fk_tblestablecimientos_tblcomunas foreign key (id_comuna) references tbl_comunas (id),
    constraint fk_tblestablecimientos_tblimagenes foreign key (id_imagen) references tbl_imagenes (id)
) ENGINE = InnoDb;


drop table if exists tbl_tipos_usuarios;
create table if not exists tbl_tipos_usuarios
(
    id           int(11) auto_increment unique,
    tipo_usuario varchar(255) not null,
    constraint pk_idTiposUsuarios primary key (id)
) ENGINE = InnoDb;


drop table if exists tbl_usuarios;
create table if not exists tbl_usuarios
(
    id              int(11) auto_increment unique,
    rut_usuario     varchar(255) not null,
    password        varchar(255) not null,
    id_tipo_usuario int(11)      not null,
    constraint pk_idUsuarios primary key (id),
    constraint fk_tblusuarios_tbltipousuarios foreign key (id_tipo_usuario) references tbl_tipos_usuarios (id)
) ENGINE = InnoDb;


drop table if exists tbl_especialidades;
create table if not exists tbl_especialidades
(
    id           int(11) auto_increment unique,
    especialidad varchar(255) not null,
    constraint pk_idEspecialidades primary key (id)
) ENGINE = InnoDb;


drop table if exists tbl_medicos;
create table if not exists tbl_medicos
(
    id                 int(11) auto_increment unique,
    id_medico          int(11)      not null,
    rcm_medico         varchar(255) not null,
    nombre_medico      varchar(255) not null,
    apellidos_medico   varchar(255) not null,
    direccion_medico   varchar(255) not null,
    id_establecimiento int(11)      not null,
    id_comuna          int(11)      not null,
    email_medico       varchar(255) not null,
    fono_medico        varchar(15)  not null,
    id_especialidad    int(11)      not null,
    firma_medico       varchar(255) not null,
    constraint pk_idMedicos primary key (id),
    constraint fk_tblmedicos_tblusuarios foreign key (id_medico) references tbl_usuarios (id),
    constraint fk_tblmedicos_tblcomunas foreign key (id_comuna) references tbl_comunas (id),
    constraint fk_tblmedicos_tblespecialidades foreign key (id_especialidad) references tbl_especialidades (id),
    constraint fk_tblmedicos_tblestablecimiento foreign key (id_establecimiento) references tbl_establecimientos (id)
) ENGINE = InnoDb;


drop table if exists tbl_farmacias;
create table if not exists tbl_farmacias
(
    id                 int(11) auto_increment unique,
    id_farmacia        int(11)      not null,
    nombre_farmacia    varchar(255) not null,
    direccion_farmacia varchar(255) not null,
    id_comuna          int(11)      not null,
    fono_farmacia      varchar(255) not null,
    email_farmacia     varchar(255) not null,
    id_imagen          int(11)      null,
    created_at         datetime     not null,
    updated_at         datetime     not null,
    constraint pk_idFarmacias primary key (id),
    constraint fk_tblfarmacias_tblusuarios foreign key (id_farmacia) references tbl_usuarios (id),
    constraint fk_tblfarmacias_tblcomunas foreign key (id_comuna) references tbl_comunas (id),
    constraint fk_tblfarmacias_tblimagenes foreign key (id_imagen) references tbl_imagenes (id)
) ENGINE = InnoDb;


drop table if exists tbl_pacientes;
create table if not exists tbl_pacientes
(
    id                 int(11) auto_increment unique,
    id_paciente        int(11)      not null,
    nombre_paciente    varchar(255) not null,
    apellido_paciente  varchar(255) not null,
    direccion_paciente varchar(255) not null,
    fono_paciente      varchar(255) not null,
    email_paciente     varchar(255) null,
    fecha_nacimiento   datetime     not null,
    peso               int(11)      not null,
    altura             int(11)      not null,
    id_sexo            int(11)      not null,
    id_comuna          int(11)      not null,
    created_at         datetime     not null,
    updated_at         datetime     not null,
    constraint pk_idPacientes primary key (id),
    constraint fk_tblpacientes_tblusuarios foreign key (id_paciente) references tbl_usuarios (id),
    constraint fk_tblpacientes_tblsexo foreign key (id_sexo) references tbl_sexo (id),
    constraint fk_tblpacientes_tblcomunas foreign key (id_comuna) references tbl_comunas (id)
) ENGINE = InnoDb;



drop table if exists tbl_isp;
create table if not exists tbl_isp
(
    id            int(11) auto_increment unique,
    id_isp        int(11)      not null,
    nombre_isp    varchar(255) not null,
    apellido_isp  varchar(255) not null,
    direcicon_isp varchar(255) not null,
    fono_isp      varchar(255) not null,
    email_isp     varchar(255) not null,
    id_comuna     int(11)      not null,
    created_at    datetime     not null,
    updated_at    datetime     not null,
    constraint pk_idPacientes primary key (id),
    constraint fk_tblIsp_tblusuarios foreign key (id_isp) references tbl_usuarios (id),
    constraint fk_tblIsp_tblcomunas foreign key (id_comuna) references tbl_comunas (id)
) ENGINE = InnoDb;



drop table if exists tbl_medicos_tratantes;
create table if not exists tbl_medicos_tratantes
(
    id          int(11) auto_increment unique,
    id_paciente int(11) not null,
    id_medico   int(11) not null,
    constraint pk_idMedicosTratantes primary key (id),
    constraint fk_tblmedicostratantes_tblpacientes foreign key (id_paciente) references tbl_pacientes (id),
    constraint fk_tblmedicostratantes_tblmedicos foreign key (id_medico) references tbl_medicos (id)
) ENGINE = InnoDb;


drop table if exists tbl_tipos_prescripciones;
create table if not exists tbl_tipos_prescripciones
(
    id                int(11) auto_increment unique,
    tipo_prescripcion varchar(255) not null,
    constraint pk_idTiposPrescripciones primary key (id)
) ENGINE = InnoDb;


drop table if exists tbl_farmacos;
create table if not exists tbl_farmacos
(
    id                   int(11) auto_increment unique,
    nombre_farmaco       varchar(255) not null,
    id_tipo_prescripcion int(11)      not null,
    constraint pk_idFarmacos primary key (id),
    constraint fk_tblfarmacos_tbltiposprescripciones foreign key (id_tipo_prescripcion) references tbl_tipos_prescripciones (id)
) ENGINE = InnoDb;


drop table if exists tbl_miligramos;
create table if not exists tbl_miligramos
(
    id         int(11) auto_increment unique,
    miligramo  varchar(255) not null,
    id_farmaco int(11)      not null,
    constraint pk_idMiligramos primary key (id),
    constraint fk_tblmiligramos_tblfarmacos foreign key (id_farmaco) references tbl_farmacos (id)
) ENGINE = InnoDb;


drop table if exists tbl_estado_prescripcion;
create table if not exists tbl_estado_prescripcion
(
    id     int(11) auto_increment unique,
    estado varchar(255) not null unique ,
    constraint pk_tbl_estado_prescripcion primary key (id)
) ENGINE = InnoDb;


drop table if exists tbl_prescripciones;
create table if not exists tbl_prescripciones
(
    id                   int(11) auto_increment unique,
    prescripcion_code    varchar(255) not null,
    id_paciente          int(11)      not null,
    id_medico            int(11)      not null,
    duracion_tratamiento int(11)      not null,
    id_tipo_prescripcion int(11)      not null,
    created_at           datetime     not null,
    id_estado            int(11)      not null,
    updated_at           datetime     not null,
    constraint pk_idPrescripciones primary key (id),
    constraint fk_tblprescripciones_tblpacientes foreign key (id_paciente) references tbl_pacientes (id),
    constraint fk_tblprescripciones_tblmedicos foreign key (id_medico) references tbl_medicos (id),
    constraint fk_tblprescripciones_tbltiposprescripcion foreign key (id_tipo_prescripcion) references tbl_tipos_prescripciones (id),
    constraint fk_tblprescripciones_tblEstadoPrescripcion foreign key (id_estado) references tbl_estado_prescripcion (id)
) ENGINE = InnoDb;
