DROP TABLE  IF EXISTS panier,commande, produit, user, typeProduit, etat;

-- --------------------------------------------------------
-- Structure de la table typeproduit
--
CREATE TABLE IF NOT EXISTS typeProduit (
  id_type int(10) NOT NULL,
  libelle varchar(50) DEFAULT NULL,
  PRIMARY KEY (id_type)
)  DEFAULT CHARSET=utf8;
-- Contenu de la table typeproduit
INSERT INTO typeProduit (id_type, libelle) VALUES
(1, 'type 1'),
(2, 'type 2'),
(3, 'type 3');

-- --------------------------------------------------------
-- Structure de la table etat

CREATE TABLE IF NOT EXISTS etat (
  id_etat int(11) NOT NULL AUTO_INCREMENT,
  libelle varchar(20) NOT NULL,
  PRIMARY KEY (id_etat)
) DEFAULT CHARSET=utf8 ;
-- Contenu de la table etat
INSERT INTO etat (id_etat, libelle) VALUES
(1, 'A préparer'),
(2, 'Expédié');

-- --------------------------------------------------------
-- Structure de la table produit

CREATE TABLE IF NOT EXISTS produit (
  id int(10) NOT NULL AUTO_INCREMENT,
  id_type int(10) DEFAULT NULL,
  nom varchar(50) DEFAULT NULL,
  prix float(3,2) DEFAULT NULL,
  photo varchar(50) DEFAULT NULL,
  dispo tinyint(4) NOT NULL,
  stock int(11) NOT NULL,
  PRIMARY KEY (id),
  KEY id_type (id_type),
  CONSTRAINT produit_fk_1 FOREIGN KEY (id_type) REFERENCES typeProduit (id_type)
) DEFAULT CHARSET=utf8 ;

INSERT INTO produit (id,id_type,nom,prix,photo,dispo,stock) VALUES
(1,1, 'produit 1','100',NULL,1,5),
(2,1, 'produit 2','5.5',NULL,1,4),
(3,2, 'produit 3','8.5',NULL,1,10);


-- --------------------------------------------------------
-- Structure de la table user

CREATE TABLE IF NOT EXISTS user (
  id_user int(11) NOT NULL AUTO_INCREMENT,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  login varchar(255) NOT NULL,
  nom varchar(255) NOT NULL,
  code_postal varchar(255) NOT NULL,
  ville varchar(255) NOT NULL,
  adresse varchar(255) NOT NULL,
  valide tinyint NOT NULL,
  droit tinyint NOT NULL,
  PRIMARY KEY (id_user)
) DEFAULT CHARSET=utf8;

# Contenu de la table user
INSERT INTO user (id_user,login,password,email,valide,droit) VALUES
(1, 'admin', 'admin', 'admin@gmail.com',1,2),
(2, 'vendeur', 'vendeur', 'vendeur@gmail.com',1,2),
(3, 'client', 'client', 'client@gmail.com',1,1),
(4, 'client2', 'client2', 'client2@gmail.com',1,1),
(5, 'client3', 'client3', 'client3@gmail.com',1,1);




CREATE TABLE IF NOT EXISTS commande (
  id_commande int(11) NOT NULL AUTO_INCREMENT,
  id_user int(11) NOT NULL,
  id_lieu int(11) NOT NULL,
  prix float(5,2) NOT NULL,
  date_achat date NOT NULL,
  id_etat int(11) NOT NULL,
  PRIMARY KEY (id_commande),
  KEY id_user (id_user),
  KEY id_lieu (id_lieu),
  KEY id_etat (id_etat)
) DEFAULT CHARSET=utf8 ;



-- --------------------------------------------------------
-- Structure de la table panier
CREATE TABLE IF NOT EXISTS panier (
  id_panier int(11) NOT NULL AUTO_INCREMENT,
  id_user int(11) NOT NULL,
  id_produit int(11) NOT NULL,
  quantite int(11) NOT NULL,
  prix float(5,2) NOT NULL,
  id_commande int(1) NOT NULL,
  dateAjoutPanier datetime NOT NULL,
  PRIMARY KEY (id_panier),
  KEY id_user (id_user),
  KEY id_produit (id_produit)
) DEFAULT CHARSET=utf8 ;


--
-- Contraintes pour la table commande
--
ALTER TABLE commande
  ADD CONSTRAINT commande_fk_1 FOREIGN KEY (id_user) REFERENCES user (id_user),
  ADD CONSTRAINT commande_fk_2 FOREIGN KEY (id_etat) REFERENCES etat (id_etat);

--
-- Contraintes pour la table panier
--
ALTER TABLE panier
  ADD CONSTRAINT panier_fk_1 FOREIGN KEY (id_user) REFERENCES user (id_user),
  ADD CONSTRAINT panier_fk_2 FOREIGN KEY (id_produit) REFERENCES produit (id),
  ADD CONSTRAINT panier_fk_3 FOREIGN KEY (id_commande) REFERENCES commande (id_commande);


