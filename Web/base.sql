--- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Jeu 14 Juin 2018 à 17:21
-- Version du serveur :  10.1.29-MariaDB-6
-- Version de PHP :  7.2.5-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Alaska`
--

-- --------------------------------------------------------

--
-- Structure de la table `T_billets`
--

CREATE TABLE `T_billets` (
  `id_bil` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `modif_at` datetime NOT NULL,
  `posted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `T_billets`
--


--
-- Structure de la table `T_comments`
--

CREATE TABLE `T_comments` (
  `id_com` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `create_at` datetime NOT NULL,
  `modif_at` datetime NOT NULL,
  `bil_id` mediumint(11) NOT NULL,
  `moderate` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `T_comments`
--



-- --------------------------------------------------------

--
-- Structure de la table `T_users`
--

CREATE TABLE `T_users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `modif_at`datetime not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `T_users`
--


--
-- Index pour les tables exportées
--

--
-- Index pour la table `T_billets`
--
ALTER TABLE `T_billets`
  ADD PRIMARY KEY (`id_bil`),
  ADD KEY `author` (`author`),
  ADD KEY `title` (`title`);

--
-- Index pour la table `T_comments`
--
ALTER TABLE `T_comments`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `pseudo` (`pseudo`);

--
-- Index pour la table `T_users`
--
ALTER TABLE `T_users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

-
