create database web2;
use web2;

create table tarjeta_de_credito(id_tarjeta integer,
							    nom_tarjeta varchar(40),
                                primary key (id_tarjeta));
                                
create table centro_medico(id_centro_medico integer,
					       nom_centro_medico varchar(40),
                           primary key(id_centro_medico));   
                           
create table chequeo_medico(id_chequeo integer,
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
                    
                   
create table turno(id_turno integer,
					cant_turno integer,
                    id_centro_medico integer,
                    primary key(id_turno),
                    foreign key(id_centro_medico) references centro_medico(id_centro_medico));  
                    
create table viaje(id_viaje integer,
					tipo varchar(20),
					f_partida date,
					duracion double,
					primary key(id_viaje));       
                    
create table pasaje(id_pasaje integer,
					tarifa double,
                    cant_dias_en_espacio integer,
                    id_viaje integer,
                    primary key(id_pasaje),
                    foreign key(id_viaje) references viaje(id_viaje));     
			
create table equipo(id_equipo integer,
					tipo varchar(20),
					primary key(id_equipo));       
                    
create table nivel_vuelo(id_nivel_vuelo integer,
							num_nivel integer,
                            primary key(id_nivel_vuelo));       
                            
create table contiene_un(id_cliente integer, 
                         id_equipo integer,
                         id_nivel_vuelo integer,
                         primary key(id_cliente,id_equipo),
                         foreign key(id_cliente) references usuario(id_usuario),
                         foreign key(id_equipo) references equipo(id_equipo));
                         
create table cabina(id_cabina integer,
					tipo varchar(20),
					primary key(id_cabina));
                    
create table escala(id_escala integer,
					primary key(id_escala));
                    
create table tour(id_tour integer,
					id_equipo integer,
                    primary key(id_tour),
                    foreign key(id_equipo) references equipo(id_equipo));     
                    
create table destino(id_destino integer,
					descripcion varchar(40),
                    id_escala integer,
                    id_tour integer,
                    primary key(id_destino),
                    foreign key(id_escala) references escala(id_escala),
                    foreign key(id_tour) references tour(id_tour));     
                    
create table vuelo(id_vuelo integer,
					duracion double,
                    capacidad_vuelo integer,
                    id_cabina integer,
                    id_nivel_vuelo integer,
                    id_viaje integer,
                    primary key(id_vuelo),
                    foreign key(id_cabina) references cabina(id_cabina),
                    foreign key(id_nivel_vuelo) references nivel_vuelo(id_nivel_vuelo),
                    foreign key(id_viaje) references viaje(id_viaje));
                    
create table vuela_hacia(id_vuelo integer,
						 id_destino integer,
                         primary key(id_vuelo,id_destino),
                         foreign key(id_vuelo) references vuelo(id_vuelo),
                         foreign key(id_destino) references destino(id_destino));     
                         
                         
create table tipo_servicio_a_bordo(id_tipo_servicio integer,
									descripcion_tipo varchar(20),
									primary key(id_tipo_servicio));    
			
create table reserva(id_reserva integer,
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
                    
INSERT INTO usuario (rol_usuario, clave, email)
VALUES ('ADMIN', 123, 'admin@admin.com' );

USE web2;
SELECT * FROM usuario;