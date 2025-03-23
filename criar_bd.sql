

CREATE DATABASE estantedb;

use estantedb;



-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--
-- NOTA:
-- FOI USADO O AUTO_INCREMENT PARA GERAR AUTOMATICAMENTE UM ID
-- FOI USADO UM ENUM PARA SIMPLIFICIDADE 

CREATE TABLE utilizadores(
    id_utilizador INT AUTO_INCREMENTNOT NOT NULL,
    nome VARCHAR(12) NOT NULL,
    endereco VARCHAR(50) NOT NULL,
    secretpass VARCHAR(20) NOT NULL,
    cargo ENUM('cliente', 'moderador', 'administrador') DEFAULT 'cliente' NOT NULL,
    estado ENUM('registado', 'pendente', 'negado') DEFAULT 'pendente' NOT NULL,
    data_registo DATE NOT NULL DEFAULT CURRENT_DATE,
    PRIMARY KEY(id_utilizador)
);


 
-- --------------------------------------------------------

--
-- Estrutura da tabela `apontamento`
--


CREATE TABLE apontamento(
    id_apo INT AUTO_INCREMENTNOT NOT NULL,
    id_utilizador INT NOT NULL,
    id_disciplina INT NOT NULL,
    titulo VARCHAR(30) NOT NULL,
    caminho_arquivo VARCHAR(255) NOT NULL,
    descricao TEXT,
    estado_apo ENUM('aprovado', 'pendente', 'negado') DEFAULT 'pendente' NOT NULL,
    data_submissao DATE NOT NULL DEFAULT CURRENT_DATE,
    PRIMARY KEY(id_apo),
    FOREIGN KEY (id_utilizador) REFERENCES utilizadores(id_utilizador),
    FOREIGN KEY (id_disciplina) REFERENCES disciplina(id_disciplina)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Curso`
--

CREATE TABLE curso(
    id_curso INT AUTO_INCREMENT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    codigo INTEGER NOT NULL,
    PRIMARY KEY(id_curso)
);


-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE disciplina(
    id_disciplina INT AUTO_INCREMENT NOT NULL,
    id_curso INT NOT NULL,
    nome VARCHAR NOT NULL,
    codigo INTEGER NOT NULL,    
    descricao VARCHAR NOT NULL, -- Talvez
    PRIMARY KEY (id_disciplina),
    FOREIGN KEY (id_curso) REFERENCES curso(id_curso)
);


-- --------------------------------------------------------

--
-- Estrutura da tabela `avalicao`
--


CREATE TABLE avalicao(
    id_avalicao INT AUTO_INCREMENT NOT NULL,
    id_utilizador INT NOT NULL,
    avalicao TEXT NOT NULL,
    data_avaliacao DATE NOT NULL DEFAULT CURRENT_DATE,
    PRIMARY KEY(id_avalicao),
    FOREIGN KEY (id_utilizador) REFERENCES utilizadores(id_utilizador)
);


-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--


CREATE TABLE comentario(
    id_comentario INT AUTO_INCREMENT NOT NULL,
    id_utilizador INT NOT NULL,
    cometario TEXT,    
    data_comentario DATE NOT NULL DEFAULT CURRENT_DATE,
    PRIMARY KEY (id_comentario),
    FOREIGN KEY (id_utilizador) REFERENCES utilizadores(id_utilizador)
);


-- --------------------------------------------------------

--
-- Estrutura da tabela `sugestao`
--


CREATE TABLE sugestao(
    id_sugestao INT AUTO_INCREMENT NOT NULL,
    id_utilizador INT NOT NULL, 
    sugestao TEXT,    
    data_sugestao DATE NOT NULL DEFAULT CURRENT_DATE,
    PRIMARY KEY (id_sugestao),
    FOREIGN KEY (id_utilizador) REFERENCES utilizadores(id_utilizador)
);



-- --------------------------------------------------------
-- ALTER TABLES

-- Alter da tabela `apontamento` para associar com a tabela `utilizadores` 
ALTER TABLE apontamento 
    ADD CONSTRAINT fk_utilizador 
    FOREIGN KEY (id_utilizador) REFERENCES utilizadores(id_utilizador);

-- Alter da tabela `comentario` para associar com a tabela `utilizadores`
ALTER TABLE comentario 
    ADD CONSTRAINT fk_comentario_utilizador 
    FOREIGN KEY (id_utilizador) REFERENCES utilizadores(id_utilizador);

-- Alter da tabela `sugestao` para associar com a tabela `utilizadores`
ALTER TABLE sugestao 
    ADD CONSTRAINT fk_sugestao_utilizador 
    FOREIGN KEY (id_utilizador) REFERENCES utilizadores(id_utilizador);

-- Alter da tabela `avaliacao` para associar com a tabela `utilizadores`
ALTER TABLE avaliacao 
    ADD CONSTRAINT fk_avaliacao_utilizador 
    FOREIGN KEY (id_utilizador) REFERENCES utilizadores(id_utilizador);