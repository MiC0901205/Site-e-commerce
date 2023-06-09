-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql-pecheur.alwaysdata.net
-- Generation Time: Jun 01, 2023 at 08:53 PM
-- Server version: 10.6.11-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pecheur_db_site_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `batterie`
--

CREATE TABLE `batterie` (
  `idProduit` int(11) NOT NULL,
  `idCateg` int(11) NOT NULL,
  `capacite` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `batterie`
--

INSERT INTO `batterie` (`idProduit`, `idCateg`, `capacite`) VALUES
(1, 1, 1500),
(2, 1, 2600),
(3, 1, 5000),
(4, 1, 3350),
(5, 1, 3000),
(6, 2, 20000),
(7, 2, 10000),
(8, 2, 26800),
(9, 2, 6700),
(10, 2, 20000),
(11, 3, 36000),
(12, 3, 20000),
(13, 3, 30000),
(14, 3, 30000),
(15, 3, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `idCateg` int(11) NOT NULL,
  `valeurCateg` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`idCateg`, `valeurCateg`) VALUES
(1, 'Ronde'),
(2, 'UltraCompacte'),
(3, 'Antichoc');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `idCommande` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`idCommande`, `date`, `idUser`) VALUES
(29, '2023-05-15 23:00:11', 130);

-- --------------------------------------------------------

--
-- Table structure for table `commandes_statut`
--

CREATE TABLE `commandes_statut` (
  `idCommande` int(11) NOT NULL,
  `idStatut` int(11) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commande_produit`
--

CREATE TABLE `commande_produit` (
  `idCommande` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `qte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `commande_produit`
--

INSERT INTO `commande_produit` (`idCommande`, `idProduit`, `qte`) VALUES
(29, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `idProduit` int(11) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Prix` float NOT NULL,
  `Couleur` varchar(30) NOT NULL,
  `Image` varchar(50) NOT NULL,
  `Largeur` double(10,0) NOT NULL,
  `Longueur` double(10,0) NOT NULL,
  `Hauteur` double(10,0) NOT NULL,
  `Poids` double(10,0) NOT NULL,
  `description` varchar(400) NOT NULL,
  `qteStock` int(11) NOT NULL,
  `seuilAlert` int(11) NOT NULL,
  `idType` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`idProduit`, `Nom`, `Prix`, `Couleur`, `Image`, `Largeur`, `Longueur`, `Hauteur`, `Poids`, `description`, `qteStock`, `seuilAlert`, `idType`) VALUES
(1, 'Batterie Externe Nokia Lumia', 65, 'Blanche', 'batterie_ronde/batterie_externe.jpg', 10, 20, 40, 20, 'Une batterie externe a grande capacit&eacute; et tr&egrave;s facile &agrave; transporter', 10, 0, 1),
(2, 'Batterie externe pile', 21.9, 'orange/noir', 'batterie_ronde/batterie_externe_1.jpg', 15, 25, 45, 30, ' Avec cette batterie externe en forme de pile, vous n\'aurez plus de sueurs froides : branchez simplement votre appareil sur la batterie, et celle-ci lui donnera de l\'énergie ! Cette batterie permet de recharger jusqu\'à 1.5 fois votre smartphone. Ouf !', 9, 0, 1),
(3, 'Anker', 22.99, 'Noir', 'batterie_ronde/batterie_externe_2.jpg', 3, 20, 10, 100, 'Grande batterie : possède une batterie de 5000 mAh. Elle est suffisante pour charger un iPhone X une fois ou un Samsung Galaxy S9 1 fois, ou presque 2 charges pour un iPhone 8.', 10, 0, 1),
(4, 'MaGeek', 12.99, 'Rose', 'batterie_ronde/batterie_externe_3.jpg', 22, 99, 22, 80, 'Sa conception universelle prend en charge tous les appareils tels que les iPods, les iPhons, les appareils Samsung, les téléphones mobiles, etc. Ne vous retrouvez plus sans batterie.', 10, 0, 1),
(5, 'Lexon', 29.9, 'Metal Pistolet', 'batterie_ronde/batterie_externe_4.jpg', 20, 20, 95, 45, 'Une batterie externe très facile a transporter grâce à son poids très léger', 10, 0, 1),
(6, 'Romoss', 19.99, 'Noir', 'batterie_compacte/batterie_compacte.jpg', 7, 14, 3, 200, ' Batterie Externe 20000mAh Ultra Compacte\r\n\r\nLa capacité de 20000 mAh peut contenir 8 charges complètes pour iPhone 8. Elle est compatible avec tous les téléphones portables, tablettes. ', 10, 0, 1),
(7, 'Luxtude', 32.95, 'Noir', 'batterie_compacte/batterie_compacte_2.jpg', 62, 94, 24, 212, 'Facile et efficace\r\nFacile à transporter parce que cette batterie externe est légère. Avec les 2 ports de sortie, vous pourriez recharger simultanément 2 appareils.', 6, 0, 1),
(8, 'ECtechnology', 24.99, 'Noir', 'batterie_compacte/batterie_compacte_3.jpg', 24, 35, 2, 200, 'Capacité extra puissante: Le chargeur portable 26800mAh EC Technology avec une capacité super élevée permet de charger iPhone 6S autour de 9,8 fois, iPad Mini 3 fois, Samsung Galaxy S6 presque 6,5 fois. ', 9, 0, 1),
(9, 'Anker', 36.99, 'Rouge', 'batterie_compacte/batterie_compacte_4.jpg', 4, 10, 2, 118, 'L\'avantage Anker : rejoignez les 20 millions d\'utilisateurs qui ont choisi la marque de chargement USB n°1 aux Etats-Unis.', 10, 0, 1),
(10, 'Vinsic', 59.9, 'Noir', 'batterie_compacte/batterie_compacte_5.jpg', 83, 158, 25, 470, 'A la réception du produit, nous avons bien évidemment la batterie équipé d’un câble micro USB, une housse de transport, la garantie ainsi que la notice d’utilisation en anglais uniquement.\r\n', 10, 0, 1),
(11, 'DJROLL', 47.99, 'Bleu', 'batterie_antichoc/batterie_antichoc.jpg', 18, 25, 3, 520, 'Cette batterie externe a une capacité de 36000mAh, une fois complètement chargée, plus besoin de s\'inquiéter pour la batterie de votre téléphone. ', 8, 0, 1),
(12, 'RYOKO', 29.99, 'Vert', 'batterie_antichoc/batterie_antichoc_2.jpg', 8, 16, 2, 280, 'Ryoko est une batterie externe solaire.\r\nLa banque d\'énergie solaire avec une capacité de 20000 mah est suffisante pour fournir plus de 4 frais pour l\'iPhone 12, près de 3 frais pour Galaxy S10 et plus de 1,5 frais pour iPad Mini4', 5, 0, 1),
(13, 'JIGA', 39.95, 'Noir/rouge', 'batterie_antichoc/batterie_antichoc_3.jpg', 3, 15, 8, 530, 'Avec une longue durée de vie et recharge illimitée au soleil, elle est adapté particulièrement au camping et à l\'aventure en plein air, à la randonnée, aux vols d\'affaires ou à d\'autres cas d\'urgence.\r\n', 10, 0, 1),
(14, 'Baseus', 86.99, 'Noir', 'batterie_antichoc/batterie_antichoc_4.jpg', 6, 14, 4, 250, ' Le port USB-C 65 W fournit suffisamment de puissance pour charger un ordinateur portable à pleine vitesse, cette banque d\'alimentation charge un macbook pro 13\" de 0 % à 50 % en seulement 50 minutes', 8, 0, 1),
(15, 'Nuxgal', 38.95, 'Noir/bleu', 'batterie_antichoc/batterie_antichoc_4.jpg', 8, 17, 3, 300, 'Elle permet de recharger 9 fois l\'iPhone 11, 4 fois la Nintendo Switch, 4 fois l\'iPad Pro et de faire fonctionner facilement 3 téléphones toute la journée.', 10, 0, 1),
(16, 'Logitech', 91.74, 'Noir', 'souris/souris_1.jpg', 3, 10, 4, 80, 'La souris gamer Logitech est dotée de la technologie sans fil LIGHTSPEED pour une expérience de jeu hautes performances', 10, 0, 2),
(17, 'CPI', 15.99, 'Noir', 'souris/souris_2.jpg', 8, 12, 4, 106, 'batterie rechargeable intégrée de haute qualité, pouvant durer jusqu\'à 500 heures d\'utilisation après une simple charge complète, facile à recharger via un câble micro USB\'', 0, 0, 2),
(18, 'Coolerplus', 11.99, 'Noir', 'souris/souris_3.jpg', 6, 11, 4, 100, 'Brancher et jouer à la souris USB avec Rainbow light, tacking précis et selection facile, pas besoin d’installer d’autres pilotes ou logiciels.', 10, 0, 2),
(19, 'INPHIC', 15.99, 'Argent', 'souris/souris_4.jpg', 6, 11, 2, 65, 'Connexion Bluetooth stable : se connecte directement aux appareils Bluetooth sans avoir besoin d\'un récepteur supplémentaire', 10, 0, 2),
(20, 'Dacoity', 19.99, 'Noir', 'souris/souris_5.jpg', 4, 15, 5, 120, 'Doté de 4 zones d\'éclairage comprenant une molette de défilement, un logo, une bande gauche et droite, cette souris gamer rgb avec fil prend en charge 7 modes de rétroéclairage', 10, 0, 2),
(21, 'Cable recharge iPhone', 9.99, 'Blanc', 'cable_de_recharge/cable_de_recharge_1.jpg', 13, 19, 1, 60, 'Le câble lightning apple court est conforme à la norme USB 2.0 et supporte des vitesses de transmission de données allant jusqu\'à 480Mbps (60M/s).', 10, 0, 4),
(22, 'UGREEN', 7.99, 'Gris', 'cable_de_recharge/cable_de_recharge_2.jpg', 13, 19, 1, 20, 'Câble USB Type C fournit une charge rapide jusqu\'à 3A à vos appareils compatibles avec un port USB C, idéal pour gagner effectivement du temps de charge. ', 9, 0, 4),
(23, 'RAVIAD', 7.99, 'Or', 'cable_de_recharge/cable_de_recharge_3.jpg', 9, 9, 1, 30, 'câble multi usb incluant les ports de connecteur Micro USB et USB Type C, pas besoin de transporter des câbles plus différents pour charger différents périphériques de port, rendre votre vie numérique plus simple et plus pratique.', 10, 0, 4),
(24, 'deleyCON', 4.89, 'Noir', 'cable_de_recharge/cable_de_recharge_4.jpg', 9, 13, 2, 16, 'Compatible avec un PC, un téléphone portable, un smartphone, une tablette, un appareil photo, un système de navigation et bien plus encore // Transfert de données : jusqu\'à 480 Mbits', 10, 0, 4),
(25, 'TUSITA', 6.9, 'Noir', 'cable_de_recharge/cable_de_recharge_5.jpg', 10, 9, 0, 1, ' Fait de fil de cuivre de haute qualité; assurer l\'excellente expérience de charge pour votre appareil.', 10, 0, 4),
(26, 'LYCANDER', 13.19, 'Rainbow', 'clavier/clavier_1.jpg', 50, 40, 10, 1100, 'La technologie anti-ghosting permet à plusieurs touches de s\'exprimer simultanément dans un temps de réponse rapide.', 0, 0, 3),
(27, 'HyperX', 92, 'Rainbow', 'clavier/clavier_2.jpg', 55, 46, 8, 1075, 'L\'HyperX Alloy Origins est un clavier compact et robuste doté de commutateurs mécaniques HyperX personnalisés conçus pour offrir aux joueurs le meilleur mélange de style, de performances et de fiabilité.', 10, 0, 3),
(28, 'Logitech', 39.99, 'Noir', 'clavier/clavier_3.jpg', 45, 22, 3, 1100, 'le clavier gaming G213 par Logitech offre cinq zones d\'éclairage individuelles, chacune étant personnalisable à partir d\'une palette de près de 16,8 millions de couleurs', 9, 0, 3),
(29, 'JOYACCESS', 38.99, 'Blanc Argent', 'clavier/clavier_4.jpg', 48, 60, 2, 900, 'OYACCESS toutes les touches du clavier de bureau sans fil sont low profile à ciseaux ; ce qui le rend ultra-mince (course de frappe 2 mm), réactif et moins bruyant.', 10, 0, 3),
(30, 'THE G-LAB', 20.99, 'Rainbow', 'clavier/clavier_5.jpg', 48, 16, 4, 800, 'Doté d’une faible latence, le Keyz Tungsten vous assure une frappe réactive. Vous ne sentirez aucune latence par rapport à un clavier filaire. ', 10, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `statut`
--

CREATE TABLE `statut` (
  `idStatut` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `statut`
--

INSERT INTO `statut` (`idStatut`, `libelle`) VALUES
(1, 'non validée'),
(2, 'préparation'),
(3, 'pris en charge'),
(4, 'en cours d\'acheminement'),
(5, 'livré');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `idType` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`idType`, `libelle`) VALUES
(1, 'Batterie'),
(2, 'Souris'),
(3, 'Clavier'),
(4, 'Cable_de_recharge');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `adresse_mail` varchar(35) NOT NULL,
  `confirm_mail` tinyint(1) NOT NULL,
  `cle` varchar(50) DEFAULT NULL,
  `ville` varchar(25) NOT NULL,
  `cp` char(5) NOT NULL,
  `tel` char(20) DEFAULT NULL,
  `mdp` varchar(100) NOT NULL,
  `role` varchar(25) DEFAULT 'ROLE_USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `adresse`, `adresse_mail`, `confirm_mail`, `cle`, `ville`, `cp`, `tel`, `mdp`, `role`) VALUES
(116, 'pecheur', 'guilaine', '25 mont&eacute;e du chateau', 'guilaine072761@gmail.com', 1, 'd431a0a4add20f0a61d27599a98e25cd', 'La Laupie', '26740', '06 32 62 45 69', 'e7d9fbb21de84ff513033a6b7e93d48cdfe190287e3732eea85880e5cab58d67', 'ROLE_USER'),
(117, 'blache', 'Gabin', '180 chemin des granges gontardes', 'gabin.blache@gmail.com', 1, '0cd33186c9ede54bcedf5ace1facba9f', 'malataverne', '26780', '06 27 05 51 69', 'e31a50ecfe8eadeec15ea55e8629081e54a29a82235cd890b0d4980677b0be4b', 'ROLE_USER'),
(130, 'Menvussat', 'Gerard', '2 all&eacute;e de la fontaine', 'gerard.menvussat@gmail.com', 1, '1f25761b271e8740b643b58b628f39ef', 'Montpellier', '34700', '05 20 10 65 47', 'e4257bdbe002c0326fd8868224367d6e564e297954d3b0bd20eda6fc037efa82', 'ROLE_ADMIN_MAUI'),
(136, 'PECHEUR', 'CECILE', 'le clos du palais', 'cilou2803@gmail.com', 1, '0f190298de726323f62dfa278346573a', 'chateauneuf du rhone', '26780', '06 32 35 46 03', 'e576acf7c93b641470349819509c3cc279e51796c3fa9843276c88102cd23005', 'ROLE_USER'),
(138, 'pecheur', 'mickael', '22 clos du palais', 'm.pecheur09@gmail.com', 1, '0552ee8cbd0f53abcadf7e629cf1810a', 'Ch&acirc;teauneuf du Rh&o', '26780', '06 27 27 24 94', '0514b110da9fe9d407a0dcbddd7969b91a8a63654febc69c00ec672740b1aafa', 'ROLE_ADMIN'),
(141, 'test test', 'test', 'test', 'test2@jojo.com', 1, 'insertByAdmin', 'test', '25000', '05 20 10 65 47', '0514b110da9fe9d407a0dcbddd7969b91a8a63654febc69c00ec672740b1aafa', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batterie`
--
ALTER TABLE `batterie`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `fk_batterie_categorie` (`idCateg`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCateg`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `fk_commandes_client` (`idUser`);

--
-- Indexes for table `commandes_statut`
--
ALTER TABLE `commandes_statut`
  ADD PRIMARY KEY (`idCommande`,`idStatut`),
  ADD KEY `fk_commandes_statut_statut` (`idStatut`) USING BTREE;

--
-- Indexes for table `commande_produit`
--
ALTER TABLE `commande_produit`
  ADD PRIMARY KEY (`idProduit`,`idCommande`) USING BTREE,
  ADD KEY `fk_commandeProduit_commandes` (`idCommande`) USING BTREE,
  ADD KEY `fk_commandeProduit_produit` (`idProduit`) USING BTREE;

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `fk_produit_type` (`idType`);

--
-- Indexes for table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`idStatut`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`idType`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batterie`
--
ALTER TABLE `batterie`
  MODIFY `idProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCateg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `idProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `statut`
--
ALTER TABLE `statut`
  MODIFY `idStatut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batterie`
--
ALTER TABLE `batterie`
  ADD CONSTRAINT `fk_batterie_categorie` FOREIGN KEY (`idCateg`) REFERENCES `categorie` (`idCateg`),
  ADD CONSTRAINT `fk_batterie_produit` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`);

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `fk_commandes_client` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Constraints for table `commandes_statut`
--
ALTER TABLE `commandes_statut`
  ADD CONSTRAINT `fk_commandes_statut_commandes` FOREIGN KEY (`idCommande`) REFERENCES `commandes` (`idCommande`),
  ADD CONSTRAINT `fk_commandes_statut_statut` FOREIGN KEY (`idStatut`) REFERENCES `statut` (`idStatut`);

--
-- Constraints for table `commande_produit`
--
ALTER TABLE `commande_produit`
  ADD CONSTRAINT `fk_commandeProduit` FOREIGN KEY (`idCommande`) REFERENCES `commandes` (`idCommande`),
  ADD CONSTRAINT `fk_commandeProduit_produit` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
