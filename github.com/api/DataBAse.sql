#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: checkliste
#------------------------------------------------------------

CREATE TABLE checkliste(
        idCheckliste  int (11) Auto_increment  NOT NULL ,
        nomCheckliste Varchar (255) ,
        idProjet      Int ,
        PRIMARY KEY (idCheckliste )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: client
#------------------------------------------------------------

CREATE TABLE client(
        idC     int (11) Auto_increment  NOT NULL ,
        cinC    Varchar (25) ,
        nomC    Varchar (25) ,
        prenomC Varchar (25) ,
        PRIMARY KEY (idC )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: membre
#------------------------------------------------------------

CREATE TABLE membre(
        idMembre     int (11) Auto_increment  NOT NULL ,
        nomMembre    Varchar (255) ,
        prenomMembre Varchar (255) ,
        usernameMembre Varchar (255),
        mdpMembre    Varchar (255) ,
        emailMembre  Varchar (255) ,
        telMembre    Varchar (255) ,
        PRIMARY KEY (idMembre,usernameMembre,emailMembre )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: projet
#------------------------------------------------------------

CREATE TABLE projet(
        idProjet  int (11) Auto_increment  NOT NULL ,
        nomProjet Varchar (255) ,
        dateDebut Date ,
        dateFin   Date ,
        idC       Int ,
        PRIMARY KEY (idProjet )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: question
#------------------------------------------------------------

CREATE TABLE question(
        idQ       int (11) Auto_increment  NOT NULL ,
        question1 Text ,
        idRu      Int ,
        PRIMARY KEY (idQ )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reeunion
#------------------------------------------------------------

CREATE TABLE reeunion(
        idR       int (11) Auto_increment  NOT NULL ,
        dateR     Date ,
        objectifR Varchar (255) ,
        idProjet  Int ,
        PRIMARY KEY (idR )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reponse
#------------------------------------------------------------

CREATE TABLE reponse(
        idRep int (11) Auto_increment  NOT NULL ,
        rep1  Text ,
        idQ   Int ,
        PRIMARY KEY (idRep )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: rubrique
#------------------------------------------------------------

CREATE TABLE rubrique(
        idRu         int (11) Auto_increment  NOT NULL ,
        nomRu        Varchar (255) ,
        idCheckliste Int ,
        PRIMARY KEY (idRu )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: tache
#------------------------------------------------------------

CREATE TABLE tache(
        idT        int (11) Auto_increment  NOT NULL ,
        intituleT  Varchar (255) ,
        dateDebutT Date ,
        dateFinT   Date ,
        idR        Int ,
        PRIMARY KEY (idT )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: validationprojet
#------------------------------------------------------------

CREATE TABLE validationprojet(
        idV      int (11) Auto_increment  NOT NULL ,
        q1       Text ,
        idProjet Int ,
        PRIMARY KEY (idV )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: QuestionValidationProjet
#------------------------------------------------------------

CREATE TABLE QuestionValidationProjet(
        idQVP int (11) Auto_increment  NOT NULL ,
        qst1  Varchar (255) ,
        qst2  Varchar (255) ,
        PRIMARY KEY (idQVP )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: affectaationMembre
#------------------------------------------------------------

CREATE TABLE affectaationMembre(
        dateAffectation Date ,
        idMembre        Int NOT NULL ,
        idT             Int NOT NULL ,
        PRIMARY KEY (idMembre ,idT )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: AffProjetMembre
#------------------------------------------------------------

CREATE TABLE AffProjetMembre(
        dateAffP Date ,
        idProjet Int NOT NULL ,
        idMembre Int NOT NULL ,
        PRIMARY KEY (idProjet ,idMembre )
)ENGINE=InnoDB;

ALTER TABLE checkliste ADD CONSTRAINT FK_checkliste_idProjet FOREIGN KEY (idProjet) REFERENCES projet(idProjet);
ALTER TABLE projet ADD CONSTRAINT FK_projet_idC FOREIGN KEY (idC) REFERENCES client(idC);
ALTER TABLE question ADD CONSTRAINT FK_question_idRu FOREIGN KEY (idRu) REFERENCES rubrique(idRu);
ALTER TABLE reeunion ADD CONSTRAINT FK_reeunion_idProjet FOREIGN KEY (idProjet) REFERENCES projet(idProjet);
ALTER TABLE reponse ADD CONSTRAINT FK_reponse_idQ FOREIGN KEY (idQ) REFERENCES question(idQ);
ALTER TABLE rubrique ADD CONSTRAINT FK_rubrique_idCheckliste FOREIGN KEY (idCheckliste) REFERENCES checkliste(idCheckliste);
ALTER TABLE tache ADD CONSTRAINT FK_tache_idR FOREIGN KEY (idR) REFERENCES reeunion(idR);
ALTER TABLE validationprojet ADD CONSTRAINT FK_validationprojet_idProjet FOREIGN KEY (idProjet) REFERENCES projet(idProjet);
ALTER TABLE affectaationMembre ADD CONSTRAINT FK_affectaationMembre_idMembre FOREIGN KEY (idMembre) REFERENCES membre(idMembre);
ALTER TABLE affectaationMembre ADD CONSTRAINT FK_affectaationMembre_idT FOREIGN KEY (idT) REFERENCES tache(idT);
ALTER TABLE AffProjetMembre ADD CONSTRAINT FK_AffProjetMembre_idProjet FOREIGN KEY (idProjet) REFERENCES projet(idProjet);
ALTER TABLE AffProjetMembre ADD CONSTRAINT FK_AffProjetMembre_idMembre FOREIGN KEY (idMembre) REFERENCES membre(idMembre);
