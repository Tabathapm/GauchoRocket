create database web2;
use web2;

-- TABLAS
create table tarjeta_de_credito(id_tarjeta integer,
							    nom_tarjeta varchar(40),
                                primary key (id_tarjeta));
                                
create table centro_medico(id_centro_medico integer AUTO_INCREMENT,
					       nom_centro_medico varchar(40),
                           foto varchar(100),
                           primary key(id_centro_medico));
                           
create table usuario(id_usuario integer AUTO_INCREMENT ,
					rol_usuario varchar(15),
					nombre_usuario varchar(30),
					apellido_usuario varchar(30),
                    clave varchar(20),
                    email varchar(40),
                    id_tarjeta integer,
                    primary key(id_usuario),
                    foreign key(id_tarjeta) references tarjeta_de_credito(id_tarjeta));                           
                           
create table turno( id_turno integer AUTO_INCREMENT,
					cant_turno integer,
                    id_centro_medico integer,
                    usuario integer,
                    fecha date,
                    horario varchar(10),
                    disponible bool,
                    primary key(id_turno),
                    foreign key(usuario) references usuario(id_usuario),
                    foreign key(id_centro_medico) references centro_medico(id_centro_medico));                            
                           
 create table chequeo_medico(id_chequeo integer AUTO_INCREMENT,
							resultado varchar(10),
							id_centro_medico integer,
                            turno integer,
							primary key(id_chequeo),
							foreign key(turno) references turno(id_turno),
							foreign key(id_centro_medico) references centro_medico(id_centro_medico));                          
                           
						
/*create table se_realiza_en(id_chequeo integer,
						   id_centro_medico integer,
                           primary key(id_chequeo,id_centro_medico),
                           foreign key(id_chequeo) references chequeo_medico(id_chequeo),
                           foreign key(id_centro_medico) references centro_medico(id_centro_medico));*/
                           
                           
 
			
create table viaje(id_viaje integer AUTO_INCREMENT,
					tipo varchar(20),
					f_partida date,
					duracion double,
					primary key(id_viaje));       
         
create table pasaje(id_pasaje integer AUTO_INCREMENT,
					tarifa double,
                    cant_dias_en_espacio integer,
                    id_viaje integer,
                    primary key(id_pasaje),
                    foreign key(id_viaje) references viaje(id_viaje));     
			
create table equipo(id_equipo integer AUTO_INCREMENT,
					tipo varchar(20),
					primary key(id_equipo));       
                    
create table nivel_vuelo(id_nivel_vuelo integer AUTO_INCREMENT,
							num_nivel integer,
                            primary key(id_nivel_vuelo));       
                            
create table contiene_un(id_cliente integer, 
                         id_equipo integer,
                         id_nivel_vuelo integer,
                         primary key(id_cliente,id_equipo),
                         foreign key(id_cliente) references usuario(id_usuario),
                         foreign key(id_equipo) references equipo(id_equipo));
                         
create table cabina(id_cabina integer AUTO_INCREMENT,
					tipo varchar(20),
					primary key(id_cabina));
                    
create table escala(id_escala integer AUTO_INCREMENT,
					primary key(id_escala));
                    
create table tour(id_tour integer AUTO_INCREMENT,
					id_equipo integer,
                    primary key(id_tour),
                    foreign key(id_equipo) references equipo(id_equipo));     
                    
create table destino(id_destino integer AUTO_INCREMENT,
					descripcion varchar(40),
                    id_escala integer,
                    id_tour integer,
                    primary key(id_destino),
                    foreign key(id_escala) references escala(id_escala),
                    foreign key(id_tour) references tour(id_tour));  
                    
create table asiento(
 id_asiento integer AUTO_INCREMENT,
 fila varchar(5),
 descripcion varchar(5),
 disponible bool,
 primary key(id_asiento));  
 
create table vuelo(id_vuelo integer AUTO_INCREMENT,
					duracion double,
                    capacidad_vuelo integer,
                    id_cabina integer,
                    id_nivel_vuelo integer,
                    id_viaje integer,
                    id_asiento integer,
                    primary key(id_vuelo),
                    foreign key(id_cabina) references cabina(id_cabina),
                    foreign key(id_asiento) references asiento(id_asiento),
                    foreign key(id_nivel_vuelo) references nivel_vuelo(id_nivel_vuelo),
                    foreign key(id_viaje) references viaje(id_viaje));
                    
create table vuela_hacia(id_vuelo integer ,
						 id_destino integer,
                         primary key(id_vuelo,id_destino),
                         foreign key(id_vuelo) references vuelo(id_vuelo),
                         foreign key(id_destino) references destino(id_destino));     
                         
                         
create table tipo_servicio_a_bordo(id_tipo_servicio integer AUTO_INCREMENT,
									descripcion_tipo varchar(20),
									primary key(id_tipo_servicio));    
			
create table reserva(	id_reserva integer AUTO_INCREMENT,
						hora_reserva time,
                        id_tarjeta integer,
                        id_vuelo integer,
                        id_tipo_servicio integer,
                        id_cabina integer,
                        id_usuario integer,
                        primary key(id_reserva),
                        foreign key(id_tarjeta) references tarjeta_de_credito(id_tarjeta),
                        foreign key(id_vuelo) references vuelo(id_vuelo),
                        foreign key(id_cabina) references cabina(id_cabina),
                        foreign key(id_usuario) references usuario(id_usuario),
                        foreign key(id_tipo_servicio) references tipo_servicio_a_bordo(id_tipo_servicio));  
                        
create table lista_de_espera(id_lista_espera integer,
							horario time,
                            primary key(id_lista_espera)); 
                            
create table contiene_una(id_reserva integer,
							id_lista_espera integer,
                            primary key(id_reserva,id_lista_espera),
                            foreign key(id_reserva) references reserva(id_reserva),
                            foreign key(id_lista_espera) references lista_de_espera(id_lista_espera)); 
 
 create table alojamiento(id_alojamiento integer AUTO_INCREMENT,
							cant_habitaciones integer,
                            id_destino integer,
                            primary key(id_alojamiento),
                            foreign key(id_destino) references destino(id_destino));
 -- INSERT
 
INSERT INTO usuario (rol_usuario, clave, email, nombre_usuario, apellido_usuario)
VALUES 
('ADMIN', "202cb962ac59075b964b", 'admin1@admin.com', "Julieta", "Barraza"),
('ADMIN', "202cb962ac59075b964b", 'admin2@admin.com', "Leandro", "Martinez"),
('ADMIN', "202cb962ac59075b964b", 'admin3@admin.com', "Tabatha", "Peralta");

INSERT INTO usuario (clave, email, nombre_usuario, apellido_usuario)
VALUES(123,'lea@gmail.com','Lea','Shaila');

INSERT INTO usuario (clave, email, nombre_usuario, apellido_usuario)
VALUES 
("202cb962ac59075b964b", 'julietabarraza21@gmail.com', "Rocio", "Rodriguez");

INSERT INTO centro_medico(nom_centro_medico, foto)
VALUES
('Buenos Aires','BuenosAires.jpg'),
('Shanghai','Shanghai.jpg'),
('Ankara','Ankara.jpg');

INSERT INTO turno(cant_turno,id_centro_medico, usuario, fecha, horario, disponible)
VALUES
(300,1, null, '2021/11/10','14:30',true),
(300,1, null, '2021/11/11','15:30',true),
(300,1, null, '2021/11/12','16:30',true),
(210,2,null,'2021/11/10','14:15',true),
(210,2, null, '2021/11/11','15:15',true),
(210,2, null, '2021/11/12','16:15',true),
(200,3, null,'2021/11/10','14:00',true),
(200,3, null,'2021/11/11','15:00',true),
(200,3, null,'2021/11/12','16:00',true);

INSERT INTO turno(cant_turno,id_centro_medico, usuario, fecha, horario, disponible)
VALUES
(300,1, 1, '2021/11/13','17:30',false);

insert into viaje(tipo,f_partida,duracion)
values('orbital','2021-11-09',30.00); 

INSERT INTO viaje(tipo, f_partida, duracion)
VALUES('Suborbital','2021-12-14',18.00),
       ('Orbitales','2021-12-12',26.00);
       
insert into tipo_servicio_a_bordo(descripcion_tipo)
values
('Standard'),  
('Gourmet'),
('Spa');

insert into cabina(tipo)
values
('Familiar'),
('General'),
('Suite');

insert into asiento(fila, descripcion, disponible)
values
('A','A1',true),
('A','A2',true),
('A','A3', true), 
('A','A10', true),
('A','A11', true),
('A','A12', true),
('A','A20', true),
('A','A21', true),
('A','A22', true);

insert into asiento(fila, descripcion, disponible)
values
('B','B1',true),
('B','B2',true),
('B','B3', true), 
('B','B10', true),
('B','B11', true),
('B','B12', true),
('B','B20', true),
('B','B21', true),
('B','B22', true);

insert into asiento(fila, descripcion, disponible)
values
('C','C1',true),
('C','C2',true),
('C','C3', true), 
('C','C10', true),
('C','C11', true),
('C','C12', true),
('C','C20', true),
('C','C21', true),
('C','C22', true);

insert into asiento(fila, descripcion, disponible)
values
('D','D1',true),
('D','D2',true),
('D','D3', true), 
('D','D10', true),
('D','D11', true),
('D','D12', true),
('D','D20', true),
('D','D21', true),
('D','D22', true);

/*insert into vuelo(duracion, capacidad_vuelo, id_cabina, id_nivel_vuelo, id_viaje, id_asiento)
values
();*/

-- CONSULTAS

SELECT * 
FROM usuario;

delete from usuario
where id_usuario is null;

SELECT *
FROM usuario
WHERE clave = 123;

SELECT md5(123), email
FROM usuario;

SELECT nombre_usuario
FROM usuario
WHERE clave = "202cb962ac59075b964b";

select * from usuario;

select * from reserva;

select * from viaje;
select * from turno;

SELECT resultado FROM chequeo_medico cm
INNER JOIN turno t
ON cm.turno= t.id_turno
WHERE t.usuario =1;
       
select * from vuelo;

select * from chequeo_medico;
