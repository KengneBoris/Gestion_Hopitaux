-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 14 juin 2023 à 10:53
-- Version du serveur :  10.3.14-MariaDB
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestion_hopital`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

DROP TABLE IF EXISTS `appartient`;
CREATE TABLE IF NOT EXISTS `appartient` (
  `ID_CONSULTATION` int(11) NOT NULL,
  `ID_MEDICAMENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_CONSULTATION`,`ID_MEDICAMENT`),
  KEY `I_FK_APPARTIENT_CONCULTATION` (`ID_CONSULTATION`),
  KEY `I_FK_APPARTIENT_MEDICAMENT` (`ID_MEDICAMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `concultation`
--

DROP TABLE IF EXISTS `concultation`;
CREATE TABLE IF NOT EXISTS `concultation` (
  `ID_CONSULTATION` int(11) NOT NULL AUTO_INCREMENT,
  `DATE` date DEFAULT NULL,
  `INFORMATION` varchar(255) DEFAULT NULL,
  `ID_PATIENT` int(11) NOT NULL,
  `ID_PERSONNEL` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_CONSULTATION`),
  KEY `ID_PATIENT` (`ID_PATIENT`),
  KEY `ID_PERSONNEL` (`ID_PERSONNEL`),
  KEY `ID_PATIENT_2` (`ID_PATIENT`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `concultation`
--

INSERT INTO `concultation` (`ID_CONSULTATION`, `DATE`, `INFORMATION`, `ID_PATIENT`, `ID_PERSONNEL`) VALUES
(9, '2023-05-24', 'irl5nHaF1twfRJlO/kc04MNM43ltN9ppYcEgChPI3uRdY3kXl40XmyXsQQmXxXBygRFvCyixxAmk+M77UjruVLD7NLfQdG3he5C9uiOHEQqMzjG/q9lVtshAHryTNCsz', 2, 1),
(10, '2023-05-25', 'cCKKfFMZlqz/mlCXgCDt0Vr/cHmlEfkCjwkoWp/nVvJs2JQLwBWlMCqXGrC1rh6f', 1, 1),
(12, '2023-05-25', 'nl/bFQrHHCavoAu6R2bby9ANRDGIUHZhd76+qJRPTn8=', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `dossier_patient`
--

DROP TABLE IF EXISTS `dossier_patient`;
CREATE TABLE IF NOT EXISTS `dossier_patient` (
  `ID_DOSSIER` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_DOSSIER` varchar(256) NOT NULL,
  `date_enregistrement` date NOT NULL,
  `ID_PERSONNEL` int(11) NOT NULL,
  `ID_PATIENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_DOSSIER`),
  KEY `ID_PATIENT` (`ID_PATIENT`),
  KEY `ID_PERSONNEL` (`ID_PERSONNEL`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dossier_patient`
--

INSERT INTO `dossier_patient` (`ID_DOSSIER`, `NOM_DOSSIER`, `date_enregistrement`, `ID_PERSONNEL`, `ID_PATIENT`) VALUES
(1, '/uwgx+Q9hbxRzvDb2+qNNBnR0/DSzQoSId325x4pkaA=', '2023-05-24', 5, 1),
(2, 'gBz07Ror4p2V9/EcnBZ9qCwhLnpyTkXWcauadh4PJJ4=', '2023-05-24', 5, 2),
(4, 'tFeGhSAvq09csRgStKO14bS72NYJ9G2dzlvmlTIPwSw=', '2023-05-25', 5, 4);

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

DROP TABLE IF EXISTS `medicament`;
CREATE TABLE IF NOT EXISTS `medicament` (
  `ID_MEDICAMENT` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PHAMACIER` int(11) NOT NULL,
  `NOM` varchar(128) DEFAULT NULL,
  `QUANTITE` int(11) DEFAULT NULL,
  `PRIX` int(11) DEFAULT NULL,
  `date1` date NOT NULL,
  PRIMARY KEY (`ID_MEDICAMENT`),
  KEY `I_FK_MEDICAMENT_CHEF_PHAMACIER` (`ID_PHAMACIER`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `medicament`
--

INSERT INTO `medicament` (`ID_MEDICAMENT`, `ID_PHAMACIER`, `NOM`, `QUANTITE`, `PRIX`, `date1`) VALUES
(15, 1, 'para11', 1000, 200, '2023-05-18'),
(16, 1, 'para', 10000, 200, '2023-05-04'),
(17, 1, 'paracetamole', 4, 2000, '2023-05-04');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `ID_PAIEMENT` int(11) NOT NULL,
  `ID_CONSULTATION` int(11) NOT NULL,
  `ID_PHAMACIER` int(11) NOT NULL,
  `MONTANT` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_PAIEMENT`),
  KEY `I_FK_PAIEMENT_CONCULTATION` (`ID_CONSULTATION`),
  KEY `I_FK_PAIEMENT_CHEF_PHAMACIER` (`ID_PHAMACIER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `ID_PATIENT` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USER` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `prenom` varchar(256) NOT NULL,
  `sexe` varchar(256) NOT NULL,
  `date_naissance` date NOT NULL,
  `tel` varchar(256) NOT NULL,
  `date_ajout` date NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_PATIENT`),
  KEY `fk_user` (`ID_USER`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`ID_PATIENT`, `ID_USER`, `nom`, `prenom`, `sexe`, `date_naissance`, `tel`, `date_ajout`, `photo`) VALUES
(1, 1, 'SC9CjZi/zVKU/IQP7W2SHtuvtZuDzBOqrtYeXNqA9Us=', 'sc4jvhvJJGC9vAMTbTLT2mh3koTz8vZTJccNTiQPNLk=', '9SanrVfORZSW0jS/DujGyMIOsKUrLxVkXabqCdcWwjo=', '2023-05-03', 'fxfO3LYv1SnSKiRoEd4Ja+vlsmHjZdH13SCmpJzitAM=', '2023-05-24', 'images/1/image1.jpg'),
(2, 1, 'Kptp1yuy1Odv9sEn3aLZoht83C7Koa+spuDscxX2oqE=', 'NjA5cUE8gFEFsXSRCM2Bso0Xx+GnLu67pa9lS8Z6nP4=', 'Vu4Yj/kxE5yGXjahEe9F+neUDAXfqxZnmKjgtBGDXB8=', '2023-05-02', 'Qn4mQL381iSkxjGPn52FU0MoYxsp5lCHRZ+0Np7/RAs=', '2023-05-24', 'images/2/image2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `rendre_vous`
--

DROP TABLE IF EXISTS `rendre_vous`;
CREATE TABLE IF NOT EXISTS `rendre_vous` (
  `ID_RENDE` char(32) NOT NULL,
  `ID_PATIENT` int(11) NOT NULL,
  `ID_PERSONNEL` int(11) NOT NULL,
  `NOM` varchar(128) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `HEURE` time DEFAULT NULL,
  PRIMARY KEY (`ID_RENDE`),
  KEY `I_FK_RENDRE_VOUS_PATIENT` (`ID_PATIENT`),
  KEY `I_FK_RENDRE_VOUS_PERSONNEL` (`ID_PERSONNEL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `LOGIN1` varchar(128) NOT NULL,
  `mots_passe` varchar(128) NOT NULL,
  `NOM` varchar(128) DEFAULT NULL,
  `PRENOM` varchar(128) DEFAULT NULL,
  `ADRESS` varchar(128) DEFAULT NULL,
  `TEL` int(11) DEFAULT NULL,
  `TYPE` varchar(128) DEFAULT NULL,
  `etat` varchar(128) NOT NULL DEFAULT 'active',
  `date1` date NOT NULL,
  PRIMARY KEY (`ID_USER`),
  UNIQUE KEY `mots_passe` (`mots_passe`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID_USER`, `LOGIN1`, `mots_passe`, `NOM`, `PRENOM`, `ADRESS`, `TEL`, `TYPE`, `etat`, `date1`) VALUES
(1, 'kamela', '$2y$10$VGjxJbKFgc3ac754NNWQYOqdNM5f3/.lYiYR7PpuafrR9HSJDaRBC', 'kamela', 'kamela', 'bandjoun', 670875526, 'administrateur', 'active', '2023-05-05'),
(5, 'kadji', '$2y$10$8i/13g.IGSaYiSxs9ie4Fe1vuhOGRaSMXC5Wv5ccYGYXMXNjmVmMe', 'kadji', 'kadji', 'bandjoun/ouest', 677889955, 'medecin', 'active', '2023-05-20'),
(11, 'elisee', '$2y$10$Vr3v3R2JhZvKOG4u84u8Fec1PmO/jFRF0CUbd4h0UYtQpAg1lmCDS', 'Guepy', 'elisee', 'bandjoun/ouest', 691129769, 'pharmacien', 'active', '2023-05-20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
