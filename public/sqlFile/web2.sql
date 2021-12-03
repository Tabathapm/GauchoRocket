create database web2;
use web2;

-- TABLAS----------------------------------------------------------------------------------
create table empresaTarjeta(
id integer AUTO_INCREMENT,
nombre varchar(15),
primary key (id));

create table tarjeta_de_credito(id_tarjeta integer AUTO_INCREMENT,
								nro_tarjeta integer,
                                titular varchar(20),
                                vencimientoMes integer,
                                vencimientoAno integer,
							    nom_tarjeta integer,
                                cod_seguridad integer,
                                primary key (id_tarjeta),
								foreign key(nom_tarjeta) references empresaTarjeta(id));
                                
create table centro_medico(id_centro_medico integer AUTO_INCREMENT,
					       nom_centro_medico varchar(40),
                           foto varchar(100),
                           primary key(id_centro_medico));
                           
create table usuario(id_usuario integer AUTO_INCREMENT ,
					rol_usuario varchar(15),
					nombre_usuario varchar(30),
					apellido_usuario varchar(30),
                    clave varchar(32),
                    email varchar(40),
                    hash varchar(32) NOT NULL DEFAULT '0',
                    activo integer(1) NOT NULL DEFAULT '0',
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
                    
create table nivel_vuelo(id_nivel_vuelo integer AUTO_INCREMENT,
							num_nivel integer,
                            primary key(id_nivel_vuelo));     
                            
 create table chequeo_medico(id_chequeo integer AUTO_INCREMENT,
							resultadoNivelVuelo integer,
							id_centro_medico integer,
                            turno integer,
							primary key(id_chequeo),
                            foreign key(resultadoNivelVuelo) references nivel_vuelo(id_nivel_vuelo),
							foreign key(turno) references turno(id_turno),
							foreign key(id_centro_medico) references centro_medico(id_centro_medico)); 
                            
 create table tipo_equipo(
 id_tipo_equipo integer AUTO_INCREMENT,
 tipo varchar(30),
 primary key(id_tipo_equipo)); 
 
create table equipo(id_equipo integer AUTO_INCREMENT,
					 tipo_equipo integer,
					 nombre_equipo varchar(20),
                     capacidad integer,
					 primary key(id_equipo),
					 foreign key(tipo_equipo) references tipo_equipo(id_tipo_equipo));
                     
create table modelo_equipo(id_tipo_equipo integer AUTO_INCREMENT,
							matricula varchar(20),
							equipo integer,
							primary key(id_tipo_equipo),
							foreign key(equipo) references equipo(id_equipo));                  
create table dia(
id_dia integer AUTO_INCREMENT,
descripcion varchar(10),
primary key(id_dia));

create table tipo_viaje(
id_tipo_viaje integer AUTO_INCREMENT,
tipo varchar(20),
primary key(id_tipo_viaje));
                    
create table viaje(id_viaje integer AUTO_INCREMENT,
					id_tipo_viaje integer,
					f_partida date,
                    horario varchar(20),
                    precio double,
                    dia integer,
                    cant_vuelos integer,
					duracion double,
                    id_equipo integer,
                    pagado bool,
                    disponible bool,
					primary key(id_viaje),
                    foreign key(dia) references dia(id_dia),
					foreign key(id_tipo_viaje) references tipo_viaje(id_tipo_viaje),
					foreign key(id_equipo) references equipo(id_equipo));
                    

create table pasaje(id_pasaje integer AUTO_INCREMENT,
					tarifa double,
                    cant_dias_en_espacio integer,
                    id_viaje integer,
                    primary key(id_pasaje),
                    foreign key(id_viaje) references viaje(id_viaje));     
						
create table contiene_un(id_cliente integer, 
                         id_equipo integer,
                         id_nivel_vuelo integer,
                         primary key(id_cliente,id_equipo),
                         foreign key(id_cliente) references usuario(id_usuario),
                         foreign key(id_equipo) references equipo(id_equipo));

create table cabina(id_cabina integer AUTO_INCREMENT,
					tipo varchar(20),
					primary key(id_cabina));
                    
 create table equipo_tipo_cabina(equipo integer,
								tipo_cabina integer,
                                capacidad_cabina integer,
								 nivel_vuelo integer,
								 primary key(equipo,tipo_cabina, nivel_vuelo),
                                 foreign key(equipo) references equipo(id_equipo),
								 foreign key(tipo_cabina) references cabina(id_cabina),
								 foreign key(nivel_vuelo) references nivel_vuelo(id_nivel_vuelo));
 
                    
create table escala(id_escala integer AUTO_INCREMENT,
					primary key(id_escala));
                    
create table origen(id_origen integer AUTO_INCREMENT,
					descripcion varchar(40),
                    foto varchar(20),
                    primary key(id_origen));                   
                    
create table tour(id_tour integer AUTO_INCREMENT,
					id_equipo integer,
                    dia integer,
                    duracion varchar(10),
                    partida integer,
                    primary key(id_tour),
                    foreign key(id_equipo) references equipo(id_equipo),
                    foreign key(dia) references dia(id_dia),
                    foreign key(partida) references origen(id_origen));   
                  
create table destino(id_destino integer AUTO_INCREMENT,
					descripcion varchar(40),
                    foto varchar(20),
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
                    vuelo_origen integer,
                    vuelo_destino integer,
                    primary key(id_vuelo),
                    foreign key(id_cabina) references cabina(id_cabina),
                    foreign key(id_asiento) references asiento(id_asiento),
                    foreign key(vuelo_origen) references origen(id_origen),
                    foreign key(vuelo_destino) references destino(id_destino),
                    foreign key(id_nivel_vuelo) references nivel_vuelo(id_nivel_vuelo),
                    foreign key(id_viaje) references viaje(id_viaje));
									
create table tipo_servicio_a_bordo(id_tipo_servicio integer AUTO_INCREMENT,
									descripcion_tipo varchar(20),
									primary key(id_tipo_servicio));    
                                    
                                     create table alojamiento(id_alojamiento integer AUTO_INCREMENT,
							cant_habitaciones integer,
                            id_destino integer,
                            nombreAlojamiento varchar(40),
                            precio double,
                            fotoAlojamiento varchar(20),
                            disponible bool,
                            primary key(id_alojamiento),
                            foreign key(id_destino) references destino(id_destino));
		
create table reserva(	id_reserva integer AUTO_INCREMENT,
						hora_reserva varchar(20),
                        id_vuelo integer,
                        id_tipo_servicio integer,
                        id_cabina integer,
                        id_usuario integer,
                        id_alojamiento integer,
                        id_viaje integer,
                        pagado bool,
                        primary key(id_reserva),
                        foreign key(id_vuelo) references vuelo(id_vuelo),
                        foreign key(id_cabina) references cabina(id_cabina),
                        foreign key(id_usuario) references usuario(id_usuario),
                        foreign key(id_tipo_servicio) references tipo_servicio_a_bordo(id_tipo_servicio),
                        foreign key(id_alojamiento) references alojamiento(id_alojamiento),
                        foreign key(id_viaje) references viaje(id_viaje));  
                        
create table lista_de_espera(id_lista_espera integer,
							horario time,
                            primary key(id_lista_espera)); 
                            
create table contiene_una(id_reserva integer,
							id_lista_espera integer,
                            primary key(id_reserva,id_lista_espera),
                            foreign key(id_reserva) references reserva(id_reserva),
                            foreign key(id_lista_espera) references lista_de_espera(id_lista_espera)); 
 
                            
 -- INSERT---------------------------------------------------------------------------------
 INSERT INTO empresaTarjeta(nombre)
 VALUES
 ('Visa'),
 ('Mastercard'),
 ('Naranja');
 
 insert into tipo_equipo(tipo)
 values
 ('Orbital'),
 ('Alta Aceleracion'),
 ('Baja Aceleracion');
 
insert into equipo(tipo_equipo,nombre_equipo,capacidad)
values
(1,'Calandria', 300),
(1,'Colibri', 120),
(3, 'Zorzal', 100),
(3, 'Carancho', 110),
(3, 'Aguilucho', 60),
(3, 'Canario', 80),
(2, 'Aguila', 300),
(2, 'Condor', 350),
(2, 'Halcon', 200),
(2, 'Guanaco', 100);

INSERT INTO modelo_equipo(matricula, equipo)
values('AA1',7),
      ('AA5',7),
      ('AA9',7),
      ('AA13',7),
      ('AA17',7),
      ('BA8',5),
      ('BA9',5),
      ('BA10',5),
      ('BA11',5),
      ('BA12',5),
      ('O1',1),
      ('O2',1),
      ('O6',1),
      ('O7',1),
      ('BA13',6),
      ('BA14',6),
      ('BA15',6),
      ('BA16',6),
      ('BA17',6),
      ('BA4',4),
      ('BA5',4),
      ('BA6',4),
      ('BA7',4),
      ('O3',2),
      ('O4',2),
      ('O5',2),
      ('O8',2),
      ('O9',2),
      ('AA2',8),
      ('AA6',8),
      ('AA10',8),
      ('AA14',8),
      ('AA18',8),
      ('AA4',10),
      ('AA8',10),
      ('AA12',10),
      ('AA16',10),
      ('AA3',9),
      ('AA7',9),
      ('AA11',9),
      ('AA15',9),
      ('AA19',9),
      ('BA1',3),
      ('BA2',3),
      ('BA3',3);
      
insert into nivel_vuelo(num_nivel)
values(1),
      (2),
      (3); 
      
insert into cabina(tipo)
values('General'),
	  ('Familiar'),
      ('Suite');  
      
insert into equipo_tipo_cabina(equipo,tipo_cabina, capacidad_cabina, nivel_vuelo)
values
-- equipo 1
(1,1,200,1),
(1,1,200,2),
(1,1,200,3),
(1,2,75,1),
(1,2,75,2),
(1,2,75,3),
(1,3,25,1),
(1,3,25,2),
(1,3,25,3),
-- equipo 2
(2,1,100,1),
(2,1,100,2),
(2,1,100,3),
(2,2,18,1),
(2,2,18,2),
(2,2,18,3),
(2,3,2,1),
(2,3,2,2),
(2,3,2,3),
-- equipo 3
(3,1,50,2),
(3,1,50,3),
(3,3,50,2),
(3,3,50,3),
-- equipo 4
(4,1,110,2),
(4,1,110,3),
-- equipo 5
(5,2,50,2),
(5,2,50,3),
(5,3,10,2),
(5,3,10,3),
-- equipo 6
(6,2,70,2),
(6,2,70,3),
(6,3,10,2),
(6,3,10,3),
-- equipo 7
(7,1,200,2),
(7,2,75,2),
(7,3,25,2),
(7,1,200,3),
(7,2,75,3),
(7,3,25,3),
-- equipo 8
(8,1,300,2),
(8,1,300,3),
(8,2,10,2),
(8,2,10,3),
(8,3,40,2),
(8,3,40,3),
-- equipo 9
(9,1,150,3),
(9,2,25,3),
(9,3,25,3),
-- equipo 10
(10,3,100,3);
    
 insert into tipo_viaje(tipo)
 values
 ('Suborbitales'),
 ('Orbitales'),
 ('Entre destinos');
 
 insert into dia(descripcion)
 values
 ('Lunes'),
 ('Martes'),
 ('Miercoles'),
 ('Jueves'),
 ('Viernes'),
 ('Sabado'),
 ('Domingo');
 
 insert into viaje(id_tipo_viaje,f_partida,horario,precio,dia,cant_vuelos,duracion,id_equipo, disponible)
values
-- LUNES
-- BA
(1,'2021/12/06','10:00 AM',2000.0,1,5,8,1,true), 
(1,'2021/12/06','10:45 AM',2000.0,1,5,8,1,true),
(1,'2021/12/06','12:00 PM',2000.0,1,5,8,6,true), 
-- AK
(1,'2021/12/06','03:30 PM',2000.0,1,5,8,6,true),
(1,'2021/12/06','07:00 PM',2000.0,1,5,8,6,true),

-- MARTES
-- BA
(1,'2021/12/07','10:20 AM',2000.0,2,5,8,1,true), 
(1,'2021/12/07','11:15 AM',2000.0,2,5,8,1,true),
(1,'2021/12/07','03:50 PM',2000.0,2,5,8,6,true),

-- AK
(1,'2021/12/07','06:00 PM',2000.0,2,5,8,6,true),
(1,'2021/12/07','08:00 PM',2000.0,2,5,8,1,true),

-- MIERCOLES
-- BA
(1,'2021/12/08','10:00 AM',2000.0,3,5,8,1,true), 
(1,'2021/12/08','07:30 AM',2000.0,3,5,8,1,true),
(1,'2021/12/08','11:00 AM',2000.0,3,5,8,6,true), 
-- AK
(1,'2021/12/08','01:00 PM',2000.0,3,5,8,6,true),
(1,'2021/12/08','06:15 PM',2000.0,3,5,8,6,true),

-- JUEVES
-- BA
(1,'2021/12/09','10:00 AM',2000.0,4,5,8,1,true), 
(1,'2021/12/09','11:00 AM',2000.0,4,5,8,1,true),
(1,'2021/12/09','03:00 PM',2000.0,4,5,8,6,true), 
-- AK
(1,'2021/12/09','10:00 AM',2000.0,4,5,8,6,true),
(1,'2021/12/09','11:15 AM',2000.0,4,5,8,6,true),

-- VIERNES
-- BA
(1,'2021/12/10','10:00 AM',2000.0,5,5,8,1,true), 
(1,'2021/12/10','10:50 AM',2000.0,5,5,8,1,true),
(1,'2021/12/10','11:45 AM',2000.0,5,5,8,6,true), 
-- AK
(1,'2021/12/10','02:00 PM',2000.0,5,5,8,6,true),
(1,'2021/12/10','07:00 PM',2000.0,5,5,8,6,true);

insert into viaje(id_tipo_viaje,f_partida,horario,precio,dia,cant_vuelos,duracion,id_equipo, disponible)
values
-- SABADO
-- BA
(1,'2021/12/06','01:00 PM',2000.0,6,8,8,1,true), 
(1,'2021/12/06','03:00 PM',2000.0,6,8,8,1,true),
(1,'2021/12/06','01:00 PM',2000.0,6,8,8,6,true), 
(1,'2021/12/06','03:00 PM',2000.0,6,8,8,6,true),
-- AK
(1,'2021/12/06','01:00 PM',2000.0,6,8,8,6,true),
(1,'2021/12/06','03:00 PM',2000.0,6,8,8,1,true),
(1,'2021/12/06','01:00 PM',2000.0,6,8,8,1,true),
(1,'2021/12/06','03:00 PM',2000.0,6,8,8,6,true),

-- DOMINGO
-- BA
(1,'2021/12/07','01:00 PM',2000.0,7,10,8,1,true), 
(1,'2021/12/07','03:00 PM',2000.0,7,10,8,1,true),
(1,'2021/12/07','01:00 PM',2000.0,7,10,8,6,true),
(1,'2021/12/07','03:00 PM',2000.0,7,10,8,6,true),
(1,'2021/12/07','03:15 PM',2000.0,7,10,8,6,true),

-- AK
(1,'2021/12/07','01:00 PM',2000.0,7,10,8,1,true),
(1,'2021/12/07','03:00 PM',2000.0,7,10,8,1,true),
(1,'2021/12/07','01:00 PM',2000.0,7,10,8,6,true),
(1,'2021/12/07','03:00 PM',2000.0,7,10,8,6,true);


insert into escala()
values(),
	  (),
      ();       
      
insert into origen(descripcion,foto)
values
('Buenos Aires','BuenosAires.jpg'),
('Ankara','Ankara.jpg');  

insert into tour(id_equipo,dia,duracion, partida)
values
(10,7,'35 días',1);
 
insert into destino(descripcion,foto,id_escala,id_tour)
values
('Estacion Espacial Internacional','eei.jpg',null,null),
('OrbitelHotel','orbitel-hotel.jpg',null,null),
('Luna','luna.jpg',1,1),
('Marte','marte.jpg',2,null),
('Ganimedes','ganimedes.jpg',null,null),
('Europa','europa.jpg',3,1),
('Io','io.jpg',null,null),
('Titan','titan.jpg',null,null),
('Encedalo','encedalo.jpg',null,null);

insert into asiento(fila, descripcion, disponible)
values
-- OrbitelHotel
('A','A1',true),
('A','A2',true),
('A','A3', true),
('B','B1',true),
('B','B2',true),
('B','B3', true), 
('C','C1',true),
('C','C2',true),
('C','C3', true),
('D','D1',true),
('D','D2',true),
('D','D3', true); 

insert into asiento(fila, descripcion, disponible)
values
-- Luna
('A','A10', true),
('A','A11', true),
('A','A12', true),
('B','B10', true),
('B','B11', true),
('B','B12', true),
('C','C10', true),
('C','C11', true),
('C','C12', true),
('D','D10', true),
('D','D11', true),
('D','D12', true);

insert into asiento(fila, descripcion, disponible)
values
-- Marte
('A','A20', false),
('A','A21', false),
('A','A22', false),
('B','B20', false),
('B','B21', false),
('B','B22', false),
('C','C20', false),
('C','C21', false),
('C','C22', false),
('D','D20', false),
('D','D21', false),
('D','D22', false);

insert into asiento(fila, descripcion, disponible)
values
-- Ganimedes
('A','A30', true),
('A','A31', true),
('A','A32', true),
('B','B30', true),
('B','B31', true),
('B','B32', true),
('C','C30', true),
('C','C31', true),
('C','C32', true),
('D','D30', true),
('D','D31', true),
('D','D32', true);

insert into vuelo(duracion,capacidad_vuelo,id_cabina,id_nivel_vuelo,id_viaje,id_asiento,vuelo_origen,vuelo_destino)
values
-- luna
(30.00,300,1,1,1,13,1,3),
(30.00,300,1,1,2,14,1,3),
(30.00,300,1,1,6,15,1,3),
(30.00,300,1,1,14,16,1,3),
(30.00,300,1,1,18,17,1,3),
(30.00,300,1,1,3,18,1,3),
(30.00,300,1,1,40,19,1,3),
(30.00,300,1,1,41,20,1,3),
(30.00,300,1,1,13,21,1,3),
(30.00,300,1,1,3,22,1,3),
(30.00,300,1,1,31,23,1,3),
(30.00,300,1,1,15,24,1,3),

-- marte
(30.00,300,2,2,1,25,1,4),
(30.00,300,2,2,5,26,1,4),
(30.00,300,2,2,7,27,1,4),
(30.00,300,2,2,23,28,1,4),
(30.00,300,2,2,24,29,1,4),
(30.00,300,2,2,23,30,1,4),
(30.00,300,2,2,6,31,1,4),
(30.00,300,2,2,31,32,1,4),
(30.00,300,2,2,9,33,1,4),
(30.00,300,2,2,3,34,1,4),
(30.00,300,2,2,8,35,1,4),
(30.00,300,2,2,42,36,1,4),

(30.00,300,3,3,1,null,2,6),
(26.00,120,1,1,1,null,2,9),

-- orbitel hotel
(26.00,120,2,2,5,1,1,2),
(26.00,120,2,2,8,2,1,2),
(26.00,120,2,2,1,3,1,2),
(26.00,120,2,2,6,4,1,2),
(26.00,120,2,2,34,5,1,2),
(26.00,120,2,2,28,6,1,2),
(26.00,120,2,2,30,7,1,2),
(26.00,120,2,2,17,8,1,2),
(26.00,120,2,2,29,9,1,2),
(26.00,120,2,2,22,10,1,2),
(26.00,120,2,2,31,11,1,2),
(26.00,120,2,2,20,12,1,2),
-- gaminedes
(26.00,120,3,3,18,37,2,5), 
(26.00,120,3,3,14,38,2,5), 
(26.00,120,3,3,12,39,2,5), 
(26.00,120,3,3,10,40,2,5), 
(26.00,120,3,3,21,41,2,5), 
(26.00,120,3,3,31,42,2,5), 
(26.00,120,3,3,19,43,2,5), 
(26.00,120,3,3,41,44,2,5), 
(26.00,120,3,3,34,45,2,5), 
(26.00,120,3,3,25,46,2,5), 
(26.00,120,3,3,5,47,2,5),
(26.00,120,3,3,10,48,2,5);
      
INSERT INTO usuario (rol_usuario, clave, email, nombre_usuario, apellido_usuario, activo)
VALUES 
('ADMIN', "202cb962ac59075b964b", 'admin1@admin.com', "Julieta", "Barraza", 1),
('ADMIN', "202cb962ac59075b964b", 'admin2@admin.com', "Leandro", "Martinez", 1),
('ADMIN', "202cb962ac59075b964b", 'admin3@admin.com', "Tabatha", "Peralta", 1);

insert into usuario(clave,email,nombre_usuario,apellido_usuario, activo)
values("202cb962ac59075b964b",'warhead.soad@gmail.com',"Lea","Shaila",1);

INSERT INTO usuario (clave, email, nombre_usuario, apellido_usuario, activo)
VALUES 
("202cb962ac59075b964b", 'julietabarraza21@gmail.com', "Rocio", "Rodriguez",1);

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
(210,2, null,'2021/11/10','14:15',true),
(210,2, null, '2021/11/11','15:15',true),
(210,2, null, '2021/11/12','16:15',true),
(200,3, null,'2021/11/10','14:00',true),
(200,3, null,'2021/11/11','15:00',true),
(200,3, null,'2021/11/12','16:00',true);

INSERT INTO turno(cant_turno,id_centro_medico, usuario, fecha, horario, disponible)
VALUES
(300,1, 1, '2021/11/13','17:30',false);
   
insert into tipo_servicio_a_bordo(descripcion_tipo)
values
('Standard'),  
('Gourmet'),
('Spa');

insert into alojamiento(cant_habitaciones,id_destino,nombreAlojamiento,precio,fotoAlojamiento, disponible)
values(4,1,'Hotel Wanderlust', 50000.00,'alojamiento1.jpg', true),
	  (3,2,'Hotel Yas',35000.0,'alojamiento2.jpg', true),
      (2,2,'Hotel Yas',2000.0,'alojamiento3.jpg', true),
      (4,3,'Hotel Henn na',60000.0,'alojamiento4.jpg', true),
      (1,4,'Iniala Beach House',2000.0,'alojamiento1.jpg', true),
      (2,4,'Iniala Beach House',4000.0,'alojamiento1.jpg', true),
      (3,4,'Iniala Beach House',55000.0,'alojamiento1.jpg', true),
      (4,4,'Iniala Beach House',70000.0,'alojamiento1.jpg',true);

-- CONSULTAS-------------------------------------------------------------------------

/*SELECT * 
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

select * from vuelo; */
            
-- select * from equipo;
      
/*select * from escala; */

  /*select * from alojamiento;
  
  select * 
  from equipo
  inner join tour on equipo.id_equipo = tour.id_equipo
  inner join destino on tour.id_tour = destino.id_tour
  inner join escala on destino.id_escala = escala.id_escala
  inner join alojamiento on destino.id_destino = alojamiento.id_destino;
  
select * from alojamiento;

select * from alojamiento
where cant_habitaciones = 4;

select * from tour;
select * from equipo;

select * from viaje;
select * from vuelo;*/

/*insert into vuela_hacia(id_vuelo,id_destino)
values(); */
  
/*select * from chequeo_medico;*/

select * from reserva;

/*select * from viaje;

SELECT vuelo_origen from vuelo;


select * from vuelo;
select * from destino;

select * from vuelo
inner join viaje on vuelo.id_viaje = viaje.id_viaje; */

select * from usuario;
select * from tarjeta_de_credito;

select distinct nombreAlojamiento
from alojamiento;

select * from alojamiento
inner join destino on alojamiento.id_destino = destino.id_destino
WHERE cant_habitaciones = 4;

/*UPDATE usuario
SET id_tarjeta=1
WHERE 
id_usuario=5;*/

SELECT *
FROM alojamiento
INNER JOIN destino
ON alojamiento.id_destino = destino.id_destino
WHERE destino.id_destino = 4 AND cant_habitaciones = 4;

SELECT *, DATE_FORMAT(f_partida, '%d/%m/%Y') AS 'fechaDeViaje', origen.descripcion AS 'Origen', destino.descripcion AS 'Destino'
FROM origen
INNER JOIN vuelo
ON origen.id_origen = vuelo.vuelo_origen
INNER JOIN destino
ON destino.id_destino = vuelo.vuelo_destino
INNER  JOIN viaje
ON vuelo.id_viaje = viaje.id_viaje
INNER JOIN tipo_viaje
ON viaje.id_tipo_viaje = tipo_viaje.id_tipo_viaje;

/*UPDATE alojamiento 
SET usuario = 6,
disponible = false
WHERE idAlojamiento = 5;*/

select * from alojamiento;

select * from reserva;


select * from reserva 
inner join alojamiento on reserva.id_reserva = alojamiento.id_alojamiento
where reserva.id_usuario = 2;

select * from reserva;

select origen.descripcion as origen , destino.descripcion as destino, tipo_viaje.tipo as tipoViaje, viaje.f_partida as fecha, viaje.horario as horario, viaje.precio as precio from reserva 
                                        inner join alojamiento on reserva.id_alojamiento = alojamiento.id_alojamiento
                                        inner join viaje on reserva.id_viaje = viaje.id_viaje
                                        inner join vuelo on reserva.id_vuelo = vuelo.id_vuelo
                                        inner join origen on vuelo.vuelo_origen = origen.id_origen
                                        inner join destino on vuelo.vuelo_destino = destino.id_destino
                                        inner join tipo_viaje on viaje.id_tipo_viaje = tipo_viaje.id_tipo_viaje;
               
               
               