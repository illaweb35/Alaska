
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
(1, 'Préambule', 'Jean Forteroche', 'Ce jour-l&agrave;, Gregory Land m&rsquo;assura&nbsp;: &mdash; Vous n&rsquo;entendez rien &agrave; la g&eacute;ographie. Il est vrai que &ccedil;a n&rsquo;est pas une chose qui s&rsquo;apprend dans les livres&hellip; Lorsque la nouvelle se r&eacute;pandit que l&rsquo;on avait trouv&eacute; de l&rsquo;or, au c&oelig;ur m&ecirc;me des solitudes glac&eacute;es, au-dessus du 60e&nbsp;degr&eacute; de latitude nord, ce fut une ru&eacute;e. Des quatre coins du monde, les aventuriers accoururent pour tenter la chance. La fi&egrave;vre de l&rsquo;or les tenait si fort qu&rsquo;ils en oubliaient les rigueurs impitoyables du Grand Nord. Les ports du Pacifique, de San-Francisco &agrave; Vancouver, fournirent une bonne partie des&nbsp;premiers &eacute;migrants&nbsp;; du Canada et de la Colombie Britannique vinrent les autres. Ils remontaient la c&ocirc;te du Pacifique, de Vancouver &agrave; Skagway, &agrave; travers le m&eacute;andre des &icirc;les, sur des petits vapeurs trapus ou sur des embarcations &agrave; voiles. Les uns et les autres eurent &agrave; affronter les terribles courants de Prince of Wales, et plusieurs se fracass&egrave;rent sur le granit des roches, tra&icirc;treusement tapies au fond des passes. Aujourd&rsquo;hui, les passes ont &eacute;t&eacute; explor&eacute;es, les sondages ont permis d&rsquo;&eacute;viter les fonds pernicieux, quoique, par les grandes mar&eacute;es, la travers&eacute;e soit encore des plus p&eacute;rilleuses. Les hommes qui, en 1897, d&eacute;barqu&egrave;rent sur la plage boueuse de Dyea ou de Skagway, n&rsquo;&eacute;taient pas au bout de leur peine. Quelque cabanes de bois group&eacute;es au pied de la Pink Mountain, un mis&eacute;rable ponton sur pilotis, telle &eacute;tait Skagway. Pour atteindre les terrains aurif&egrave;res, la &laquo;&nbsp;terre qui paye&nbsp;&raquo;, selon l&rsquo;expression pittoresque des premiers mineurs, il fallait franchir la redoutable White-Pass. De Skagway &agrave; White-Horse, il y a cent onze milles par une route affreuse, surplombant l&rsquo;ab&icirc;me de huit &agrave; neuf cents pieds. Aujourd&rsquo;hui, une compagnie audacieuse a agripp&eacute; un chemin de fer sur les aiguilles et les ar&ecirc;tes des rochers de basalte. Par quel prodige, &agrave; la suite de quels efforts inou&iuml;s, la volont&eacute; de&nbsp;l&rsquo;homme a-t-elle pu s&rsquo;affirmer&nbsp;? Les centaines de cadavres des ouvriers que la White-Pass engloutit pourraient seuls r&eacute;pondre. Les mineurs, pour franchir la Passe, confiaient leur destin&eacute;e soit aux tra&icirc;neaux que les chiens tiraient le long du&nbsp;trail, soit &agrave; des embarcations l&eacute;g&egrave;res qui devaient r&eacute;sister au tumulte des eaux, aux chutes des rapides, aux sournoiseries des brisants. La neige, les glaciers, les gouffres s&rsquo;ouvrant tout &agrave; coup et avalant hommes, chiens et tra&icirc;neaux, quarante degr&eacute;s sous z&eacute;ro n&rsquo;eurent pas raison de l&rsquo;&eacute;nergie de ces farouches pionniers, qui avaient r&eacute;solu d&rsquo;arracher son secret &agrave; la terre myst&eacute;rieuse. La folie du Klondyke les soutenait&nbsp;; nombreux furent ceux qui tomb&egrave;rent, mais d&rsquo;autres arrivaient qui r&eacute;ussirent leur aventureuse performance. L&agrave; o&ugrave; rien n&rsquo;existait que la solitude vierge, sur les berges de ce Yukon, le plus important, le plus grand des fleuves nord-am&eacute;ricains du Pacifique, se dress&egrave;rent des campements qui, bient&ocirc;t, devinrent des villes. Une chose remarquable&nbsp;: d&egrave;s que la &laquo;&nbsp;terre payante&nbsp;&raquo; &eacute;tait d&eacute;couverte, les mineurs arrivaient, attir&eacute;s par la lueur fauve de l&rsquo;or comme par la lumi&egrave;re, et avec eux, ces hommes amenaient toujours une ou deux dynamos, on posait des fils et les paysages du Grand Nord&nbsp;s&rsquo;agr&eacute;mentaient bient&ocirc;t de poteaux qui sont comme le symbole de la puissance de l&rsquo;homme. T&eacute;l&eacute;graphe, t&eacute;l&eacute;phone, courant &eacute;lectrique, les fils se greffaient parall&egrave;les sur les croix de Saint-Andr&eacute; clou&eacute;es au fa&icirc;te des sapins &agrave; peine &eacute;branch&eacute;s.', '301828.jpg', '2018-06-25 16:22:44', '2018-07-04 10:31:20', 1),
(15, 'Article 5', 'Jean Forteroche', 'essai de suppression d&#39;image', '667085.jpg', '2018-07-04 10:16:13', '2018-07-04 10:58:25', 1);

-- --------------------------------------------------------

--
-- Structure de la table `T_comments`
--

CREATE TABLE `T_comments` (
  `id_com` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `create_at` datetime NOT NULL,
  `modif_at` datetime NOT NULL,
  `bil_id` int(11) NOT NULL,
  `moderate` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `T_comments`
--

INSERT INTO `T_comments` (`id_com`, `pseudo`, `content`, `create_at`, `modif_at`, `bil_id`, `moderate`) VALUES
(6, 'Mathilde', 'Commentaire de vérification', '2018-06-29 09:47:34', '0000-00-00 00:00:00', 1, 0),
(25, 'Fabien', 'Commenter le post', '2018-07-04 10:51:08', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `T_users`
--

CREATE TABLE `T_users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `modif_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `T_users`
--

INSERT INTO `T_users` (`id_user`, `username`, `email`, `password`, `create_at`, `modif_at`) VALUES
(1, 'admin', 'admin@localhost.fr', '$2y$10$6ovYlWuBibjxf93wAKONCuP.YY7xRZtObdznHv.I0lF.EufraFDL2', '2018-06-25 15:55:56', '2018-06-27 17:28:11'),
(5, 'julien', 'julien@loclahost.fr', '$2y$10$5P/xHygUSs4GsVZ8bEMuBuPnJVF/b5FrXPRQgqacPigmyt/3PQO7W', '2018-07-03 15:23:16', '2018-07-03 15:23:16');

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
  ADD KEY `pseudo` (`pseudo`),
  ADD KEY `bil_id` (`bil_id`);

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

--
-- AUTO_INCREMENT pour la table `T_billets`
--
ALTER TABLE `T_billets`
  MODIFY `id_bil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `T_comments`
--
ALTER TABLE `T_comments`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `T_users`
--
ALTER TABLE `T_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `T_comments`
--
ALTER TABLE `T_comments`
  ADD CONSTRAINT `T_comments_ibfk_1` FOREIGN KEY (`bil_id`) REFERENCES `T_billets` (`id_bil`) ON DELETE CASCADE;
