CREATE DATABASE estanteDB;

/*
Alterar roles & estado_utilizador

E inserir tudo nos utilizadores

*/


/*
       (.)(.)
   ,-.(.____.),-.  
  ( \ \ '--' / / )
   \ \ / ,. \ / /
    ) '| || |' ( mrf
OoO'- OoO''OoO -'OoO
*/


USE estanteDB;

/*
ROLES - ELIMINADO
ESTADO_UTILIZADOR - ELIMINADO 
ESTADO_APO - ELIMINADO


*/

CREATE TABLE utilizadores(
    id INTEGER NOT NULL PRIMARY KEY,
    nome VARCHAR(12) NOT NULL,
    email VARCHAR NOT NULL,
    password VARCHAR(8) NOT NULL,
    role VARCHAR NOT NULL,
    estado VARCHAR NOT NULL,
    data_registo date NOT NULL
);

CREATE TABLE apontamentos(

    id_post INTEGER NOT NULL PRIMARY KEY,
    id_utilizador INTEGER NOT NULL FOREIGN KEY,
    id_disciplina INTEGER NOT NULL FOREIGN KEY,
    titulo VARCHAR NOT NULL,
    caminho_arquivo VARCHAR,
    descricao VARCHAR,
    estado_apontamento VARCHAR NOT NULL,
    data_submissao DATE NOT NULL,

);

CREATE TABLE curso(
id_curso int PRIMARY KEY NOT NULL,
nome VARCHAR NOT NULL,
codigo INTEGER NOT NULL
);

CREATE TABLE Disciplina(
    id_disciplina INTEGER PRIMARY KEY,
    id_curso INTEGER FOREIGN KEY,
    nome VARCHAR NOT NULL,
    codigo int NOT NULL,
    descricao VARCHAR NOT NULL /*btw talvez nao seja util descutir xd*/
);

CREATE TABLE Avalicao(

    valor INTEGER 

);