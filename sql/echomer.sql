-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 09 Mai 2017 à 14:56
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `echomer`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom` varchar(250) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(250) COLLATE utf8_bin NOT NULL,
  `adresse` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `codepostal` int(8) DEFAULT NULL,
  `ville` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `num_tel` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `date_naissance` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `commentaires` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nb_achats` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `adresse`, `codepostal`, `ville`, `num_tel`, `date_naissance`, `commentaires`, `nb_achats`) VALUES
(1, 'BRISSET', 'Alan', '71 avenue de Bonnemie', 17000, 'La Rochelle', '0699672892', '30/09/1996', 'Il a fait un stage !', 0),
(2, 'DURAND', 'Bertrand', 'NULL', 17000, 'La Rochelle', '0687412100', 'NULL', 'NULL', 0),
(3, 'TARTO', 'Philippe', 'NULL', 17000, 'La Rochelle', 'NULL', 'NULL', '', 0),
(4, 'NARTAL', 'Pierre', 'NULL', 17310, 'St Pierre d\'Oléron', '', '', '', 0),
(5, 'NALAFE', 'Jérôme', 'NULL', 0, 'NULL', '', 'NULL', '', 0),
(6, 'PRALAPO', 'Martial', '', 0, '', '', '', '', 0),
(11, 'BRISSET', 'Nils', '', 0, '', '', '', 'L\'été', 0);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id_fournisseur` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `adresse` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `numtel` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `produitsfournis` varchar(255) COLLATE utf8_bin NOT NULL,
  `frequent` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `descriptif` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `prix` float NOT NULL,
  `cout` float DEFAULT NULL,
  `materiaux` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom`, `descriptif`, `prix`, `cout`, `materiaux`) VALUES
(1, 'Pouf', 'Pouf constituÃ© de liÃ¨ge, prÃªt Ã  Ãªtre utilisÃ© !', 20.15, 8, 'LIEGE');

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

CREATE TABLE `vente` (
  `id_vente` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` float NOT NULL,
  `date_achat` date DEFAULT NULL,
  `moyen_payement` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `commentaires_vente` varchar(250) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `nom` (`nom`(60),`prenom`(60));

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id_fournisseur`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD UNIQUE KEY `uniq_productname` (`nom`(60));

--
-- Index pour la table `vente`
--
ALTER TABLE `vente`
  ADD PRIMARY KEY (`id_vente`),
  ADD KEY `FK_idclientvente` (`id_client`),
  ADD KEY `FK_idproduitvente` (`id_produit`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id_fournisseur` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `vente`
--
ALTER TABLE `vente`
  MODIFY `id_vente` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `FK_idclientvente` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `FK_idproduitvente` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
