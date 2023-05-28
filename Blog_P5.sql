-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 27 mai 2023 à 17:30
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
-- Base de données : `Blog_P5`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `comment_content` mediumtext NOT NULL,
  `creation_date` datetime NOT NULL,
  `is_valid` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `comment_content`, `creation_date`, `is_valid`, `user_id`, `post_id`) VALUES
(16, 'Ceci est un commentaire', '2023-04-26 10:03:11', 1, 13, 4),
(21, 'C\'est LE meilleur', '2023-05-07 16:36:31', 1, 13, 6),
(22, 'C\'est une deuxième bûche de Noël ?', '2023-05-09 14:53:32', 1, 13, 4),
(23, 'Sans oublier Lucy', '2023-05-09 21:49:08', 1, 13, 6);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` mediumtext NOT NULL,
  `content` longtext NOT NULL,
  `creation_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `title`, `summary`, `content`, `creation_date`, `update_date`, `user_id`) VALUES
(2, 'Laura Palmer: une vie tragique derrière un masque parfait', 'Bien qu\'elle soit décédée avant le début de la série, Laura Palmer continue de captiver les téléspectateurs avec sa vie tragique et les secrets qui l\'entourent. Dans cet article, nous allons explorer la vie et la personnalité de Laura Palmer, en examinant les différents aspects de sa vie et les événements qui ont mené à sa mort.', 'Laura Palmer était une jeune fille de Twin Peaks, une petite ville tranquille dans l\'État de Washington. Elle était considérée comme l\'une des filles les plus populaires de son école, avec un sourire charmant et une personnalité aimable. Cependant, derrière ce masque parfait, se cachait une vie tragique.\r\n\r\nLaura avait des problèmes de drogue et était impliquée dans des relations sexuelles avec de nombreux hommes, y compris des personnages clés de la série comme le shérif Harry Truman et le Dr Lawrence Jacoby. Elle était également harcelée par un mystérieux tueur, qui l\'a finalement tuée. Tout au long de la série, les personnages découvrent les nombreux secrets de Laura, qui mettent en lumière sa personnalité complexe et troublée.\r\n\r\nMalgré ses problèmes, Laura était aimée par de nombreuses personnes de la ville, y compris ses amis et sa famille. Elle était particulièrement proche de son père, Leland Palmer, qui a été profondément affecté par sa mort. Les souvenirs de Laura continuent d\'influencer les personnages de la série, même après sa mort.\r\n\r\nLaura Palmer était un personnage complexe et fascinant, dont la vie tragique a été explorée en profondeur dans la série Twin Peaks. Bien qu\'elle ait été présentée comme une fille populaire et souriante, il y avait de nombreux aspects sombres de sa personnalité qui ont été révélés tout au long de la série. Sa mort a eu un impact énorme sur la ville de Twin Peaks et sur les personnages de la série, qui ont tous été touchés de différentes manières. Laura Palmer restera un personnage mémorable dans l\'histoire de la télévision, dont la vie continue d\'attirer l\'attention et l\'intérêt des fans de Twin Peaks.', '2023-03-15 20:10:43', '2023-03-15 20:10:43', 13),
(3, 'Le maléfique', 'BOB est l\'un des personnages les plus emblématiques de la série télévisée Twin Peaks. Ce personnage hante la série et est à l\'origine de nombreux événements inquiétants qui se produisent tout au long de l\'intrigue.', 'BOB est un personnage mystérieux et effrayant qui apparaît pour la première fois dans la série à travers les rêves et les visions du personnage de Laura Palmer. BOB est souvent associé à l\'ombre et à la noirceur qui hantent la ville de Twin Peaks. Il est souvent représenté comme un homme malveillant, portant une veste en cuir et une chevelure longue et bouclée.\r\n\r\nBOB est impliqué dans de nombreux événements inquiétants de la série, notamment la mort de Laura Palmer. Il est révélé que BOB est un esprit malfaisant qui possède des êtres humains et les force à commettre des actes horribles. Dans la série, il possède notamment le personnage de Leland Palmer, le père de Laura, qui commet des actes de violence et de meurtre sous l\'emprise de BOB.\r\n\r\nEn plus de Leland Palmer, BOB est également associé à d\'autres personnages, tels que le personnage de Windom Earle, un ancien agent du FBI devenu fou et obsédé par la mort de sa femme. Windom Earle est également possédé par BOB, qui le pousse à commettre des actes violents et meurtriers dans sa quête de vengeance.\r\n\r\nBOB est également lié à un autre personnage important de la série, le personnage de Cooper. Dans la deuxième saison de la série, Cooper est hanté par des visions de BOB, qui le poussent à enquêter sur l\'existence de ce personnage maléfique et sur sa relation avec Leland Palmer.\r\n\r\nBOB est un personnage maléfique qui hante la série Twin Peaks et est associé à de nombreux événements inquiétants de l\'intrigue. BOB est un personnage mystérieux et effrayant, qui possède des êtres humains et les force à commettre des actes horribles. BOB est l\'un des personnages les plus emblématiques de la série et continue de fasciner et d\'effrayer les fans de Twin Peaks.', '2023-03-19 16:38:33', '2023-05-27 14:56:23', 4),
(4, '\"Ma bûche a quelque chose à vous dire !\"', 'La bûche de Twin Peaks est l\'un des objets les plus énigmatiques et fascinants de la série télévisée culte. Cet objet apparaît tout au long de l\'intrigue de la série et semble être doté d\'une étrange signification mystique. ', 'La bûche apparaît pour la première fois dans la série au bras de Margaret Lanterman, également connue sous le nom de la Femme à la Bûche. Margaret est une femme âgée qui utilise la bûche pour communiquer avec l\'au-delà et pour recevoir des messages mystiques.\r\n\r\nAu fil de la série, la bûche apparaît à plusieurs reprises, souvent associée à des événements étranges et inquiétants. Dans la deuxième saison de la série, le personnage de Cooper découvre que la bûche est en réalité un morceau d\'arbre qui a été témoin d\'un meurtre commis dans la forêt de Twin Peaks. La bûche est donc liée à l\'intrigue principale de la série et à l\'identité de l\'assassin de Laura Palmer.\r\n\r\nEn plus de sa signification mystique, la bûche est également associée à des personnages importants de la série, tels que le personnage de Pete Martell, qui est obsédé par la bûche et la considère comme un objet sacré.\r\n\r\nLa bûche est également associée à des éléments thématiques importants de la série, tels que le thème de la dualité et de l\'opposition entre le bien et le mal. La bûche est souvent représentée comme un objet mystique qui peut être utilisé pour communiquer avec l\'au-delà et avec des forces surnaturelles.\r\n\r\nLa bûche de Twin Peaks est un objet énigmatique et fascinant qui est associé à de nombreux événements mystérieux de la série. La bûche est un objet qui a une signification mystique et est souvent utilisé pour communiquer avec l\'au-delà et avec des forces surnaturelles. La bûche est un élément clé de l\'intrigue de la série et continue de fasciner et d\'interroger les fans de Twin Peaks.', '2023-03-19 16:53:20', '2023-03-19 16:53:20', 13),
(6, 'Andy le Dandy', 'Andy Brennan est l\'un des personnages les plus mémorables de la série télévisée culte Twin Peaks. Policier maladroit et souvent comique, Andy est un personnage attachant qui est devenu rapidement un favori des fans. ', 'Andy Brennan est un policier de Twin Peaks qui travaille sous les ordres de l\'agent spécial Dale Cooper. Andy est souvent présenté comme maladroit et incompétent, mais il est également extrêmement attachant et sensible. Son personnage est souvent utilisé pour apporter une touche d\'humour à la série, mais il est également impliqué dans des intrigues importantes de l\'intrigue.\r\n\r\nAu cours de la première saison de la série, Andy est impliqué dans l\'enquête sur le meurtre de Laura Palmer. Bien que ses compétences en tant que policier soient souvent mises en doute, Andy est déterminé à résoudre le mystère entourant la mort de Laura Palmer. Il travaille étroitement avec Cooper et les autres membres de l\'équipe de police pour découvrir la vérité sur le meurtre.\r\n\r\nAu fil de la série, le personnage d\'Andy évolue et devient de plus en plus important pour l\'intrigue. Il est révélé que Andy est en fait le père du bébé que Lucy, sa collègue du service de police, attend. Cette révélation ajoute une dimension émotionnelle au personnage et montre qu\'Andy est plus que simplement un policier maladroit.\r\n\r\nAndy est également impliqué dans plusieurs moments clés de la série. Dans l\'un des épisodes les plus célèbres de la série, il réalise qu\'il a accidentellement tiré sur Jacques Renault, le meurtrier de Laura Palmer, dans une scène comique qui est devenue l\'une des plus mémorables de la série.\r\n\r\nAndy Brennan est un personnage mémorable et attachant de la série Twin Peaks. Bien qu\'il soit souvent utilisé pour apporter une touche d\'humour à la série, Andy est également impliqué dans des intrigues importantes de l\'intrigue et joue un rôle clé dans la résolution du meurtre de Laura Palmer. Son personnage évolue au fil de la série, ajoutant une dimension émotionnelle et montrant que ce personnage est bien plus qu\'un simple policier maladroit. Pour les fans de Twin Peaks, Andy est un personnage inoubliable qui a contribué à faire de la série l\'une des plus cultes de tous les temps.', '2023-05-01 15:23:39', '2023-05-01 15:23:39', 13);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_creation_date` datetime NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_online` tinyint(1) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `first_name`, `last_name`, `username`, `email`, `password`, `user_creation_date`, `is_admin`, `is_online`, `token`) VALUES
(3, 'Dale', 'Cooper', 'CoopCoop', 'test@mail.com', '$2y$10$5ruyKuqh8RvWq6iHZkkbbunFOoU1nE9HiX.KyScPMsnpsqMMLx8c6', '2023-03-26 15:41:06', 1, 0, '0'),
(4, 'Patrick', 'Sebastien', 'Patoche93', 'test2@mail.com', '$2y$10$5ruyKuqh8RvWq6iHZkkbbunFOoU1nE9HiX.KyScPMsnpsqMMLx8c6', '2023-04-02 09:03:49', 0, 0, '0'),
(13, 'Walter', 'White', 'WW', 'walterheisenberg@mail.com', '$2y$10$pjIsfsO1cer/8jAOKTNY.eSF8AAFZyd/p3edb8C05L3X4Hq6G3SMi', '2023-04-09 19:31:47', 1, 0, '0'),
(19, 'Jean', 'Dujardin', 'Loulou99', 'jeandu@mail.com', '$2y$10$vQTsTe0.7xjpvEWClEKxGu1LDEtyq7pCsGN1UJHPZZHVeA0S2NSzG', '2023-05-20 16:07:56', 0, 0, '0');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
