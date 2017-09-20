

CREATE TABLE tasa_salida(

	id BIGSERIAL NOT NULL PRIMARY KEY ,
	codigo character varying not null,
	precio_tasa Money not null,
	fecha_registro date not null

);


CREATE TABLE destino (
	
	id BIGSERIAL not null Primary Key,
	localizacion caracter varying not null,
	precio money not null,

);

CREATE TABLE linea (

	id BIGSERIAL Primary KEY not null ,
	nombre character variyng not null,

);

create table tipo_listin(

	id serial primary key,
	descripcion character varying not null

);

create table pasajeros(

	id serial primary key,
	cedula character varying not null ,
	nombre character varying not null ,
	apellido character varying not null 

);