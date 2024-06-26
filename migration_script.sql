-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: maxMotors2
-- Source Schemata: maxMotors
-- Created: Tue Jun 25 19:21:02 2024
-- Workbench Version: 8.0.36
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Schema maxMotors2
-- ----------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `maxMotors2` ;
CREATE SCHEMA IF NOT EXISTS `maxMotors2` ;

-- ----------------------------------------------------------------------------
-- Table maxMotors2.cep
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `maxMotors2`.`cep` (
  `cep` VARCHAR(15) NOT NULL,
  `logradouro` VARCHAR(255) NULL DEFAULT NULL,
  `complemento` VARCHAR(100) NULL DEFAULT NULL,
  `bairro` VARCHAR(100) NULL DEFAULT NULL,
  `idMunicipio` BIGINT NULL DEFAULT NULL,
  `idCep` BIGINT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idCep`),
  INDEX `idMunicipio` (`idMunicipio` ASC) VISIBLE,
  CONSTRAINT `cep_ibfk_1`
    FOREIGN KEY (`idMunicipio`)
    REFERENCES `maxMotors2`.`municipios` (`idMunicipio`))
ENGINE = InnoDB
AUTO_INCREMENT = 2112043
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------------------------------------------------------
-- Table maxMotors2.cliente
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `maxMotors2`.`cliente` (
  `id` VARCHAR(40) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `nome` VARCHAR(250) NOT NULL,
  `cpf` VARCHAR(18) NULL DEFAULT NULL,
  `cnpj` VARCHAR(25) NULL DEFAULT NULL,
  `deleted` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------------------------------------------------------
-- Table maxMotors2.endereco
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `maxMotors2`.`endereco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `logradouro` VARCHAR(255) NULL DEFAULT NULL,
  `numero` INT NULL DEFAULT NULL,
  `complemento` VARCHAR(100) NULL DEFAULT NULL,
  `municipio` BIGINT NULL DEFAULT NULL,
  `estado` INT NULL DEFAULT NULL,
  `bairro` VARCHAR(70) NULL DEFAULT NULL,
  `idPessoa` VARCHAR(40) NULL DEFAULT NULL,
  `cep` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_endereco_1_idx` (`idPessoa` ASC) VISIBLE,
  CONSTRAINT `fk_cliente_endereco`
    FOREIGN KEY (`idPessoa`)
    REFERENCES `maxMotors2`.`cliente` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 29
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------------------------------------------------------
-- Table maxMotors2.estados
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `maxMotors2`.`estados` (
  `idEstado` INT NOT NULL,
  `uf` VARCHAR(4) NULL DEFAULT NULL,
  `nome` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`idEstado`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------------------------------------------------------
-- Table maxMotors2.imagem
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `maxMotors2`.`imagem` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idImagem` VARCHAR(40) NOT NULL,
  `idProduto` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idImagem` (`idImagem` ASC) VISIBLE,
  INDEX `fk_produto_imagem` (`idProduto` ASC) VISIBLE,
  CONSTRAINT `fk_produto_imagem`
    FOREIGN KEY (`idProduto`)
    REFERENCES `maxMotors2`.`produto` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------------------------------------------------------
-- Table maxMotors2.itemPedido
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `maxMotors2`.`itemPedido` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idPedido` INT NOT NULL,
  `idProduto` INT NOT NULL,
  `serie` VARCHAR(100) NULL DEFAULT NULL,
  `quantidade` INT NULL DEFAULT NULL,
  `valorUnitario` DOUBLE NULL DEFAULT NULL,
  `desconto` DOUBLE NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pedido` (`idPedido` ASC) VISIBLE,
  INDEX `fk_produto` (`idProduto` ASC) VISIBLE,
  CONSTRAINT `fk_pedido`
    FOREIGN KEY (`idPedido`)
    REFERENCES `maxMotors2`.`pedido` (`id`),
  CONSTRAINT `fk_produto`
    FOREIGN KEY (`idProduto`)
    REFERENCES `maxMotors2`.`produto` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------------------------------------------------------
-- Table maxMotors2.marca
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `maxMotors2`.`marca` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------------------------------------------------------
-- Table maxMotors2.municipios
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `maxMotors2`.`municipios` (
  `idMunicipio` BIGINT NOT NULL,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `idEstado` INT NULL DEFAULT NULL,
  PRIMARY KEY (`idMunicipio`),
  INDEX `idEstado` (`idEstado` ASC) VISIBLE,
  CONSTRAINT `municipios_ibfk_1`
    FOREIGN KEY (`idEstado`)
    REFERENCES `maxMotors2`.`estados` (`idEstado`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------------------------------------------------------
-- Table maxMotors2.nivel
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `maxMotors2`.`nivel` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(30) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------------------------------------------------------
-- Table maxMotors2.pedido
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `maxMotors2`.`pedido` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idPessoa` VARCHAR(40) NOT NULL,
  `dataPedido` DATE NULL DEFAULT NULL,
  `dataEntrega` DATE NULL DEFAULT NULL,
  `status` VARCHAR(50) NULL DEFAULT NULL,
  `valorTotal` DOUBLE NULL DEFAULT NULL,
  `deleted` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pessoa` (`idPessoa` ASC) VISIBLE,
  CONSTRAINT `fk_pessoa`
    FOREIGN KEY (`idPessoa`)
    REFERENCES `maxMotors2`.`pessoa` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------------------------------------------------------
-- Table maxMotors2.pessoa
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `maxMotors2`.`pessoa` (
  `id` VARCHAR(40) NOT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `tipo` TINYINT(1) NULL DEFAULT NULL,
  `deleted` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------------------------------------------------------
-- Table maxMotors2.produto
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `maxMotors2`.`produto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL DEFAULT NULL,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  `cor` VARCHAR(50) NULL DEFAULT NULL,
  `marca` INT NULL DEFAULT NULL,
  `preco` DOUBLE NULL DEFAULT NULL,
  `quantidade` INT NULL DEFAULT NULL,
  `deleted` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_marca` (`marca` ASC) VISIBLE,
  CONSTRAINT `fk_marca`
    FOREIGN KEY (`marca`)
    REFERENCES `maxMotors2`.`marca` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------------------------------------------------------
-- Table maxMotors2.telefone
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `maxMotors2`.`telefone` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idPessoa` VARCHAR(40) NOT NULL,
  `telefone` VARCHAR(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_telefone_pessoa` (`idPessoa` ASC) VISIBLE,
  CONSTRAINT `fk_telefone_pessoa`
    FOREIGN KEY (`idPessoa`)
    REFERENCES `maxMotors2`.`pessoa` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- ----------------------------------------------------------------------------
-- Table maxMotors2.user
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `maxMotors2`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(150) NOT NULL,
  `nome` VARCHAR(250) NOT NULL,
  `pasword` VARCHAR(250) NULL DEFAULT NULL,
  `deleted` DATE NULL DEFAULT NULL,
  `nivel` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;
SET FOREIGN_KEY_CHECKS = 1;
