CREATE DATABASE FastRoute;

CREATE TABLE fastroute.clienti (
   id INT PRIMARY KEY AUTO_INCREMENT,
   nome VARCHAR(100) NOT NULL,
   cognome VARCHAR(100) NOT NULL,
   indirizzo VARCHAR(100) NOT NULL,
   telefono INT NOT NULL,
   email VARCHAR(100) NOT NULL,
   password VARCHAR(64) NOT NULL,
   punti_fedelta INT
);

CREATE TABLE fastroute.sedi (
id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(100) NOT NULL,
citta VARCHAR(100) NOT NULL,
indirizzo VARCHAR(100) NOT NULL
);

CREATE TABLE fastroute.plichi (
  id INT PRIMARY KEY AUTO_INCREMENT,
  consegna DATETIME,
  spedizione DATETIME,
  ritiro DATETIME,
  stato ENUM('in_partenza','in_transito','consegnato') NOT NULL,
  mittente INT NOT NULL,
  destinatario INT NOT NULL,
  sede_arrivo INT NOT NULL,
  sede_partenza INT NOT NULL,
  FOREIGN KEY (mittente) REFERENCES fastroute.clienti(id) ON DELETE CASCADE,
  FOREIGN KEY (destinatario) REFERENCES fastroute.clienti(id) ON DELETE CASCADE,
  FOREIGN KEY (sede_arrivo) REFERENCES fastroute.sedi(id) ON DELETE CASCADE,
  FOREIGN KEY (sede_partenza) REFERENCES fastroute.sedi(id) ON DELETE CASCADE
);

CREATE TABLE fastroute.personale (
     id INT PRIMARY KEY AUTO_INCREMENT,
     nome VARCHAR(100) NOT NULL,
     cognome VARCHAR(100) NOT NULL,
     email VARCHAR(100) NOT NULL UNIQUE,
     password VARCHAR(100) NOT NULL,
     tema VARCHAR(100) NOT NULL DEFAULT 'light',
     remember_token VARCHAR(100) DEFAULT NULL,
     remember_expire DATETIME DEFAULT NULL
);

