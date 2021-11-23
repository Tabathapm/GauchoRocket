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
                           
 create table chequeo_medico(id_chequeo integer AUTO_INCREMENT,
							resultado varchar(10),
							id_centro_medico integer,
                            turno integer,
							primary key(id_chequeo),
							foreign key(turno) references turno(id_turno),
							foreign key(id_centro_medico) references centro_medico(id_centro_medico));                          
                           
create table equipo(id_equipo varchar(40),
					tipo varchar(20),
					primary key(id_equipo));
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
                    id_equipo varchar(40),
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
                
create table nivel_vuelo(id_nivel_vuelo integer AUTO_INCREMENT,
							num_nivel integer,
                            primary key(id_nivel_vuelo));      
                            			
create table contiene_un(id_cliente integer, 
                         id_equipo varchar(40),
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
					id_equipo varchar(40),
                    primary key(id_tour),
                    foreign key(id_equipo) references equipo(id_equipo));     
                    
create table origen(id_origen integer AUTO_INCREMENT,
					descripcion varchar(40),
                    foto varchar(20),
                    primary key(id_origen));  
                    
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
                    
/*create table vuela_hacia(id_vuelo integer ,
						 id_destino integer,
                         primary key(id_vuelo,id_destino),
                         foreign key(id_vuelo) references vuelo(id_vuelo),
                         foreign key(id_destino) references destino(id_destino)); */    
                         						
create table tipo_servicio_a_bordo(id_tipo_servicio integer AUTO_INCREMENT,
									descripcion_tipo varchar(20),
									primary key(id_tipo_servicio));    
		
create table reserva(	id_reserva integer AUTO_INCREMENT,
						hora_reserva varchar(20),
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
                            nombreAlojamiento varchar(40),
                            precio double,
                            fotoAlojamiento varchar(20),
                            primary key(id_alojamiento),
                            foreign key(id_destino) references destino(id_destino));
                            
 -- INSERT---------------------------------------------------------------------------------
 INSERT INTO empresaTarjeta(nombre)
 VALUES
 ('Visa'),
 ('Mastercard'),
 ('Naranja');
 
INSERT INTO equipo(id_equipo,tipo)
values('AA1','Aguila'),
      ('AA5','Aguila'),
      ('AA9','Aguila'),
      ('AA13','Aguila'),
      ('AA17','Aguila'),
      ('BA8','Aguilucho'),
      ('BA9','Aguilucho'),
      ('BA10','Aguilucho'),
      ('BA11','Aguilucho'),
      ('BA12','Aguilucho'),
      ('O1','Calandria'),
      ('O2','Calandria'),
      ('O6','Calandria'),
      ('O7','Calandria'),
      ('BA13','Canario'),
      ('BA14','Canario'),
      ('BA15','Canario'),
      ('BA16','Canario'),
      ('BA17','Canario'),
      ('BA4','Carancho'),
      ('BA5','Carancho'),
      ('BA6','Carancho'),
      ('BA7','Carancho'),
      ('O3','Colibri'),
      ('O4','Colibri'),
      ('O5','Colibri'),
      ('O8','Colibri'),
      ('O9','Colibri'),
      ('AA2','Condor'),
      ('AA6','Condor'),
      ('AA10','Condor'),
      ('AA14','Condor'),
      ('AA18','Condor'),
      ('AA4','Guanaco'),
      ('AA8','Guanaco'),
      ('AA12','Guanaco'),
      ('AA16','Guanaco'),
      ('AA3','Halcon'),
      ('AA7','Halcon'),
      ('AA11','Halcon'),
      ('AA15','Halcon'),
      ('AA19','Halcon'),
      ('BA1','Zorzal'),
      ('BA2','Zorzal'),
      ('BA3','Zorzal');
      
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
 
 insert into viaje(id_tipo_viaje,f_partida,horario,precio,dia,cant_vuelos,duracion,id_equipo)
values
-- LUNES
-- BA
(1,'2021/12/06','10:00 AM',2000.0,1,5,8,'O1'), 
(1,'2021/12/06','10:00 AM',2000.0,1,5,8,'O2'),
(1,'2021/12/06','10:00 AM',2000.0,1,5,8,'O3'), 
-- AK
(1,'2021/12/06','10:00 AM',2000.0,1,5,8,'O4'),
(1,'2021/12/06','10:00 AM',2000.0,1,5,8,'O5'),

-- MARTES
-- BA
(1,'2021/12/07','10:00 AM',2000.0,2,5,8,'O6'), 
(1,'2021/12/07','10:00 AM',2000.0,2,5,8,'O7'),
(1,'2021/12/07','10:00 AM',2000.0,2,5,8,'O8'),

-- AK
(1,'2021/12/07','10:00 AM',2000.0,2,5,8,'O9'),
(1,'2021/12/07','10:00 AM',2000.0,2,5,8,'O1'),

-- MIERCOLES
-- BA
(1,'2021/12/08','10:00 AM',2000.0,3,5,8,'O1'), 
(1,'2021/12/08','10:00 AM',2000.0,3,5,8,'O2'),
(1,'2021/12/08','10:00 AM',2000.0,3,5,8,'O3'), 
-- AK
(1,'2021/12/08','10:00 AM',2000.0,3,5,8,'O4'),
(1,'2021/12/08','10:00 AM',2000.0,3,5,8,'O5'),

-- JUEVES
-- BA
(1,'2021/12/09','10:00 AM',2000.0,4,5,8,'O1'), 
(1,'2021/12/09','10:00 AM',2000.0,4,5,8,'O2'),
(1,'2021/12/09','10:00 AM',2000.0,4,5,8,'O3'), 
-- AK
(1,'2021/12/09','10:00 AM',2000.0,4,5,8,'O4'),
(1,'2021/12/09','10:00 AM',2000.0,4,5,8,'O5'),

-- VIERNES
-- BA
(1,'2021/12/10','10:00 AM',2000.0,5,5,8,'O1'), 
(1,'2021/12/10','10:00 AM',2000.0,5,5,8,'O2'),
(1,'2021/12/10','10:00 AM',2000.0,5,5,8,'O3'), 
-- AK
(1,'2021/12/10','10:00 AM',2000.0,5,5,8,'O4'),
(1,'2021/12/10','10:00 AM',2000.0,5,5,8,'O5');

insert into viaje(id_tipo_viaje,f_partida,horario,precio,dia,cant_vuelos,duracion,id_equipo)
values
-- SABADO
-- BA
(1,'2021/12/06','13:00 PM',2000.0,6,8,8,'O1'), 
(1,'2021/12/06','13:00 PM',2000.0,6,8,8,'O2'),
(1,'2021/12/06','13:00 PM',2000.0,6,8,8,'O3'), 
(1,'2021/12/06','13:00 PM',2000.0,6,8,8,'O4'),
-- AK
(1,'2021/12/06','13:00 PM',2000.0,6,8,8,'O5'),
(1,'2021/12/06','13:00 PM',2000.0,6,8,8,'O6'),
(1,'2021/12/06','13:00 PM',2000.0,6,8,8,'O7'),
(1,'2021/12/06','13:00 PM',2000.0,6,8,8,'O8'),

-- DOMINGO
-- BA
(1,'2021/12/07','13:00 PM',2000.0,7,10,8,'O1'), 
(1,'2021/12/07','13:00 PM',2000.0,7,10,8,'O2'),
(1,'2021/12/07','13:00 PM',2000.0,7,10,8,'O3'),
(1,'2021/12/07','13:00 PM',2000.0,7,10,8,'O4'),
(1,'2021/12/07','13:00 PM',2000.0,7,10,8,'O5'),

-- AK
(1,'2021/12/07','13:00 PM',2000.0,7,10,8,'O6'),
(1,'2021/12/07','13:00 PM',2000.0,7,10,8,'O7'),
(1,'2021/12/07','13:00 PM',2000.0,7,10,8,'O8'),
(1,'2021/12/07','13:00 PM',2000.0,7,10,8,'O9');
 
insert into nivel_vuelo(num_nivel)
values(1),
      (2),
      (3);
      
insert into cabina(tipo)
values('General'),
	  ('Familiar'),
      ('Suite');
      
insert into tour(id_equipo)
values('AA1');
    
insert into escala()
values(),
	  (),
      ();       
      
insert into origen(descripcion,foto)
values
('Buenos Aires','BuenosAires.jpg'),
('Ankara','Ankara.jpg');      
 
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

insert into vuelo(duracion,capacidad_vuelo,id_cabina,id_nivel_vuelo,id_viaje,vuelo_origen,vuelo_destino)
values(30.00,300,1,1,1,1,3),
	  (30.00,300,2,2,1,1,4),
      (30.00,300,3,3,1,2,6),
      (26.00,120,1,1,1,2,9),
      (26.00,120,2,2,1,1,2),
      (26.00,120,3,3,1,2,5); 
      
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

insert into alojamiento(cant_habitaciones,id_destino,nombreAlojamiento,precio,fotoAlojamiento)
values(4,1,'Hotel Wanderlust', 50000.00,'alojamiento1.jpg'),
	  (3,2,'Hotel Yas',35000.0,'alojamiento2.jpg'),
      (2,2,'Hotel Yas',2000.0,'alojamiento3.jpg'),
      (4,3,'Hotel Henn na',60000.0,'alojamiento4.jpg'),
      (1,4,'Iniala Beach House',2000.0,'alojamiento1.jpg'),
      (2,4,'Iniala Beach House',4000.0,'alojamiento1.jpg'),
      (3,4,'Iniala Beach House',55000.0,'alojamiento1.jpg'),
      (4,4,'Iniala Beach House',70000.0,'alojamiento1.jpg');

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
inner join destino on alojamiento.id_destino = destino.id_destino;


									  /*UPDATE usuario
                                      SET id_tarjeta=1
                                      WHERE 
                                      id_usuario=5;*/

