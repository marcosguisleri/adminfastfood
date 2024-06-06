CREATE DATABASE adminfastfood;

USE adminfastfood;

CREATE TABLE users (
    id int primary key auto_increment,
    nomeUser varchar(50) not null,
    senha varchar(50) not null
);

INSERT INTO users(nomeUser, senha) VALUES ("marcos", "marcos123");

CREATE TABLE produtos (
    id int primary key auto_increment,
    nome_produto varchar(50) not null,
    preco double not null,
    quantidade int not null,
    descricao varchar(100) not null,
    caminho_imagem varchar(100) not null
);