#USE phpmyadmin;

#DROP DATABASE preetec;

#  ESSE DDL CRIA O BANCO DE DADOS preetec de 05/10/18

CREATE DATABASE preetec;

USE preetec;

CREATE TABLE inscricao (
	id_inscricao MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT, #Primaria
	data_inscricao DATETIME NOT NULL,
	nome_aluno VARCHAR(120) NOT NULL,
    sexo_aluno ENUM('MASCULINO','FEMININO','OUTRO') NOT NULL,
	email VARCHAR(120) UNIQUE,
	telefone_contato CHAR(10),
	celular_contato CHAR(11),
    inscrito TINYINT(1) NOT NULL DEFAULT FALSE,
    CONSTRAINT PK_inscricao PRIMARY KEY(id_inscricao) 
);

CREATE TABLE responsavel (
	id_responsavel MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT, #Primaria	
	nome_responsavel VARCHAR(120) NOT NULL,
    sexo_responsavel ENUM('MASCULINO','FEMININO','OUTRO') NOT NULL,
    data_nascimento_responsavel DATE NOT NULL,
	cpf CHAR(11) UNIQUE,
	rg_responsavel VARCHAR(14),
	email VARCHAR(120) UNIQUE,
    status_responsavel TINYINT(1) NOT NULL DEFAULT TRUE,
    CONSTRAINT PK_responsavel PRIMARY KEY(id_responsavel)
);


CREATE TABLE aluno (
    id_aluno MEDIUMINT UNSIGNED NOT NULL, #Primaria    
	id_responsavel MEDIUMINT UNSIGNED,  #Estrangeira
    id_turma TINYINT UNSIGNED, #Estrangeira
    data_matricula DATE NOT NULL,
	data_nascimento_aluno DATE NOT NULL,
	rg_aluno VARCHAR(14),
	cpf CHAR(11)UNIQUE,
    rua_aluno VARCHAR(60) NOT NULL,
	numero_aluno VARCHAR(5) NOT NULL,	
	bairro_aluno VARCHAR(60) NOT NULL,
	cidade_aluno VARCHAR(60) NOT NULL,
	complemento_aluno VARCHAR(100),
	cep_aluno CHAR(8),
	escolaridade ENUM('Ensino_fundamental_cursando', 'Ensino_fundamental_concluído','Ensino_médio_cursando','Ensino_médio_concluído') NOT NULL,
	escola VARCHAR(120) NOT NULL,
    matriculado TINYINT(1) NOT NULL DEFAULT FALSE,
    status_aluno TINYINT(1) NOT NULL DEFAULT TRUE,
    CONSTRAINT PK_aluno PRIMARY KEY(id_aluno)    
);

CREATE TABLE turma (
	id_turma TINYINT UNSIGNED NOT NULL AUTO_INCREMENT, #Primaria
	nome_turma VARCHAR(2) NOT NULL,
	quantidade_alunos TINYINT UNSIGNED NOT NULL,
	disponivel TINYINT(1) NOT NULL DEFAULT TRUE,
    CONSTRAINT PK_turma PRIMARY KEY(id_turma)
);


ALTER TABLE aluno
	ADD CONSTRAINT FK_aluno 
		FOREIGN KEY(id_aluno) 
			REFERENCES inscricao(id_inscricao);
            
ALTER TABLE aluno
	ADD CONSTRAINT FK_responsavel_aluno
		FOREIGN KEY(id_responsavel)		
			REFERENCES responsavel(id_responsavel);
            
ALTER TABLE aluno
	ADD CONSTRAINT FK_turma_aluno
		FOREIGN KEY(id_turma)
			REFERENCES turma(id_turma);

/*
CREATE TABLE matricula(
    id_matricula INT UNSIGNED NOT NULL AUTO_INCREMENT, #Primaria
	id_turma TINYINT UNSIGNED,  #Estrangeira
	id_aluno MEDIUMINT UNSIGNED,  #Estrangeira
    data_matricula DATE NOT NULL,
    CONSTRAINT PK_matricula PRIMARY KEY(id_matricula)
);

ALTER TABLE matricula
	ADD CONSTRAINT FK_turma_matricula
		FOREIGN KEY(id_turma)
			REFERENCES turma(id_turma);

ALTER TABLE matricula 
	ADD CONSTRAINT FK_aluno_matricula			
		FOREIGN KEY(id_aluno)
			REFERENCES aluno(id_aluno);
*/

CREATE TABLE professor(
    id_professor SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT, #Primaria
	data_nascimento_professor DATE NOT NULL, 
	nome_professor VARCHAR(120) NOT NULL,
    sexo_professor ENUM('MASCULINO','FEMININO','OUTRO') NOT NULL,
	cpf CHAR(11) UNIQUE NOT NULL,
	rg_professor VARCHAR(14),
    rua_professor VARCHAR(60) NOT NULL,
	numero_professor VARCHAR(5) NOT NULL,
	bairro_professor VARCHAR(60) NOT NULL,
	cidade_professor VARCHAR(60) NOT NULL,
	complemento_professor VARCHAR(100),
	cep_professor CHAR(8),
	telefone_professor CHAR(10),
	celular_professor CHAR(11),
	email VARCHAR(120) UNIQUE,
	formacao VARCHAR(120) NOT NULL,
    status_professor TINYINT(1) NOT NULL DEFAULT TRUE,
    CONSTRAINT PK_professor PRIMARY KEY(id_Professor)
);

CREATE TABLE disciplina(
    id_disciplina TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	nome_disciplina VARCHAR(30) NOT NULL,
    CONSTRAINT PK_disciplina PRIMARY KEY(id_disciplina)
);

ALTER TABLE `table_2`
	ADD CONSTRAINT `FK_table_3`
		FOREIGN KEY (`FK_id_table_3`)
			REFERENCES `table_3`(`id_table_3`)
				ON DELETE CASCADE ON UPDATE RESTRICT;



CREATE TABLE disciplina_ministrada(
    #id_disciplina_ministrada MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT, #Primaria
	id_professor SMALLINT UNSIGNED NOT NULL, #Estrangeira
	id_disciplina TINYINT UNSIGNED NOT NULL, #Estrangeira
    CONSTRAINT PK_disciplina_ministrada PRIMARY KEY(id_professor, id_disciplina)
);


ALTER TABLE disciplina_ministrada
	ADD CONSTRAINT FK_professor_disciplina_ministrada
		FOREIGN KEY(id_professor)
			REFERENCES professor(id_professor);

ALTER TABLE disciplina_ministrada
	ADD CONSTRAINT FK_disciplina_disciplina_ministrada
		FOREIGN KEY(id_disciplina)
			REFERENCES disciplina(id_disciplina)
				ON DELETE CASCADE ON UPDATE CASCADE;


CREATE TABLE chamada(
	id_chamada INT UNSIGNED NOT NULL AUTO_INCREMENT, #Primaria
    id_turma TINYINT UNSIGNED, #Estrangeira
	id_aluno MEDIUMINT UNSIGNED, #Estrangeira
	id_professor SMALLINT UNSIGNED, #Estrangeira
	data_chamada DATE NOT NULL,
	presenca TINYINT(1) NOT NULL,
    CONSTRAINT PK_chamada PRIMARY KEY(id_chamada)
);		

ALTER TABLE chamada 
	ADD CONSTRAINT FK_turma_chamada
		FOREIGN KEY(id_turma)
			REFERENCES turma(id_turma);

ALTER TABLE chamada
	ADD CONSTRAINT FK_aluno_chamada
		FOREIGN	KEY(id_aluno)
			REFERENCES aluno(id_aluno);

ALTER TABLE chamada
	ADD CONSTRAINT FK_professor_chamada	
		FOREIGN KEY(id_professor)		
			REFERENCES professor(id_professor);
            
CREATE TABLE login(
    id_login SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome_usuario VARCHAR(24) NOT NULL,
    senha VARCHAR(32) NOT NULL,
    tipo_usuario ENUM('PROFESSOR','ADMINISTRADOR','DATASHOW') NOT NULL DEFAULT'PROFESSOR',
    status_login TINYINT(1) NOT NULL DEFAULT TRUE,
    CONSTRAINT PK_login PRIMARY KEY(id_login)
);

CREATE TABLE plano_aula(
	id_plano MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_professor SMALLINT UNSIGNED,
    id_disciplina TINYINT UNSIGNED,
    titulo VARCHAR(40) NOT NULL,
    descricao TEXT NOT NULL,
    CONSTRAINT PK_plano_Aula PRIMARY KEY(id_plano)
);

ALTER TABLE plano_aula
	ADD CONSTRAINT FK_professor_plano
		FOREIGN KEY(id_professor)
			REFERENCES professor(id_professor);
            
ALTER TABLE plano_aula
	ADD CONSTRAINT FK_disciplina_plano
		FOREIGN KEY(id_disciplina)
			REFERENCES disciplina(id_disciplina);
            
CREATE TABLE sala_video(
	id_sala TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    identificador VARCHAR(3) NOT NULL,
    disponivel TINYINT(1) NOT NULL DEFAULT TRUE,
    CONSTRAINT PK_sala_video PRIMARY KEY(id_sala)
);

CREATE TABLE reserva(
	id_reserva SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_sala TINYINT UNSIGNED,
    id_professor SMALLINT UNSIGNED,
    data_reserva DATE NOT NULL,
    obs VARCHAR(120),
    CONSTRAINT PK_reserva PRIMARY KEY(id_reserva)
);

ALTER TABLE reserva
	ADD CONSTRAINT FK_professor_reserva
		FOREIGN KEY(id_professor)
			REFERENCES professor(id_professor);

ALTER TABLE reserva
	ADD CONSTRAINT FK_sala_reserva
		FOREIGN KEY(id_sala)
			REFERENCES sala_video(id_sala);

INSERT INTO `login` (`id_login`, `nome_usuario`, `senha`, `tipo_usuario`, `status_login`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'ADMINISTRADOR', '1');


#Aluno Cadastrado
/*
ALTER TABLE teste01.inscricao
    ADD INDEX idx_data_inscricao (data_inscricao ASC);

ALTER TABLE teste01.inscricao
    ADD INDEX idx_nome_aluno (nome_aluno ASC);

#Fim Aluno Cadastrado

#Chamada
ALTER TABLE teste01.chamada 
    ADD INDEX idx_data_chamada (data_chamada DESC);
#Fim Chamada

#Professor        
ALTER TABLE teste01.professor
        ADD INDEX idx_professor_nome (nome_professor ASC);
#Fim Professor

#Turma
ALTER TABLE teste01.turma
        ADD INDEX idx_nome_turma (nome_turma ASC);
#Fim Turma
*/
## DDL do PROTOTIPO 2_1
	#INSERT INTO `preetec`.`login` (`nome_usuario`, `senha`, `tipo_usuario`) VALUES ('admin', '123', 'ADMINISTRADOR');