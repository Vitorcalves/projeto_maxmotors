create table estados(
	idEstado int primary key,
    uf varchar(4),
    nome varchar(20)
);

create table cep(
	idCep int primary key not null auto_increment,
    cep varchar(15),
    logradouro varchar(255),
    complemento varchar(100),
    bairro varchar(100),
    idMunicipio int not null
);

create table municipios(
	idMunicipio int primary key not null auto_increment,
    nome varchar(100),
    idEstado int not null
);

ALTER TABLE municipios
ADD CONSTRAINT idEstado FOREIGN KEY (idEstado) REFERENCES estados(idEstado);

alter table cep
add constraint idMunicipio foreign key(idMunicipio) references municipios(idMunicipio);

ALTER TABLE produto RENAME COLUMN nome TO modelo;

alter table produto add ano year;

ALTER TABLE `max_motors`.`produto` 
CHANGE COLUMN `ano` `ano` YEAR NOT NULL ;