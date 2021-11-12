create database web2;
use web2;

create table tarjeta_de_credito(id_tarjeta integer,
							    nom_tarjeta varchar(40),
                                primary key (id_tarjeta));
                                
create table centro_medico(id_centro_medico integer AUTO_INCREMENT,
					       nom_centro_medico varchar(40),
                           foto varchar(100),
                           primary key(id_centro_medico));   
                           
create table chequeo_medico(id_chequeo integer AUTO_INCREMENT,
							primary key(id_chequeo));  
                            
create table se_realiza_en(id_chequeo integer,
						   id_centro_medico integer,
                           primary key(id_chequeo,id_centro_medico),
                           foreign key(id_chequeo) references chequeo_medico(id_chequeo),
                           foreign key(id_centro_medico) references centro_medico(id_centro_medico));
                           
                           
create table usuario(id_usuario integer AUTO_INCREMENT ,
					rol_usuario varchar(15),
					nombre_usuario varchar(30),
					apellido_usuario varchar(30),
                    clave varchar(20),
                    email varchar(40),
                    id_chequeo integer,
                    id_tarjeta integer,
                    primary key(id_usuario),
                    foreign key(id_chequeo) references chequeo_medico(id_chequeo),
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
                    
create table viaje(id_viaje integer AUTO_INCREMENT,
					tipo varchar(20),
					f_partida date,
					duracion double,
					primary key(id_viaje));       
                    
insert into viaje(tipo,f_partida,duracion)
values('orbital','2021-11-09',30.00);                    
                  
                    
                    
create table pasaje(id_pasaje integer AUTO_INCREMENT,
					tarifa double,
                    cant_dias_en_espacio integer,
                    id_viaje integer,
                    primary key(id_pasaje),
                    foreign key(id_viaje) references viaje(id_viaje));     
                    
                
			
create table equipo(id_equipo varchar(40),
					tipo varchar(20),
					primary key(id_equipo));       
                    
                   
                    
create table nivel_vuelo(id_nivel_vuelo integer AUTO_INCREMENT,
							num_nivel integer,
                            primary key(id_nivel_vuelo));      
                            
insert into nivel_vuelo(num_nivel)
values(1),
      (2),
      (3);
      select * from nivel_vuelo;
                            
create table contiene_un(id_cliente integer, 
                         id_equipo varchar(40),
                         id_nivel_vuelo integer,
                         primary key(id_cliente,id_equipo),
                         foreign key(id_cliente) references usuario(id_usuario),
                         foreign key(id_equipo) references equipo(id_equipo));
                         
create table cabina(id_cabina integer AUTO_INCREMENT,
					tipo varchar(20),
					primary key(id_cabina));
                    
   insert into cabina(tipo)
   values('General'),
         ('Familiar'),
         ('Suite');
                    select * from cabina;
create table escala(id_escala integer AUTO_INCREMENT,
					primary key(id_escala));
                    
create table tour(id_tour integer AUTO_INCREMENT,
					id_equipo varchar(40),
                    primary key(id_tour),
                    foreign key(id_equipo) references equipo(id_equipo));     
                    
create table destino(id_destino integer AUTO_INCREMENT,
					descripcion varchar(40),
                    id_escala integer,
                    id_tour integer,
                    primary key(id_destino),
                    foreign key(id_escala) references escala(id_escala),
                    foreign key(id_tour) references tour(id_tour));     
                    
create table vuelo(id_vuelo integer AUTO_INCREMENT,
					duracion double,
                    capacidad_vuelo integer,
                    id_cabina integer,
                    id_nivel_vuelo integer,
                    id_viaje integer,
                    primary key(id_vuelo),
                    foreign key(id_cabina) references cabina(id_cabina),
                    foreign key(id_nivel_vuelo) references nivel_vuelo(id_nivel_vuelo),
                    foreign key(id_viaje) references viaje(id_viaje));
                    
insert into vuelo(duracion,capacidad_vuelo,id_cabina,id_nivel_vuelo,id_viaje)
values(30.00,300,1,1,1),
	  (30.00,300,2,2,1),
      (30.00,300,3,3,1),
      (26.00,120,1,1,101),
      (26.00,120,2,2,101),
      (26.00,120,3,3,101); 
      
      
                    
create table vuela_hacia(id_vuelo integer ,
						 id_destino integer,
                         primary key(id_vuelo,id_destino),
                         foreign key(id_vuelo) references vuelo(id_vuelo),
                         foreign key(id_destino) references destino(id_destino));     
                         
                         
create table tipo_servicio_a_bordo(id_tipo_servicio integer,
									descripcion_tipo varchar(20),
									primary key(id_tipo_servicio));    
			
create table reserva(id_reserva integer AUTO_INCREMENT,
						hora_reserva time,
                        id_tarjeta integer,
                        id_vuelo integer,
                        id_tipo_servicio integer,
                        primary key(id_reserva),
                        foreign key(id_tarjeta) references tarjeta_de_credito(id_tarjeta),
                        foreign key(id_vuelo) references vuelo(id_vuelo),
                        foreign key(id_tipo_servicio) references tipo_servicio_a_bordo(id_tipo_servicio));  
                        
create table lista_de_espera(id_lista_espera integer,
							horario time,
                            primary key(id_lista_espera)); 
                            
create table contiene_una(id_reserva integer,
							id_lista_espera integer,
                            primary key(id_reserva,id_lista_espera),
                            foreign key(id_reserva) references reserva(id_reserva),
                            foreign key(id_lista_espera) references lista_de_espera(id_lista_espera));                            
                    
INSERT INTO usuario (rol_usuario, clave, email, nombre_usuario, apellido_usuario)
VALUES 
('ADMIN', "202cb962ac59075b964b", 'admin1@admin.com', "Julieta", "Barraza"),
('ADMIN', "202cb962ac59075b964b", 'admin2@admin.com', "Leandro", "Martinez"),
('ADMIN', "202cb962ac59075b964b", 'admin3@admin.com', "Tabatha", "Peralta");


INSERT INTO centro_medico(nom_centro_medico, foto)
VALUES
('Buenos Aires','BuenosAires.jpg'),
('Shanghai','Shanghai.jpg'),
('Ankara','Ankara.jpg');

SELECT * FROM centro_medico;

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

USE web2;

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


INSERT INTO usuario (rol_usuario, clave, email, nombre_usuario, apellido_usuario)
VALUES('Cliente',123,'lea@gmail.com','Lea','Shaila');

select * from usuario;

select * from reserva;

INSERT INTO viaje(id_viaje, tipo, f_partida, duracion)
VALUES(100,'Suborbital','2021-12-14',18.00),
       (101,'Orbitales','2021-12-12',26.00);
       
select * from viaje;
       
select * from vuelo;

create table alojamiento(id_alojamiento integer AUTO_INCREMENT,
							cant_habitaciones integer,
                            id_destino integer,
                            primary key(id_alojamiento),
                            foreign key(id_destino) references destino(id_destino));
                            
                            
                
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
      
      select * from equipo;
      
	insert into tour(id_equipo)
    values('AA1');
    
   insert into escala()
   values();
   
select * from escala;

  insert into destino(descripcion,id_escala,id_tour)
   values('Luna',1,1);
   
  
  insert into alojamiento(cant_habitaciones,id_destino)
  values(4,1);
  
  select * from alojamiento;
  
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


select * from viaje;
select * from vuelo;

insert into vuela_hacia(id_vuelo,id_destino)
values()
  