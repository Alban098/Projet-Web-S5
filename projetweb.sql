-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 26 jan. 2020 à 21:38
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP :  7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetweb`
--
CREATE DATABASE IF NOT EXISTS `projetweb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projetweb`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(0, 'Boissons'),
(1, 'Biscuits');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
  `id` int(8) NOT NULL,
  `forename` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(128) NOT NULL,
  `registered` tinyint(1) NOT NULL,
  `address` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `customers`
--

INSERT INTO `customers` (`id`, `forename`, `surname`, `phone`, `email`, `registered`, `address`) VALUES
(0, 'Admin', 'Admin', 123456789, 'admin@admin.com', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `deliveryinfos`
--

CREATE TABLE `deliveryinfos` (
  `id` int(8) NOT NULL,
  `forename` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(64) NOT NULL,
  `postcode` int(5) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `deliveryinfos`
--

INSERT INTO `deliveryinfos` (`id`, `forename`, `surname`, `address`, `city`, `postcode`, `phone`, `email`) VALUES
(0, 'Admin', 'Admin', 'Adresse', 'Lyon', 69000, 123456789, 'admin@mail.com');

-- --------------------------------------------------------

--
-- Structure de la table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(8) NOT NULL,
  `orderId` int(8) NOT NULL,
  `product` int(8) NOT NULL,
  `quantity` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `orderitems`
--

INSERT INTO `orderitems` (`id`, `orderId`, `product`, `quantity`) VALUES
(0, 0, 0, 3),
(1, 1, 0, 1),
(2, 2, 0, 1),
(3, 3, 1, 4),
(4, 3, 0, 1),
(5, 4, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(8) NOT NULL,
  `customer` int(8) DEFAULT NULL,
  `registered` tinyint(1) NOT NULL,
  `address` int(8) NOT NULL,
  `payment` varchar(16) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(32) NOT NULL,
  `session` varchar(255) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `customer`, `registered`, `address`, `payment`, `date`, `status`, `session`, `total`) VALUES
(0, 0, 1, 0, 'Chèque', '2020-01-24', 'Valide', 'lath4b5u409svuec536ct58sun', 11.4),
(1, 0, 1, 0, 'Paypal', '2020-01-24', 'Attente de Paiement', 'lath4b5u409svuec536ct58sun', 3.8),
(2, 0, 1, 0, 'Paypal', '2020-01-24', 'Attente de Paiement', 'lath4b5u409svuec536ct58sun', 3.8),
(3, 0, 1, 0, '0', '2020-01-24', 'Enregistre', 'lath4b5u409svuec536ct58sun', 17.8),
(4, 0, 1, 0, '0', '2020-01-24', 'Enregistre', 'lath4b5u409svuec536ct58sun', 3.8);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(8) NOT NULL,
  `category` int(8) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `rating` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `category`, `name`, `description`, `img`, `price`, `rating`) VALUES
(0, 1, 'Biscuits de Noël', 'Assortiment de biscuits de noël', 'biscuitNoel.jpg', 3.8, 8),
(1, 1, 'Biscuits aux Raisins', 'Lot de biscuits aux raisins', 'biscuitRaisin.jpg', 3.5, 9),
(2, 1, 'Biscuits Sec', 'Assortiment de Biscuits sec', 'assortimentBiscuitsSec.jpg', 5, 8),
(3, 0, 'Jus d\'Orange', 'Jus d\'orange 1L', 'bestorange-juice.jpg', 2, 9),
(4, 0, 'Dosettes de Café', 'lot de 20 Dosette de Café', 'dosetteCafe.jpg', 8.5, 7),
(5, 0, 'Thé Impérial', 'Lot de 20 Sachets de Thé Impérial', 'theImperial.jpg', 10, 9);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(8) NOT NULL,
  `customer` int(8) NOT NULL,
  `username` varchar(32) NOT NULL,
  `hash` varchar(256) NOT NULL,
  `role` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `customer`, `username`, `hash`, `role`) VALUES
(0, 0, 'Admin', '$2y$10$WrDByGuExahPHIqtDrSD.OfA0n0SPTMbiLvsYTX7dBXrhteEJMs4q', 'ADMIN');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address` (`address`);

--
-- Index pour la table `deliveryinfos`
--
ALTER TABLE `deliveryinfos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `product` (`product`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer` (`customer`),
  ADD KEY `address` (`address`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer` (`customer`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`address`) REFERENCES `deliveryinfos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`address`) REFERENCES `deliveryinfos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
