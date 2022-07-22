-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 17 juil. 2022 à 20:04
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ionicfoundlost`
--

-- --------------------------------------------------------

--
-- Structure de la table `foundlost`
--

CREATE TABLE `foundlost` (
  `id_object` int(3) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `location` text NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `checkedpicture` tinyint(5) NOT NULL DEFAULT '0',
  `picture` mediumblob,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `foundlost`
--

INSERT INTO `foundlost` (`id_object`, `status`, `description`, `date`, `location`, `firstname`, `lastname`, `email`, `checkedpicture`, `picture`, `file`) VALUES
(12, 1, 'bateau', '2022-07-11', 'chambery', 'rudolphe', 'maurice', 'jkasperski@free.fr', 0, NULL, NULL),
(13, 1, 'bateau1', '2022-07-11', 'paris', 'georges', 'bouba', 'jkasperski@free.fr', 0, NULL, NULL),
(14, 1, 'canard', '2022-07-03', 'paris', 'france', 'toner', 'jkasperski@free.fr', 0, NULL, NULL),
(15, 1, 'éléphant rose', '2022-07-03', 'paris', 'france', 'toner', 'jkasperski@free.fr', 0, NULL, NULL),
(16, 1, 'bouba', '2022-07-03', 'paris', 'france', 'toner', 'jkasperski@free.fr', 0, NULL, NULL),
(17, 0, 'bouba', '2022-07-03', 'paris', 'france', 'toner', 'jkasperski@free.fr', 0, NULL, NULL),
(19, 1, 'télévision', '2022-07-11', 'paris', 'octave ', 'note', 'jkasperski@free.fr', 0, NULL, NULL),
(20, 1, 'bonnet', '2022-07-04', 'grenoble', 'lapin', 'isidor', 'jkasperski@free.fr', 0, NULL, NULL),
(23, 0, 'collier sans perle', '2022-07-06', 'grenoble', 'eloise', 'ducan', 'jk@fer.fr', 0, NULL, NULL),
(29, 1, 'tunique', '2022-07-11', 'vdvdvdvd', 'vdvdvdvd', 'vdvdvdvdvd', 'jkasperski@freer.fr', 0, NULL, NULL),
(30, 0, 'souris en diament', '2022-07-17', 'paris', 'camille', 'vincent', 'c.vinent@toto.fr', 0, NULL, NULL),
(31, 0, 'tutu', '2022-07-11', 'hong kong', 'xiam', 'pi', 'x.pi@free.fr', 0, NULL, NULL),
(33, 0, 'cvxvxcvcxvcx', '2022-07-17', 'ccdddccd', 'cdcdcd', 'cdcdcdcdcdc', 'JKASPERSKI@FREE.FR', 0, NULL, NULL),
(34, 1, 'ma télévision 32cm', '2022-07-17', 'immeuble alfred de musset', 'octave', 'baroque', 'o.baroque@tv.fr', 0, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `foundlost`
--
ALTER TABLE `foundlost`
  ADD PRIMARY KEY (`id_object`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `foundlost`
--
ALTER TABLE `foundlost`
  MODIFY `id_object` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
