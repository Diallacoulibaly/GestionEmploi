-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 18 mai 2024 à 16:43
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `emplois_du_temps`
--

-- --------------------------------------------------------

--
-- Structure de la table `emploi_du_temps`
--

CREATE TABLE `emploi_du_temps` (
  `id` int(11) NOT NULL,
  `seance` varchar(50) DEFAULT NULL,
  `jour` varchar(50) DEFAULT NULL,
  `matiere` varchar(50) DEFAULT NULL,
  `salle` varchar(50) DEFAULT NULL,
  `groupe` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `emploi_du_temps`
--

INSERT INTO `emploi_du_temps` (`id`, `seance`, `jour`, `matiere`, `salle`, `groupe`) VALUES
(1, 'Seance2', 'Mercredi', 'Anglais', 'salle3', 'DEV101'),
(2, 'Seance2', 'Lundi', 'Approche agile', 'salle3', 'DEV102'),
(4, 'Seance1', 'Vendredi', 'Français', 'salle_info2', 'DEV101'),
(11, 'Seance2', 'Lundi', 'Anglais', 'salle_info1', 'DEV101'),
(12, 'Seance3', 'Mardi', 'Excel', 'salle_info1', 'DEV101'),
(13, 'Seance1', 'Samedi', 'Préparation Web', 'salle4', 'DEV101'),
(14, 'Seance1', 'Lundi', 'Laravel', 'salle_info1', 'DEV101'),
(15, 'Seance1', 'Mardi', 'Approche agile', 'salle_info2', 'DEV101'),
(16, 'Seance1', 'Mercredi', 'Laravel', 'salle_info2', 'DEV101'),
(17, 'Seance1', 'Mercredi', 'Anglais', 'salle3', 'DEV101'),
(18, 'Seance1', 'Lundi', 'Approche agile', 'salle3', 'DEV101');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id_filiere` int(11) NOT NULL,
  `nom_filiere` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`id_filiere`, `nom_filiere`) VALUES
(1, 'Developement digital');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id_groupe` int(11) NOT NULL,
  `groupe` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id_groupe`, `groupe`) VALUES
(1, 'DEV101'),
(2, 'DEV102'),
(3, 'DEV201'),
(4, 'DEV202');

-- --------------------------------------------------------

--
-- Structure de la table `jours_semaine`
--

CREATE TABLE `jours_semaine` (
  `id` int(11) NOT NULL,
  `jour_nom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jours_semaine`
--

INSERT INTO `jours_semaine` (`id`, `jour_nom`) VALUES
(1, 'Lundi'),
(2, 'Mardi'),
(3, 'Mercredi'),
(4, 'Jeudi'),
(5, 'Vendredi'),
(6, 'Samedi');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `Code_ma` int(11) NOT NULL,
  `Nom_ma` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`Code_ma`, `Nom_ma`) VALUES
(1, 'Français'),
(2, 'Anglais'),
(3, 'Approche agile'),
(4, 'React'),
(5, 'Base de donnée'),
(6, 'Laravel'),
(7, 'Excel'),
(8, 'Préparation Web'),
(9, 'Cloud native'),
(10, 'Word');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `Code_sal` int(11) NOT NULL,
  `Nom_sal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`Code_sal`, `Nom_sal`) VALUES
(1, 'salle3'),
(2, 'salle4'),
(3, 'salle_info1'),
(4, 'salle_info2');

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE `seance` (
  `id` int(11) DEFAULT NULL,
  `seance` varchar(50) DEFAULT NULL,
  `heure_D` time DEFAULT NULL,
  `heure_F` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `seance`
--

INSERT INTO `seance` (`id`, `seance`, `heure_D`, `heure_F`) VALUES
(1, 'Seance1', '08:30:00', '10:20:00'),
(2, 'Seance2', '10:30:00', '13:30:00'),
(3, 'Seance3', '13:30:00', '15:30:00'),
(4, 'Seance4', '15:40:00', '18:30:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `emploi_du_temps`
--
ALTER TABLE `emploi_du_temps`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id_filiere`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id_groupe`);

--
-- Index pour la table `jours_semaine`
--
ALTER TABLE `jours_semaine`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`Code_ma`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `emploi_du_temps`
--
ALTER TABLE `emploi_du_temps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id_filiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id_groupe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `jours_semaine`
--
ALTER TABLE `jours_semaine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
