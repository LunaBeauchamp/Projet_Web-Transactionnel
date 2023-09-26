-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 12 sep. 2023 à 18:01
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
-- Base de données : `bdboutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `couriel` varchar(75) NOT NULL,
  `motdepasse` varchar(50) NOT NULL,
  `role` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`couriel`, `motdepasse`, `role`, `status`) VALUES
('admin@eliteautomobile.com', 'admin', 'A', 'A');

-- --------------------------------------------------------

--
-- Structure de la table `inventaireVoiture`
--

CREATE TABLE `inventaireVoiture` (
  `idVoiture` int(3) NOT NULL,
  `nomvoiture` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `couleur` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `prix` int(10) NOT NULL,
  `quantite` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `inventaireVoiture`
--

INSERT INTO `inventaireVoiture` (`idVoiture`, `nomvoiture`, `description`, `couleur`, `image`, `prix`, `quantite`) VALUES
(1, 'Rolls-Royce Phantom', 'La berline de très grand luxe qui n’a plus aucune rivale directe ne se mesure qu’aux caprices de ses richissimes acheteurs. Elle leur offre une infinité ou presque d’options de personnalisation. Son V12 turbocompressé de 6,75 litres sous le capot fournit une puissance de 563 chevaux, mais il n’y a toujours pas de version Black Badge comme avec les Cullinan et Ghost. En revanche, il faut souligner que la Phantom profite de retouches esthétiques pour 2023.', 'bleu', 'https://hips.hearstapps.com/hmg-prod/images/2024-rolls-royce-phantom-102-64bad70ba7661.jpg ', 625000, 10),
(2, 'Bentley Flying Spur', 'Véritable salon anglais sur quatre roues, la berline Flying Spur représente tout le savoir faire de Bentley. Trois motorisations sont disponibles : un V6 hybride rechargeable de 3 litres, un V8 de 4 litres ou un monstrueux W12 de 6 litres. Pour l’année-modèle 2023, la Flying Spur s’enrichit d’une version Azure, comme les Bentayga et Continental GT. Il est aussi possible d’opter pour la nouvelle variante S, qui se veut plus sportive.', 'orange', ' https://hips.hearstapps.com/hmg-prod/images/2024-bentley-flying-spur-644bddfb89ff4.jpg ', 381400, 20),
(3, 'Bentley Continental GT', 'La Continental GT est, comme son nom l’indique, une voiture de grand tourisme. Sous son long capot, loge un V8 de 4 litres de 542 chevaux et 569 lb-pi, ou un W12 de 6 litres qui revendique 650 chevaux et 664 lb-pi. Contrairement au Bentayga, il n’y a pas de version hybride disponible. En 2023, à l’image du reste de la gamme Bentley, la Continental GT s’enrichit d’une nouvelle version Azure, encore plus luxueuse et raffinée.', 'turquoise', 'https://hips.hearstapps.com/hmg-prod/images/2024-bentley-continental-gt-convertible-101-644bd404dcb7e.jpg ', 450000, 17),
(4, 'Rolls-Royce Wraith', 'La plus sportive des Rolls, si l’on veut, c’est le coupé Wraith. En déclinaison Black Badge, elle est également très rapide, alors que son V12 biturbo de 624 chevaux voit son couple passer de 605 à 642 livres-pied. En option, outre une liste infinie de choix de personnalisation, on peut se procurer un plafonnier parsemé de minuscules lumières DEL, émulant un ciel étoilé. Le système multimédia des Rolls, basé sur le iDrive de BMW, est d’une convivialité déconcertante.', 'bleu', 'https://i.gaw.to/vehicles/photos/40/21/402188-2020-rolls-royce-wraith.jpg ', 522197, 8),
(5, 'Rolls-Royce Ghost', 'Deux ans après son renouvellement complet, la Ghost continue d’impressionner avec sa nouvelle plateforme tout en aluminium appelée « Architecture of Luxury » et sa technologie de suspension planaire qui neutralise les vibrations pour un confort de roulement optimal. Comme avec toute Rolls-Royce, les options de personnalisation sont illimitées ou presque. Selon la version choisie, le V12 turbocompressé de 6,75 litres sous le capot génère 563 ou 591 chevaux… et brûle de l’essence sans modération.', 'saumon', 'https://hips.hearstapps.com/hmg-prod/images/p90508471-highres-rolls-royce-ghost-ex-copy-64dbcad7a198e.jpg ', 475000, 3),
(6, 'Mercedes-Maybach S-Class', 'Grande berline de luxe, la Mercedes-Classe S concurrence les Audi A8 et BMW Série 7 notamment. Entièrement renouvelée en 2021, elle ne propose pas de grande nouveauté pour 2023. Elle est offerte en versions 500 4MATIC, 580 4MATIC et Maybach 580 4MATIC. Cette dernière coûte pratiquement deux fois le prix d’une Classe S dite de base. Au catalogue, on retrouve deux mécaniques : le 6 cylindres en ligne de 3 litres et le V8 de 4 litres.', 'noir', 'https://hips.hearstapps.com/hmg-prod/images/23c0184-002-646cbd4d9fce4.jpg ', 249900, 25),
(7, 'Mercedes-Benz Classe E', 'Berline intermédiaire de luxe, la Mercedes-Benz Classe E est l’éternelle rivale des Audi A6 et BMW Série 5 notamment. En plus de la berline, le constructeur allemand propose le coupé, le cabriolet la familiale. Le modèle en est à sa cinquième génération depuis 2016. Les consommateurs ont le choix entre un moteur turbocompressé à 4 cylindres de 2 litres et le bloc à 6 cylindres en ligne de 3 litres. Elle est assemblée en Allemagne.', 'gris', 'https://i.gaw.to/vehicles/photos/40/31/403116-2023-mercedes-benz-e-class.jpg ', 142000, 30),
(8, 'Genesis G70', 'La Genesis G70 est une berline compacte de luxe qui concurrence notamment les Audi A4, BMW Série 3 et Mercedes-Benz Classe C. Ses versions de base reçoivent un moteur quatre cylindres turbo 2 litres de 252 chevaux et 260 lb-pi de couple. Pour plus de puissance, le V6 3,3 litres biturbo figure au menu, il produit 365 chevaux et 375 lb-pi. Le système multimédia incorpore un écran de 10,25 pouces. Apple CarPlay et Android Auto arrivent de série.', 'noir', 'https://i.gaw.to/vehicles/photos/40/32/403234-2023-genesis-g70.jpg ', 61000, 6),
(9, 'Audi A5', 'Berline compacte emblématique de chez Audi, l’A4 poursuit sa route pratiquement inchangée. Les principaux changements étant le retrait du modèle de base 40 TFSI, l’ajout de nouvelles jantes et la révision de certains équipements de confort et de sécurité. Du côté des motorisations, deux possibilités sont offertes : un 4 cylindres de 2 litres (261 chevaux) pour la berline et la familiale Allroad, et un V6 biturbo de 3 litres (349 chevaux) pour la déclinaison S4.', 'gris', 'https://i.gaw.to/vehicles/photos/40/30/403067-2023-audi-a4.jpg ', 65950, 16);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `couriel` varchar(75) NOT NULL,
  `genre` varchar(2) NOT NULL,
  `daten` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`nom`, `prenom`, `couriel`, `genre`, `daten`) VALUES
('Admin', 'Eliteautomobile', 'admin@eliteautomobile.com', 'nd', '1999-09-09');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `inventaireVoiture`
--
ALTER TABLE `inventaireVoiture`
  ADD PRIMARY KEY (`idVoiture`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `inventaireVoiture`
--
ALTER TABLE `inventaireVoiture`
  MODIFY `idVoiture` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
