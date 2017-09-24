

CREATE TABLE  tipo_listin(

	id BIGSERIAL PRIMARY KEY NOT NULL,
	descripcion character varying not null,
	status boolean ,
	created_at timestamp,
	updated_at timestamp	

);

CREATE TABLE  tipo_listin_price(

	id BIGSERIAL PRIMARY KEY NOT NULL,
	id_tipo_listin bigint not null,
	precio numeric( 12 , 2 ) not null,
	status boolean , 
	created_at timestamp,
	updated_at timestamp,

	CONSTRAINT foreign_tipo_listing_price FOREIGN KEY (id_tipo_listin)	

	REFERENCES tipo_listin( id ) on UPDATE CASCADE ON DELETE CASCADE

);

CREATE TABLE tipo_listin_jornada(

	id BIGSERIAL PRIMARY KEY NOT NULL,
    id_user bigint NOT NULL,
    description character varying DEFAULT 'Abierta'::character varying NOT NULL,
	fecha date not null,
	created_at timestamp,
	updated_at timestamp,

	CONSTRAINT foreign_key_user_listine FOREIGN KEY (id_user) REFERENCES 

	users(id) ON UPDATE CASCADE ON DELETE CASCADE

);

CREATE TABLE  tipo_listin_jornada_tipo_listin_price_date(

	id BIGSERIAL PRIMARY KEY NOT NULL,
	id_tipo_listin_jornada bigint NOT NULL,
	id_tipo_listin_price bigint NOT NULL,
	created_at timestamp,
	updated_at timestamp,

	CONSTRAINT foreign_key_listin_jornada_tipo_listin_price_date_jornada_id FOREIGN KEY ( id_tipo_listin_jornada )

	REFERENCES tipo_listin_jornada ( id ) ON DELETE CASCADE ON UPDATE CASCADE,

	CONSTRAINT foreign_key_listin_jornada_tipo_listin_price_date_tipo_listin_price_id FOREIGN KEY ( id_tipo_listin_price )

	REFERENCES tipo_listin_price ( id ) ON DELETE CASCADE ON UPDATE CASCADE

);

CREATE TABLE listin_count(

	id BIGSERIAL PRIMARY KEY NOT NULL,
	id_tipo_listin_jornada_tipo_listin_price_date BIGINT NOT NULL,
	created_at timestamp,
	updated_at timestamp,

	CONSTRAINT foreign_key_listin_count_jornadas_agregadas_bla FOREIGN KEY ( id_tipo_listin_jornada_tipo_listin_price_date )

	REFERENCES tipo_listin_jornada_tipo_listin_price_date( id ) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE  tasa_salida(

	id BIGSERIAL PRIMARY KEY NOT NULL,
	codigo_serial BIGSERIAL not null,
	precio numeric(15,2) not null,
	status boolean not null,
	created_at timestamp,
	updated_at timestamp

);


CREATE TABLE  tasa_salida_jornada(

	id BIGSERIAL PRIMARY KEY NOT NULL,
	id_tasa_salida BIGINT NOT NULL,
    id_user bigint NOT NULL,
    description character varying DEFAULT 'Abierta'::character varying NOT NULL,	
	fecha date not null,
	created_at timestamp,
	updated_at timestamp,

	CONSTRAINT conter_reference_tasa_salida_master FOREIGN KEY (id_tasa_salida) REFERENCES 

	tasa_salida (id) ON DELETE CASCADE ON UPDATE CASCADE,
	
	CONSTRAINT foreign_key_suer FOREIGN KEY (id_user) REFERENCES 

	users (id) ON UPDATE CASCADE ON DELETE CASCADE	

);


CREATE TABLE  tasa_salida_count(

	id BIGSERIAL PRIMARY KEY NOT NULL,
	id_tasa_salida_date BIGINT NOT NULL,
	created_at timestamp,
	updated_at timestamp,	
	
	CONSTRAINT count_id_tasa_salida_date FOREIGN KEY ( id_tasa_salida_date ) REFERENCES 

	tasa_salida_jornada( id ) ON UPDATE CASCADE ON DELETE CASCADE

);

/*
ESTO SE PUEDE IMPLEMENTAR LUEGO DE QUE ME LARGUE A  COLOMBIA XD 
EN REALIDAD SERIA  BIEN PERO SE NECESITA MAS O MENOS  UNOS  DOS "MESES" NO 2 semanas y media
PUSE AUQUI LES VA UN MEDIo MAPEO DE LAS TABLAS

CREATE TABLE  linee(

	id BIGSERIAL PRIMARY KEY NOT NULL,
	descripcion character varying not null,
	status boolean ,
	created_at timestamp,
	updated_at timestamp	

);

CREATE TABLE  destino(

	id BIGSERIAL PRIMARY KEY NOT NULL,
	localizacion character varying not null,
	terminal character varying not null,
	status boolean,
	created_at timestamp,
	updated_at timestamp	

);


CREATE TABLE  destino_linea(

	id BIGSERIAL PRIMARY KEY NOT NULL,
	id_destino bigint not null,
	id_linee bigint not null,
	price_viaje numeric(15,2) ,
	status boolean,
	created_at timestamp,
	updated_at timestamp,

	CONSTRAINT constraint_foreing_destino_linea_des FOREIGN KEY (id_destino) REFERENCES 

	destino ( id ) ON UPDATE CASCADE ON DELETE CASCADE ,

	CONSTRAINT constraint_foreing_destino_linea_len FOREIGN KEY ( id_linee ) REFERENCES 

	linee ( id ) ON UPDATE CASCADE ON DELETE CASCADE



);



CREATE TABLE  funcionario(

	id BIGSERIAL PRIMARY KEY NOT NULL,
	cedula character varying not null,
	apellidos character varying not null,
	nombres character varying not null,
	sexo character varying not null,
	fecha_nacimiento character varying not null,
	numero_telefono character varying not null,
	direccion character varying not null,
	created_at timestamp,
	updated_at timestamp

);


CREATE TABLE  persona_contacto(

	id BIGSERIAL PRIMARY KEY NOT NULL,
	id_line bigint not null,
	cedula character varying not null,
	nombre character varying not null,
	apellido character varying not null,
	created_at timestamp,
	updated_at timestamp,

	CONSTRAINT contacto_line FOREIGN KEY (id_line) REFERENCES linee( id )
	
	ON UPDATE CASCADE ON DELETE CASCADE

);

CREATE TABLE  listin(

	id BIGSERIAL PRIMARY KEY NOT NULL,
	id_funcionario bigint not null,
	id_destino_linea BIGINT NOT NULL,

	id_tipo_listin_price BIGINT NOT NULL,

	CONSTRAINT foreign_destino_linea_listin FOREIGN KEY (id_destino_linea) REFERENCES 

	destino_linea ( id ) ON UPDATE CASCADE ON DELETE CASCADE,

	CONSTRAINT foreign_functionario_listin FOREIGN KEY (id_funcionario) REFERENCES 

	funcionario ( id ) ON UPDATE CASCADE ON DELETE CASCADE,

	CONSTRAINT foreign_tipo_listin_price_bla FOREIGN KEY (id_tipo_listin_price) REFERENCES 

	tipo_listin_price ( id  ) ON UPDATE CASCADE ON DELETE CASCADE

);


*/
