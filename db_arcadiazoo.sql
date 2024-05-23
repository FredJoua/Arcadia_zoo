-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2024 at 05:16 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_arcadiazoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(10) UNSIGNED NOT NULL,
  `objet` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `description_message` text,
  `date_validation` datetime DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statut` varchar(250) NOT NULL DEFAULT 'En attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id_contact`, `objet`, `email`, `description_message`, `date_validation`, `date_creation`, `statut`) VALUES
(1, 'Les horaires d\'ouverture', 'mpanpan@mail.com', 'pouvez vous nous indiquez les horaires d\'ouverture?', '2024-05-16 01:11:01', '2024-05-15 22:29:57', 'Répondu'),
(2, 'Demande prix ', 'email@hotmail.com', 'Pouvez vous nous indiquer le prix pour les moins de 12 ans?\r\nmerci d\'avance.', NULL, '2024-05-15 22:40:18', 'En attente'),
(3, 'Jour férié', 'coucou@mail.com', 'Pouvez vous nous dire si vous êtes ouvert le 1er mai?', NULL, '2024-05-15 22:46:48', 'En attente'),
(4, 'Restaurant', 'mamamia@lunch.com', 'Avez vous un restaurant fast food dans votre Zoo?', NULL, '2024-05-15 22:49:52', 'En attente'),
(5, 'Horaires', 'mimi@gmail.com', 'renseignement pour les horaires', '2024-05-16 19:31:34', '2024-05-16 17:30:28', 'Répondu');

-- --------------------------------------------------------

--
-- Table structure for table `employes`
--

CREATE TABLE `employes` (
  `id_employe` int(10) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `motdepasse` varchar(100) NOT NULL,
  `role_profession` varchar(50) NOT NULL,
  `code_profession` smallint(4) NOT NULL DEFAULT '0',
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `miseajour_le` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `statut` varchar(10) NOT NULL DEFAULT 'actif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employes`
--

INSERT INTO `employes` (`id_employe`, `nom`, `prenom`, `email`, `motdepasse`, `role_profession`, `code_profession`, `date_creation`, `miseajour_le`, `statut`) VALUES
(1, 'MARIN', 'Arthur', 'aMARIN@arcadiazoo.com', 'ma12345', 'Est Employé', 101, '2024-05-04 13:13:35', '2024-05-09 20:11:35', 'actif'),
(2, 'Pari', 'José', 'pari.jose@arcadiazoo.com', 'motdepasse', 'Directeur', 777, '2024-05-04 15:52:10', '2024-05-04 17:52:10', 'actif'),
(3, 'OUTEST', 'Papa', 'pOUTEST@arcadiazoo.com', 'op12345', 'Est Autre', 301, '2024-05-08 13:37:14', '2024-05-09 20:10:04', 'actif'),
(4, 'VUITON', 'Louis', 'lVUITON@arcadiazoo.com', 'vl12345', 'Est Vétérinaire', 201, '2024-05-08 14:59:11', '2024-05-09 20:04:28', 'actif'),
(5, 'TINTIN', 'Etmilou', 'eTINTIN@arcadiazoo.com', 'te12345', 'Est Employé', 101, '2024-05-09 16:10:44', '2024-05-09 21:12:53', 'actif'),
(6, 'CHANEL', 'Coco', 'cCHANEL@arcadiazoo.com', 'cc12345', 'Est Vétérinaire', 201, '2024-05-09 19:57:18', '2024-05-09 23:57:38', 'actif'),
(7, 'JEANNOT', 'Lapin', 'lJEANNOT@arcadiazoo.com', 'jl12345', 'Est Vétérinaire', 201, '2024-05-16 15:34:48', '2024-05-16 20:09:02', 'inactif');

-- --------------------------------------------------------

--
-- Table structure for table `habitats`
--

CREATE TABLE `habitats` (
  `id_habitat` int(10) UNSIGNED NOT NULL,
  `habitat` varchar(50) NOT NULL,
  `description_habitat` varchar(255) NOT NULL DEFAULT 'Aucune description',
  `img` longblob,
  `prenom_animal` varchar(100) DEFAULT NULL,
  `race` varchar(100) NOT NULL,
  `etat_sante` varchar(100) NOT NULL,
  `detail_sante` varchar(100) DEFAULT NULL,
  `nourriture` varchar(100) DEFAULT NULL,
  `grammage` int(11) DEFAULT NULL COMMENT 'en gr',
  `date_visite` timestamp NULL DEFAULT NULL,
  `date_repas_pris` timestamp NULL DEFAULT NULL,
  `heure_repas_pris` time DEFAULT NULL,
  `miseajour_le` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `habitats`
--

INSERT INTO `habitats` (`id_habitat`, `habitat`, `description_habitat`, `img`, `prenom_animal`, `race`, `etat_sante`, `detail_sante`, `nourriture`, `grammage`, `date_visite`, `date_repas_pris`, `heure_repas_pris`, `miseajour_le`) VALUES
(2, 'Savane', 'Dans cette vaste plaine de 3 hectares, venez à la rencontre des animaux les plus emblématiques d\'Afrique', 0x75706c6f6164732f4c696f6e2e6a70672c75706c6f6164732f4c696f6e312e6a70672c75706c6f6164732f4c696f6e332e6a7067, 'Simba', 'Lion Blanc', 'Santé très bonne', 'Plein d\'énergie, bagarreur, à très bon appétit, et rapide', 'Sangliers, ', 3500, '2024-05-01 22:00:00', '2024-05-17 22:00:00', '12:53:00', '2024-05-23 15:25:22'),
(3, 'Jungle', 'Bienvenue au coeur de la jungle équatoriale à la rencontre des animaux les plus fascinants au monde : fauves féroces, imposants gorilles, étonnants paresseux, flamboyants toucans ou serpents gigantesques', 0x75706c6f6164732f4f7572616e674f7574616e67312e6a70672c75706c6f6164732f4f7572616e674f7574616e67332e6a70672c75706c6f6164732f4f7572616e674f7574616e67372e6a7067, 'Kiki', 'Ourang Outang', 'Bonne', 'Petit bébé de 6mois, ne mange toujours pas seul, s\'accroche beaucoup à sa maman', 'Lait, vitamines, fruits', 1500, '2024-05-17 22:00:00', '2024-05-20 22:00:00', '10:30:00', '2024-05-23 02:53:42');

-- --------------------------------------------------------

--
-- Table structure for table `visiteurs`
--

CREATE TABLE `visiteurs` (
  `id_visiteur` int(10) UNSIGNED NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `commentaires` varchar(250) NOT NULL,
  `date_validation` datetime DEFAULT NULL,
  `statut` varchar(50) NOT NULL DEFAULT 'En attente',
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visiteurs`
--

INSERT INTO `visiteurs` (`id_visiteur`, `pseudo`, `commentaires`, `date_validation`, `statut`, `date_creation`) VALUES
(1, 'Frediee', 'Zoo très grand avec de nombreux variétés d\'animaux. \r\nJe recommande vivement !', '2024-05-12 17:58:39', 'Publié', '2024-05-09 21:13:15'),
(2, 'LouLou', 'J\'adore ce Zoo, j\'habite à proximité, donc j\'ai pris un abonnement à l\'année, alors je peux y aller tous les jours!', '2024-05-10 23:07:21', 'Publié', '2024-05-10 21:06:51'),
(4, 'Ouistiti', 'On se sent comme chez soi. Je reviendrais!', '2024-05-16 19:51:23', 'Rejeté', '2024-05-15 19:54:06'),
(5, 'Mimi', 'Superrrrrrrrrr!', '2024-05-16 19:26:48', 'Publié', '2024-05-16 17:25:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`id_employe`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `motdepasse` (`motdepasse`);

--
-- Indexes for table `habitats`
--
ALTER TABLE `habitats`
  ADD PRIMARY KEY (`id_habitat`);

--
-- Indexes for table `visiteurs`
--
ALTER TABLE `visiteurs`
  ADD PRIMARY KEY (`id_visiteur`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employes`
--
ALTER TABLE `employes`
  MODIFY `id_employe` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `habitats`
--
ALTER TABLE `habitats`
  MODIFY `id_habitat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visiteurs`
--
ALTER TABLE `visiteurs`
  MODIFY `id_visiteur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
