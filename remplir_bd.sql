INSERT INTO diese (nom,prenom,login,poste,mdp,statut) VALUES ('De Boe','Alexandre','alexandre.deboe','Président','%lokjjikj','admin');
INSERT INTO diese (nom,prenom,login,poste,mdp,statut) VALUES ('Charvin','Félix','felix.charvin','Pôle DSI','%lofdifgirkjjikj','admin');
INSERT INTO diese (nom,prenom,login,poste,mdp,statut) VALUES ('Julien','Aude','aude.julien','Chargée d"études','%ld;ldkrjjikj','user');
INSERT INTO diese (nom,prenom,login,poste,mdp,statut) VALUES ('Roch','Théo','theo.roch','Responsable Commercial','%ld;ldfnrjjikj','user');
INSERT INTO diese (nom,prenom,login,poste,mdp,statut) VALUES ('Guillermin','Grégory','gregory.guillermin','Responsable Qualité','%ldjikj','admin');
INSERT INTO diese (nom,prenom,login,poste,mdp,statut) VALUES ('Damiens','Alexis','alexis.damiens','DSI','%ldege;ldkrjjikj','admin');



INSERT INTO client (id,entreprise,c_nom,c_prenom,adresse,telephone) VALUES (1,'Sopra-Steria','Godeau','Frédéric','8 rue de l"iris 75000 Paris','0165853249');

INSERT INTO client (id,entreprise,c_nom,c_prenom,adresse,telephone) VALUES (2,'Waffle','Feraud','Adrien','209 rue de la liberte 91000 Evry','0185624968');
INSERT INTO client (id,entreprise,c_nom,c_prenom,adresse,telephone) VALUES (3,'GRDF','Dufour','Louis','67 rue de la pomme 91000 Evry','0148174804');

INSERT INTO client (id,entreprise,c_nom,c_prenom,adresse,telephone) VALUES (4,'Sprint','Leboudoulous','Emma','54 avenue de la résistance 91000 Evry','0691739266');

INSERT INTO client (id,entreprise,c_nom,c_prenom,adresse,telephone) VALUES (5,'Maison de la Thailande','Nguyen','Toto','46 rue de la chine 91000 Evry','0683376710');

INSERT INTO client (id,entreprise,c_nom,c_prenom,adresse,telephone) VALUES (6,'Pharmacie de la Gare','Yugi','Nathalie','1 place de la gare 91000 Evry','0127640472');



INSERT INTO intervenant(id_intervenant,nom,prenom,telephone,mail) VALUES (1,'Chevillard','Stéphane','0630087983','stephane.chevillard@ensiie.fr');

INSERT INTO intervenant(id_intervenant,nom,prenom,telephone,mail) VALUES (2,'Damiens','Alexis','0756483196','louisvilpoux@gmail.com');

INSERT INTO intervenant(id_intervenant,nom,prenom,telephone,mail) VALUES (3,'Thieblot','Benjamin','0693178403','benjamin.thieblot@ensiie.fr');

INSERT INTO intervenant(id_intervenant,nom,prenom,telephone,mail) VALUES (4,'Prat','Pierre','0756934573','pierreprat@laposte.net');

INSERT INTO intervenant(id_intervenant,nom,prenom,telephone,mail) VALUES (5,'Garcin','Clément','0683581988','clement.garcin@ensiie.fr');



INSERT INTO document(reference_etude,typedocument,lien,tag) VALUES (1.01,'BV','http:','Relu');

INSERT INTO document(reference_etude,typedocument,lien,tag) VALUES (2.01,'PC','http','En cours de relecture');

INSERT INTO document(reference_etude,typedocument,lien,tag) VALUES (3.01,'Facture finale','http','En cours de relecture');

INSERT INTO document(reference_etude,typedocument,lien,tag) VALUES (4.01,'RDM','http','Relu');



INSERT INTO etude(reference,id_client,login_charge_etudes,tag,date_debut,date_fin,prix_JEH,nombre_JEH) VALUES (6.02,1,'felix.charvin','Terminée','2014-05-21','2015-01-17',200,42);

INSERT INTO etude(reference,id_client,login_charge_etudes,tag,date_debut,date_fin,prix_JEH,nombre_JEH) VALUES (1.01,2,'aude.julien','En cours','2015-06-01','2016-01-05',320,14);

INSERT INTO etude(reference,id_client,login_charge_etudes,tag,date_debut,date_fin,prix_JEH,nombre_JEH) VALUES (6.01,1,'alexandre.deboe','En cours','2016-02-01','2016-09-05',300,10);

INSERT INTO etude(reference,id_client,login_charge_etudes,tag,date_debut,date_fin,prix_JEH,nombre_JEH) VALUES (2.01,6,'alexandre.deboe','En cours','2016-02-01','2016-09-05',290,4);

INSERT INTO etude(reference,id_client,login_charge_etudes,tag,date_debut,date_fin,prix_JEH,nombre_JEH) VALUES (4.01,5,'theo.roch','En cours','2016-02-01','2016-09-05',310,5);

INSERT INTO etude(reference,id_client,login_charge_etudes,tag,date_debut,date_fin,prix_JEH,nombre_JEH) VALUES (3.01,3,'theo.roch','Terminée','2015-11-23','2016-01-08',320,6);

INSERT INTO etude(reference,id_client,login_charge_etudes,tag,date_debut,date_fin,prix_JEH,nombre_JEH) VALUES (5.01,4,'gregory.guillermin','En cours','2016-04-25','2016-11-05',300,43);



INSERT INTO etude_intervenant(reference_etude,id_intervenant) VALUES (6.01,1);

INSERT INTO etude_intervenant(reference_etude,id_intervenant) VALUES (6.02,2);

INSERT INTO etude_intervenant(reference_etude,id_intervenant) VALUES (4.01,5);

INSERT INTO etude_intervenant(reference_etude,id_intervenant) VALUES (5.01,4);

INSERT INTO etude_intervenant(reference_etude,id_intervenant) VALUES (3.01,3);

INSERT INTO etude_intervenant(reference_etude,id_intervenant) VALUES (2.01,4);

INSERT INTO etude_intervenant(reference_etude,id_intervenant) VALUES (2.01,2);

