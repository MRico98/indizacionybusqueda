CREATE DATABASE IF NOT EXISTS indiceinvertido;
USE indiceinvertido;
CREATE TABLE IF NOT EXISTS diccionario(
	indice varchar(255) NOT NULL,
    PRIMARY KEY(indice)
);
CREATE TABLE IF NOT EXISTS documentos(
	docid VARCHAR(255),
    resumen TEXT,
    rutatext varchar(100),
    PRIMARY KEY(docid)
);
CREATE TABLE IF NOT EXISTS indiceinvertido(
	indice VARCHAR(255) NOT NULL,
    docid VARCHAR(255) NOT NULL,
    count INT NOT NULL,
    PRIMARY KEY(indice,docid)
);

ALTER TABLE indiceinvertido
ADD FOREIGN KEY (indice) REFERENCES diccionario(indice),
ADD FOREIGN KEY (docid) REFERENCES documentos(docid);