-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 30 Mai 2018 à 16:54
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

INSERT INTO `T_billets` (`id_bil`, `title`, `author`, `content`, `image`, `create_at`, `modif_at`, `posted`) VALUES
(1, 'Préambule', 'Jean Forteroche', 'J\'écris depuis plus de dix ans, j\'écris ce que j\'appelle \"Balade dans ma mémoire\", source inépuisable de ce que nous pensions avoir enfoui ... Mais peu à peu tout remonte à la surface... Il suffit de creuser un peu. En voici le préambule.                                                          \r\n                                                          Telles des gouttes d\'eau, les lettres s\'amoncellent...\r\n                                                          Formant les petits ruisseaux, puis les grandes rivières\r\n                                                          Où puisent-elles leurs sources ? ...                                                                                                       \r\n                                                                                        Préambule…\r\nÉcrire ce que nous savons…Oui c’est facile, car tout est dans la tête ! … Dans nos fichiers personnels, le concret de notre vie enfoui dans notre mémoire. Si l’on considère que le passé est le livre de notre existence, donc déjà écrit, il suffit de raconter ce que l’on a vécu.\r\nOn pourrait imaginer, de lire dans notre passé, de laisser notre réalité, nous dicter ce qui nous a construit…\r\nDu moins semble-t-il, jusqu’au moment de passer à l’acte !... Par quoi commencer ? Comment le dire ?\r\nPas facile…Surtout si l’on considère, le temps rigide s’écoulant sur des rails…Bien sûr il suffit de le remonter, grâce à la mémoire…Mais il est difficile de résister à la tentation, de s’arrêter dans toutes les gares…  \r\n\r\nPuis il y a sa propre version, l’interprétation et l’émotion qui ont forgé notre philosophie personnelle.  Le sentiment a tant de choses à raconter… A défricher dans le lointain, pourtant si proche. C’est l’autre mémoire, celle de la vision du cœur…D’aujourd’hui, mais aussi celle de l’enfant…  Tout cela n’est pas déjà écrit, il faut chercher à l’intérieur, trier ce que l’on veut exprimer, gratter un peu…\r\nOn ne peut pas parler de soi, en écartant la famille, l’entourage. Là c’est plus délicat, il est difficile de se balader dans sa mémoire, sans exprimer ce que l’on ressent et surtout faut-il tout dire ?\r\nBien sûr il y aussi le concret, tout ce qu’il reste lorsque le dernier parent disparaît. La réalité du passé qui veut parler, mais resterait silencieuse, si personne ne prend le temps de l’écouter. De souffler sur la poussière accumulée depuis tant d’années…Afin, d’aider nos descendants à savoir, à comprendre par quelle voie ils sont arrivés dans leur présent…  \r\n', 'Map_Alaska.png', '2018-05-16 05:22:26', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `T_comments`
--

CREATE TABLE `T_comments` (
  `id_com` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `modif_at` datetime NOT NULL,
  `create_at` datetime NOT NULL,
  `bil_id` mediumint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `T_comments`
--

INSERT INTO `T_comments` (`id_com`, `pseudo`, `content`, `modif_at`, `create_at`, `bil_id`) VALUES
(7, 'Jean', 'De la Salle à dit du commentaire que cela ne correspondait à rien', '0000-00-00 00:00:00', '2018-05-29 19:13:03', 1),
(10, 'Modern', 'ajout de commentaire', '0000-00-00 00:00:00', '2018-05-29 19:13:52', 1),
(13, 'lolo', 'comment', '0000-00-00 00:00:00', '2018-05-29 19:17:45', 1);

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
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `T_users`
--

INSERT INTO `T_users` (`id_user`, `username`, `email`, `password`, `role`, `create_at`) VALUES
(0, 'admin', 'admin@localhost.fr', '123456', 'Administrateur', '2018-05-22 08:23:00');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `T_billets`
--
ALTER TABLE `T_billets`
  ADD PRIMARY KEY (`id_bil`);

--
-- Index pour la table `T_comments`
--
ALTER TABLE `T_comments`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `pseudo` (`pseudo`),
  ADD KEY `bil_id` (`bil_id`);

--
-- Index pour la table `T_users`
--
ALTER TABLE `T_users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `T_billets`
--
ALTER TABLE `T_billets`
  MODIFY `id_bil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `T_comments`
--
ALTER TABLE `T_comments`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;