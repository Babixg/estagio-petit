create database db_petitpoti; 

	create table usuario( 
		id_user int AUTO_INCREMENT,
		login varchar(100) not null,
		password varchar(100) not null,
		cpf varchar(14) not null,
		email varchar(50) not null,
		nascimento date not null,
		primary key(id_user)
	)

	create table categoria(
		id_categoria int AUTO_INCREMENT not null,
		nome varchar(60) not null, 
		descricao varchar(200) not null,
		primary key (id_categoria)
	)
	

	create table prato(
		id_prato int AUTO_INCREMENT not null,
		nome varchar(100) not null,
		descricao varchar(300) not null,
		peso decimal(4,2),
		ingredientes varchar(300),
		tipo int,
		primary key(id_prato),
		foreign key (tipo) references categoria(id_categoria)
	)
	

	insert into usuario(login, password, cpf, email, nascimento) VALUES('Luan', 'luansenha', '700.733.544-65', 'luan@email.com', '02-09-2000') 
