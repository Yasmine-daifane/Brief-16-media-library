CREATE TABLE adhérent (
   Id_adhérent INT AUTO_INCREMENT,
   adresse VARCHAR(63) NOT NULL,
   email VARCHAR(60),
   phone INT,
   CIN VARCHAR(50),
   birth_date DATE NOT NULL,
   occupation VARCHAR(53),
   pénalité INT NOT NULL,
   compte_date DATE NOT NULL,
   Nickname VARCHAR(59),
   password VARCHAR(63),
   full_name VARCHAR(50),
   role BOOLEAN,
   PRIMARY KEY(Id_adhérent),
   UNIQUE(email),
   UNIQUE(phone),
   UNIQUE(CIN)
);

CREATE TABLE ouvrage (
   Id_ouvrage INT AUTO_INCREMENT,
   titre VARCHAR(50) NOT NULL,
   nom_de_l_auteur VARCHAR(50) NOT NULL,
   l_mage_de_couverture VARCHAR(50),
   l_etat VARCHAR(50) NOT NULL,
   type VARCHAR(50) NOT NULL,
   date_d_achat DATE NOT NULL,
   la_date_d_édition DATE NOT NULL,
   N_pages INT NOT NULL,
   PRIMARY KEY(Id_ouvrage),
   UNIQUE(l_mage_de_couverture)
);

CREATE TABLE reservation (
   Id_reservation INT AUTO_INCREMENT,
   date_de_reservation DATE NOT NULL,
   la_date_d_exper DATE NOT NULL,
   Id_ouvrage INT NOT NULL,
   Id_adhérent INT NOT NULL,
   PRIMARY KEY(Id_reservation),
   FOREIGN KEY(Id_ouvrage) REFERENCES ouvrage(Id_ouvrage),
   FOREIGN KEY(Id_adhérent) REFERENCES adhérent(Id_adhérent)
);

CREATE TABLE l_emprunt (
   Id_l_emprunt INT AUTO_INCREMENT,
   la_date_d_emprunt DATE NOT NULL,
   la_date_du_retour DATE NOT NULL,
   Id_adhérent INT NOT NULL,
   Id_reservation INT NOT NULL,
   Id_ouvrage INT NOT NULL,
   PRIMARY KEY(Id_l_emprunt),
   UNIQUE(Id_reservation),
   FOREIGN KEY(Id_adhérent) REFERENCES adhérent(Id_adhérent),
   FOREIGN KEY(Id_reservation) REFERENCES reservation(Id_reservation),
   FOREIGN KEY(Id_ouvrage) REFERENCES ouvrage(Id_ouvrage)
);
