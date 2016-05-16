DROP TABLE diese;
DROP TABLE client;
DROP TABLE intervenant;
DROP TABLE document;
DROP TABLE etude_intervenant;
DROP TABLE etude;


CREATE TABLE diese(
nom VARCHAR(20),
prenom VARCHAR(20),
login VARCHAR(40),
poste VARCHAR(30),
mdp VARCHAR(40),
statut VARCHAR (30),
CONSTRAINT pk_diese PRIMARY KEY (login));

CREATE TABLE client(
id INTEGER,
entreprise VARCHAR(30),
c_nom VARCHAR(20),
c_prenom VARCHAR(20),
adresse VARCHAR(50),
telephone VARCHAR(10),
CONSTRAINT pk_client PRIMARY KEY (id));

CREATE TABLE intervenant(
id_intervenant INTEGER,
nom VARCHAR(20),
prenom VARCHAR(20),
telephone VARCHAR(10),
mail VARCHAR(50),
CONSTRAINT pk_intervenant PRIMARY KEY (id_intervenant));

CREATE TABLE document(
reference_etude DECIMAL,
typedocument VARCHAR(20),
lien VARCHAR(75),
tag VARCHAR(50),
CONSTRAINT pk_document PRIMARY KEY (reference_etude,typedocument));

CREATE TABLE etude_intervenant(
reference_etude DECIMAL,
id_intervenant INTEGER);


CREATE TABLE etude(
reference DECIMAL,
id_client INTEGER,
login_charge_etudes VARCHAR(20),
tag VARCHAR(20),
date_debut DATE,
date_fin DATE,
prix_JEH INTEGER,
nombre_JEH INTEGER,
CONSTRAINT pk_etude PRIMARY KEY (reference));


