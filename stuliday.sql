-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 01 sep. 2020 à 15:17
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stuliday`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `address_article` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  `price` int(255) NOT NULL,
  `author_article` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id`, `title`, `description`, `city`, `category`, `image_url`, `address_article`, `active`, `price`, `author_article`, `start_date`, `end_date`, `publish_date`) VALUES
(2, 'Appartement Chic Upper East Side ', 'Dans une résidence surveillée en plein coeur de l\'Upper East Side, service restauration et chauffeurs. Appartement Chic 4 pièces en hauteur vue sur central park', 'New York', 't4', 'annonces/img/5f476d6017888_upper.jpg', '160 East 80st Street', 1, 890, 2, '2020-09-20', '2020-09-30', '2020-08-27 08:22:56'),
(3, 'Appartement Bordeaux quartier saint Michel', 'Au coeur du quartier Saint Michel appartement 3 pièces à proximité des lignes de tramway A et B', 'Bordeaux', 't3', 'annonces/img/5f4cb2260b2c9_bdx.jpg', '5 rue des Menuts 33000', 0, 30, 1, '2020-09-25', '2020-09-30', '2020-08-27 08:31:00'),
(4, 'Maison 4 pièces, Saratoga Springs, Etat de New York', 'A Saratoga Springs, la ville de résidence de Solomon Northup, écrivain et figure importante de l\'abolitionnisme.', 'Saratoga Springs', 't4', 'annonces/img/5f4cc94c9dab0_saratoga.jpg', '4 Madison Ave, NY 12866', 1, 550, 3, '2020-10-10', '2020-10-31', '2020-08-27 13:40:23'),
(14, 'Appartement de Luxe 4 pièces', 'Au coeur de Paris, appartement de luxe, grande luminosité à Saint-Germain-des-Prés 6ème arrondissement', 'Paris', 't4', 'annonces/img/5f48e96e984ee_appart.jpg', '3 place Saint-Germain-des-Prés', 1, 300, 2, '2020-08-30', '2020-09-06', '2020-08-28 07:58:40'),
(15, 'Appartement 1 pièce Washington DC', 'Transport public le plus proche: Navy Yard-Ballpark. Transport en commun vers le centre-ville: 25 min.', 'Washington D.C.', 't1', 'annonces/img/5f4ca373d3d6e_Washington.jpg', '816 Potomac  Avenue Southeast', 1, 180, 3, '2020-10-14', '2020-10-28', '2020-08-31 07:13:25'),
(16, 'Appartement Bordeaux centre', 'Colocation plein centre de Bordeaux, 2 personnes louent une chambre, proximité tramway A, Pey Berlan près de la Cathédrale', 'Bordeaux', 't3', 'annonces/img/5f4ca5dbe30a7_appartement-vintage.jpg', 'Cours Alsace Lorraine', 1, 25, 4, '2020-09-25', '2020-10-01', '2020-08-31 07:23:40');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_annonce` int(11) NOT NULL,
  `dateReservation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `id_user`, `id_annonce`, `dateReservation`) VALUES
(19, 2, 3, '2020-08-31 12:31:16');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstName`, `lastName`) VALUES
(1, 'marion@mail.com', '$2y$10$TlcGweFllHHgqRMR92t87OZYrbNpkJrgM9iQEjQQVvdjSBFsG7S0.', 'Marion', 'Londero'),
(2, 'scully@fbimail.com', '$2y$10$1XnSRi.HdO7U8Kyvnhqv2OiA9dByJcN7rA/wZQ03D.zDKldFVx5Vi', 'Dana', 'Scully'),
(3, 'mulder@fbimail.com', '$2y$10$4MwPXoaqWMng85xatQJ.kOI4FQV/QFNr2Jw7XIGv7ffLW2bT1..Bm', 'Fox', 'Mulder'),
(4, 'dino@mail.com', '$2y$10$qS4/eAxlJjgKXBbb6OtDaeYNNOKyC5huph2eTukspuJqKv0uYwozS', 'Tyranosaure', 'Rex'),
(6, 'admin@mail.com', '$2y$10$G2Hp8xavzc6i4SZkXtNtyevYNgp1LMG7QbZgaeovofsnWapEN2PUG', 'Admin', 'Admin'),
(7, 'fake@mail.com', '$2y$10$ACqRgk8cp7sMRNRkS7J9oO/FRR0Hq8ugfk1O3vamTzwNyFakErrWC', 'fake', 'fake');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_article` (`author_article`) USING BTREE;

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_annonce` (`id_annonce`),
  ADD KEY `reservations_ibfk_2` (`id_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`author_article`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_annonce`) REFERENCES `annonces` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
