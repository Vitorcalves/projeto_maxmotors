-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.2.0 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para velocity
create table users(
id int auto_increment primary key,
idPessoa varchar(40) unique not null,
userName varchar(50) unique not null,
senha varchar(255) not null
);

create table pessoa(
id int auto_increment primary key,
idPessoa varchar(40) unique not null,
email varchar(255),
tipo boolean,
idEndereco int
);

create table fisica(
id int auto_increment primary key,
idPessoa varchar(40) unique not null,
cpf varchar(11) not null,
nome varchar(255)
);

create table juridica(
id int auto_increment primary key,
idPessoa varchar(40) unique not null,
cnpj varchar(14),
rasaoSocial varchar(255),
inscricaoEstadual varchar(12)
);

create table telefone(
id int auto_increment primary key,
idPessoa varchar(40) not null,
telefone varchar(11)
);

create table endereco(
id int auto_increment primary key,
cep bigint,
logradouro varchar(255),
numero int,
complemento varchar(100),
municipio bigint,
estado int
);

create table marca(
id int auto_increment primary key,
nome varchar(255)
);

create table produto(
id int auto_increment primary key,
nome varchar(255),
descricao varchar(255),
cor varchar(50),
marca int,
preco double,
quantidade int,
deleted date
);

create table pedido(
id int auto_increment primary key,
idPessoa varchar(40) not null,
dataPedido date,
dataEntrega date,
status varchar(50),
valorTotal double,
deleted date
);

create table itemPedido(
id int auto_increment primary key,
idPedido int not null,
idProduto int not null,
serie varchar(100),
quantidade int,
valorUnitario double,
desconto double
);

ALTER TABLE users
ADD CONSTRAINT fk_users_pessoa
FOREIGN KEY (idPessoa) REFERENCES pessoa(idPessoa);

ALTER TABLE fisica
ADD CONSTRAINT fk_fisica_pessoa
FOREIGN KEY (idPessoa) REFERENCES pessoa(idPessoa);

ALTER TABLE juridica
ADD CONSTRAINT fk_juridica_pessoa
FOREIGN KEY (idPessoa) REFERENCES pessoa(idPessoa);

ALTER TABLE telefone
ADD CONSTRAINT fk_telefone_pessoa
FOREIGN KEY (idPessoa) REFERENCES pessoa(idPessoa);

ALTER TABLE pessoa
ADD CONSTRAINT fk_pessoa_endereco
FOREIGN KEY (idEndereco) REFERENCES endereco(id);

alter table pessoa
add deleted date;

alter table produto
add CONSTRAINT fk_marca
FOREIGN KEY (marca) REFERENCES marca(id);

alter table pedido
add CONSTRAINT fk_pessoa
FOREIGN KEY (idPessoa) REFERENCES pessoa(idPessoa);

alter table itemPedido
add CONSTRAINT fk_pedido
FOREIGN KEY (idPedido) REFERENCES pedido(id);

alter table itemPedido
add CONSTRAINT fk_produto
FOREIGN KEY (idProduto) REFERENCES produto(id);

create table imagem(
id int auto_increment primary key,
idImagem varchar(40) unique not null,
idProduto int not null
);

alter table imagem
add CONSTRAINT fk_produto_imagem
FOREIGN KEY (idProduto) REFERENCES produto(id);
 
-- Exportação de dados foi desmarcado.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
