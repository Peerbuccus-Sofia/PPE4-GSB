DROP DATABASE IF EXISTS MLR4;

CREATE DATABASE IF NOT EXISTS MLR4;
# -----------------------------------------------------------------------------
#       TABLE : PERSONNE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PERSONNE
 (
   IDPERS CHAR(32) NOT NULL  ,
   NOM CHAR(32) NULL  ,
   PRENOM CHAR(32) NULL  ,
   TEL CHAR(32) NULL  ,
   LOGIN CHAR(32) NULL  ,
   MDP CHAR(32) NULL  
   , PRIMARY KEY (IDPERS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ADMIN
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ADMIN
 (
   IDPERS CHAR(32) NOT NULL  
   , PRIMARY KEY (IDPERS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : VISITEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS VISITEUR
 (
   IDPERS CHAR(32) NOT NULL  ,
   ADR CHAR(32) NULL  ,
   VILLE CHAR(32) NULL  ,
   CP CHAR(32) NULL  
   , PRIMARY KEY (IDPERS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PROPRIETAIRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PROPRIETAIRE
 (
   IDPERS CHAR(32) NOT NULL  ,
   ADR CHAR(32) NULL  ,
   VILLE CHAR(32) NULL  ,
   CP CHAR(32) NULL  
   , PRIMARY KEY (IDPERS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : APPARTEMENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS APPARTEMENT
 (
   IDAPPART CHAR(32) NOT NULL  ,
   IDPERS CHAR(32) NOT NULL  ,
   ADR CHAR(32) NULL  ,
   VILLE CHAR(32) NULL  ,
   CP SMALLINT(5) NULL  ,
   ETAGE CHAR(32) NULL  ,
   TYPEAPPART CHAR(32) NULL  ,
   LOYER BIGINT(4) NULL  ,
   CHARGE BIGINT(4) NULL  ,
   ASCENSEUR BOOL NULL  ,
   PREAVIS BOOL NULL  ,
   DATELIBRE DATE NULL  ,
   TAUXCOTISATION CHAR(32) NULL  ,
   TAILLE CHAR(32) NULL  
   , PRIMARY KEY (IDAPPART) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE APPARTEMENT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_APPARTEMENT_PROPRIETAIRE
     ON APPARTEMENT (IDPERS ASC);

# -----------------------------------------------------------------------------
#       TABLE : ARRONDISSEMENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ARRONDISSEMENT
 (
   ARRONDI_DEM CHAR(32) NOT NULL  
   , PRIMARY KEY (ARRONDI_DEM) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : DEMANDE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS DEMANDE
 (
   IDDEMANDE CHAR(32) NOT NULL  ,
   IDPERS CHAR(32) NOT NULL  ,
   TYPEDEM CHAR(32) NULL  ,
   DATELIMITE CHAR(32) NULL  ,
   VILLE CHAR(32) NULL  
   , PRIMARY KEY (IDDEMANDE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE DEMANDE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_DEMANDE_VISITEUR
     ON DEMANDE (IDPERS ASC);

# -----------------------------------------------------------------------------
#       TABLE : LOCATAIRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LOCATAIRE
 (
   IDPERS CHAR(32) NOT NULL  ,
   IDAPPART CHAR(32) NOT NULL  ,
   DATENAISSANCE CHAR(32) NULL  ,
   RIB CHAR(32) NULL  ,
   TELBANQUE CHAR(32) NULL  
   , PRIMARY KEY (IDPERS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE LOCATAIRE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_LOCATAIRE_APPARTEMENT
     ON LOCATAIRE (IDAPPART ASC);

# -----------------------------------------------------------------------------
#       TABLE : CONCERNER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CONCERNER
 (
   IDDEMANDE CHAR(32) NOT NULL  ,
   ARRONDI_DEM CHAR(32) NOT NULL  
   , PRIMARY KEY (IDDEMANDE,ARRONDI_DEM) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE CONCERNER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_CONCERNER_DEMANDE
     ON CONCERNER (IDDEMANDE ASC);

CREATE  INDEX I_FK_CONCERNER_ARRONDISSEMENT
     ON CONCERNER (ARRONDI_DEM ASC);

# -----------------------------------------------------------------------------
#       TABLE : VISITER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS VISITER
 (
   IDPERS CHAR(32) NOT NULL  ,
   IDAPPART CHAR(32) NOT NULL  ,
   DATEVISITE CHAR(32) NULL  
   , PRIMARY KEY (IDPERS,IDAPPART) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE VISITER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_VISITER_VISITEUR
     ON VISITER (IDPERS ASC);

CREATE  INDEX I_FK_VISITER_APPARTEMENT
     ON VISITER (IDAPPART ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE ADMIN 
  ADD FOREIGN KEY FK_ADMIN_PERSONNE (IDPERS)
      REFERENCES PERSONNE (IDPERS) ;


ALTER TABLE VISITEUR 
  ADD FOREIGN KEY FK_VISITEUR_PERSONNE (IDPERS)
      REFERENCES PERSONNE (IDPERS) ;


ALTER TABLE PROPRIETAIRE 
  ADD FOREIGN KEY FK_PROPRIETAIRE_PERSONNE (IDPERS)
      REFERENCES PERSONNE (IDPERS) ;


ALTER TABLE APPARTEMENT 
  ADD FOREIGN KEY FK_APPARTEMENT_PROPRIETAIRE (IDPERS)
      REFERENCES PROPRIETAIRE (IDPERS) ;


ALTER TABLE DEMANDE 
  ADD FOREIGN KEY FK_DEMANDE_VISITEUR (IDPERS)
      REFERENCES VISITEUR (IDPERS) ;


ALTER TABLE LOCATAIRE 
  ADD FOREIGN KEY FK_LOCATAIRE_APPARTEMENT (IDAPPART)
      REFERENCES APPARTEMENT (IDAPPART) ;


ALTER TABLE LOCATAIRE 
  ADD FOREIGN KEY FK_LOCATAIRE_PERSONNE (IDPERS)
      REFERENCES PERSONNE (IDPERS) ;


ALTER TABLE CONCERNER 
  ADD FOREIGN KEY FK_CONCERNER_DEMANDE (IDDEMANDE)
      REFERENCES DEMANDE (IDDEMANDE) ;


ALTER TABLE CONCERNER 
  ADD FOREIGN KEY FK_CONCERNER_ARRONDISSEMENT (ARRONDI_DEM)
      REFERENCES ARRONDISSEMENT (ARRONDI_DEM) ;


ALTER TABLE VISITER 
  ADD FOREIGN KEY FK_VISITER_VISITEUR (IDPERS)
      REFERENCES VISITEUR (IDPERS) ;


ALTER TABLE VISITER 
  ADD FOREIGN KEY FK_VISITER_APPARTEMENT (IDAPPART)
      REFERENCES APPARTEMENT (IDAPPART) ;

