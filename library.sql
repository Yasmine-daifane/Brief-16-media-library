-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 27 mars 2023 à 14:21
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `library`
--

-- --------------------------------------------------------

--
-- Structure de la table `adhérent`
--

CREATE TABLE `adhérent` (
  `Id_adhérent` int(11) NOT NULL,
  `adresse` varchar(63) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `CIN` varchar(50) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `occupation` varchar(53) DEFAULT NULL,
  `pénalité` int(11) NOT NULL,
  `compte_date` date NOT NULL,
  `Nickname` varchar(59) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `role` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adhérent`
--

INSERT INTO `adhérent` (`Id_adhérent`, `adresse`, `email`, `phone`, `CIN`, `birth_date`, `occupation`, `pénalité`, `compte_date`, `Nickname`, `password`, `full_name`, `role`) VALUES
(2, 'mers achennad', 'ilias@gmail.com', 626916989, 'KB5646367', '2001-08-06', 'student', 0, '2023-03-25', '111HH', '$2y$10$WcyH97fSIQYVzQZIEa5XauiHfQ8reGv9wts53T6kkF1lvgzqUN8cC', 'Ilias anouar', 1),
(3, 'beniouuu', 'jalil.jojo@gmail.com', 676543568, 'HH56078', '2012-06-26', 'student', 0, '2023-03-27', 'yasmine', '$2y$10$WCAWJVJNqSEWOG7VJK/oLeOJ7S/7jB7rbm.B0ZCEEBh8LichQ3n66', 'jalil jojo', 0),
(4, 'user house', 'user@gmail.com', 600000000, 'US0000', '2023-01-18', 'student', 0, '2023-03-27', 'user', '$2y$10$d0IKyXn6BOvlUg.6.WpOo./YonD0oyRsIl0pg78a8u8dEiH7gYhqy', 'user', 0),
(5, 'admin house', 'admin@gmail.com', 755543778, 'HH56052', '2019-10-26', 'student', 0, '2023-03-27', '888HH', '$2y$10$FiBmdyi2.ejJxfJlJCh/EuQTaPiO/NhPPo4jYxmmI15C6ZkiUUHG6', 'admin', 1);

-- --------------------------------------------------------

--
-- Structure de la table `l_emprunt`
--

CREATE TABLE `l_emprunt` (
  `Id_l_emprunt` int(11) NOT NULL,
  `la_date_d_emprunt` date NOT NULL,
  `la_date_du_retour` date NOT NULL,
  `Id_adhérent` int(11) NOT NULL,
  `Id_reservation` int(11) NOT NULL,
  `Id_ouvrage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `l_emprunt`
--

INSERT INTO `l_emprunt` (`Id_l_emprunt`, `la_date_d_emprunt`, `la_date_du_retour`, `Id_adhérent`, `Id_reservation`, `Id_ouvrage`) VALUES
(1, '2023-03-27', '0000-00-00', 4, 1, 9);

-- --------------------------------------------------------

--
-- Structure de la table `ouvrage`
--

CREATE TABLE `ouvrage` (
  `Id_ouvrage` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `nom_de_l_auteur` varchar(50) NOT NULL,
  `l_mage_de_couverture` varchar(50) DEFAULT NULL,
  `l_etat` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date_d_achat` date NOT NULL,
  `la_date_d_édition` year(4) NOT NULL,
  `status` varchar(50) NOT NULL,
  `N_pages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ouvrage`
--

INSERT INTO `ouvrage` (`Id_ouvrage`, `titre`, `nom_de_l_auteur`, `l_mage_de_couverture`, `l_etat`, `type`, `date_d_achat`, `la_date_d_édition`, `status`, `N_pages`) VALUES
(2, 'Fairy tales', ' Hans Christian Andersen', 'images/fairy-tales.jpg', 'Good condition', 'Collection', '2023-03-26', 0000, 'not', 784),
(4, 'The Epic Of Gilgamesh', ' Unknown', 'images/the-epic-of-gilgamesh.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'not', 160),
(5, 'The Book Of Job', ' Unknown', 'images/the-book-of-job.jpg', 'New', 'novel', '2023-03-26', 0000, 'valable', 176),
(6, 'One Thousand and One Nights', ' Unknown', 'images/one-thousand-and-one-nights.jpg', 'New', 'novel', '2023-03-26', 0000, 'not', 288),
(7, 'Pride and Prejudice', ' Jane Austen', 'images/pride-and-prejudice.jpg', 'New', 'novel', '2023-03-26', 0000, 'not', 226),
(8, 'Le Père Goriot', ' Honoré de Balzac', 'images/le-pere-goriot.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 443),
(9, 'Molloy, Malone Dies, The Unnamable, the trilogy', ' Samuel Beckett', 'images/molloy-malone-dies-the-unnamable.jpg', 'Good condition', 'novel', '2023-03-26', 1952, 'not', 256),
(10, 'The Decameron', ' Giovanni Boccaccio', 'images/the-decameron.jpg', 'New', 'novel', '2023-03-26', 0000, 'valable', 1024),
(11, 'Ficciones', ' Jorge Luis Borges', 'images/ficciones.jpg', 'New', 'novel', '2023-03-26', 1965, 'valable', 224),
(12, 'Wuthering Heights', ' Emily Brontë', 'images/wuthering-heights.jpg', 'New', 'novel', '2023-03-26', 0000, 'valable', 342),
(14, 'Poems', ' Paul Celan', 'images/poems-paul-celan.jpg', 'Good condition', 'novel', '2023-03-26', 1952, 'valable', 320),
(15, 'Journey to the End of the Night', ' Louis-Ferdinand Céline', 'images/voyage-au-bout-de-la-nuit.jpg', 'Good condition', 'novel', '2023-03-26', 1932, 'valable', 505),
(16, 'Don Quijote De La Mancha', ' Miguel de Cervantes', 'images/don-quijote-de-la-mancha.jpg', 'New', 'novel', '2023-03-26', 0000, 'valable', 1056),
(17, 'The Canterbury Tales', ' Geoffrey Chaucer', 'images/the-canterbury-tales.jpg', 'Acceptable', 'novel', '2023-03-26', 0000, 'valable', 544),
(18, 'Stories', ' Anton Chekhov', 'images/stories-of-anton-chekhov.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 194),
(19, 'Nostromo', ' Joseph Conrad', 'images/nostromo.jpg', 'New', 'novel', '2023-03-26', 1904, 'valable', 320),
(20, 'Great Expectations', ' Charles Dickens', 'images/great-expectations.jpg', 'New', 'novel', '2023-03-26', 0000, 'valable', 194),
(21, 'Jacques the Fatalist', ' Denis Diderot', 'images/jacques-the-fatalist.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 596),
(22, 'Berlin Alexanderplatz', ' Alfred Döblin', 'images/berlin-alexanderplatz.jpg', 'Acceptable', 'novel', '2023-03-26', 1929, 'valable', 600),
(23, 'Crime and Punishment', ' Fyodor Dostoevsky', 'images/crime-and-punishment.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 245),
(24, 'The Idiot', ' Fyodor Dostoevsky', 'images/the-idiot.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 656),
(25, 'The Possessed', ' Fyodor Dostoevsky', 'images/the-possessed.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 768),
(26, 'The Brothers Karamazov', ' Fyodor Dostoevsky', 'images/the-brothers-karamazov.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 824),
(27, 'Middlemarch', ' George Eliot', 'images/middlemarch.jpg', 'New', 'novel', '2023-03-26', 0000, 'valable', 800),
(28, 'Invisible Man', ' Ralph Ellison', 'images/invisible-man.jpg', 'quite used', 'novel', '2023-03-26', 1952, 'valable', 581),
(29, 'Medea', ' Euripides', 'images/medea.jpg', 'Acceptable', 'novel', '2023-03-26', 0000, 'not', 104),
(30, 'Absalom, Absalom!', ' William Faulkner', 'images/absalom-absalom.jpg', 'quite used', 'novel', '2023-03-26', 1936, 'valable', 313),
(31, 'The Sound and the Fury', ' William Faulkner', 'images/the-sound-and-the-fury.jpg', 'quite used', 'novel', '2023-03-26', 1929, 'valable', 326),
(32, 'Madame Bovary', ' Gustave Flaubert', 'images/madame-bovary.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 528),
(33, 'Sentimental Education', ' Gustave Flaubert', 'images/l-education-sentimentale.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 606),
(34, 'Gypsy Ballads', ' Federico García Lorca', 'images/gypsy-ballads.jpg', 'New', 'novel', '2023-03-26', 1928, 'valable', 218),
(35, 'One Hundred Years of Solitude', ' Gabriel García Márquez', 'images/one-hundred-years-of-solitude.jpg', 'Good condition', 'novel', '2023-03-26', 1967, 'valable', 417),
(36, 'Love in the Time of Cholera', ' Gabriel García Márquez', 'images/love-in-the-time-of-cholera.jpg', 'Good condition', 'novel', '2023-03-26', 1985, 'valable', 368),
(37, 'Faust', ' Johann Wolfgang von Goethe', 'images/faust.jpg', 'New', 'novel', '2023-03-26', 0000, 'valable', 158),
(38, 'Dead Souls', ' Nikolai Gogol', 'images/dead-souls.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 432),
(39, 'The Tin Drum', ' Günter Grass', 'images/the-tin-drum.jpg', 'Acceptable', 'novel', '2023-03-26', 1959, 'valable', 600),
(40, 'The Devil to Pay in the Backlands', ' João Guimarães Rosa', 'images/the-devil-to-pay-in-the-backlands.jpg', 'quite used', 'novel', '2023-03-26', 1956, 'valable', 494),
(41, 'Hunger', ' Knut Hamsun', 'images/hunger.jpg', 'quite used', 'novel', '2023-03-26', 0000, 'valable', 176),
(42, 'The Old Man and the Sea', ' Ernest Hemingway', 'images/the-old-man-and-the-sea.jpg', 'quite used', 'novel', '2023-03-26', 1952, 'valable', 128),
(43, 'Iliad', ' Homer', 'images/the-iliad-of-homer.jpg', 'Acceptable', 'novel', '2023-03-26', 0000, 'valable', 608),
(44, 'Odyssey', ' Homer', 'images/the-odyssey-of-homer.jpg', 'Acceptable', 'novel', '2023-03-26', 0000, 'valable', 374),
(45, 'Ulysses', ' James Joyce', 'images/ulysses.jpg', 'Acceptable', 'novel', '2023-03-26', 1922, 'valable', 228),
(46, 'Stories', ' Franz Kafka', 'images/stories-of-franz-kafka.jpg', 'New', 'novel', '2023-03-26', 1924, 'valable', 488),
(47, 'The Trial', ' Franz Kafka', 'images/the-trial.jpg', 'Acceptable', 'novel', '2023-03-26', 1925, 'valable', 160),
(48, 'The Castle', ' Franz Kafka', 'images/the-castle.jpg', 'New', 'novel', '2023-03-26', 1926, 'valable', 352),
(49, 'The recognition of Shakuntala', ' Kālidāsa', 'images/the-recognition-of-shakuntala.jpg', 'New', 'novel', '2023-03-26', 0000, 'valable', 147),
(50, 'The Sound of the Mountain', ' Yasunari Kawabata', 'images/the-sound-of-the-mountain.jpg', 'Acceptable', 'novel', '2023-03-26', 1954, 'valable', 288),
(51, 'Zorba the Greek', ' Nikos Kazantzakis', 'images/zorba-the-greek.jpg', 'Acceptable', 'novel', '2023-03-26', 1946, 'valable', 368),
(52, 'Sons and Lovers', ' D. H. Lawrence', 'images/sons-and-lovers.jpg', 'New', 'novel', '2023-03-26', 1913, 'valable', 432),
(53, 'Independent People', ' Halldór Laxness', 'images/independent-people.jpg', 'quite used', 'novel', '2023-03-26', 1934, 'valable', 470),
(55, 'The Golden Notebook', ' Doris Lessing', 'images/the-golden-notebook.jpg', 'New', 'novel', '2023-03-26', 1962, 'valable', 688),
(56, 'Pippi Longstocking', ' Astrid Lindgren', 'images/pippi-longstocking.jpg', 'quite used', 'novel', '2023-03-26', 1945, 'valable', 160),
(57, 'Diary of a Madman', ' Lu Xun', 'images/diary-of-a-madman.jpg', 'quite used', 'novel', '2023-03-26', 1918, 'valable', 389),
(58, 'Children of Gebelawi', ' Naguib Mahfouz', 'images/children-of-gebelawi.jpg', 'quite used', 'novel', '2023-03-26', 1959, 'valable', 355),
(59, 'Buddenbrooks', ' Thomas Mann', 'images/buddenbrooks.jpg', 'Acceptable', 'novel', '2023-03-26', 1901, 'valable', 736),
(60, 'The Magic Mountain', ' Thomas Mann', 'images/the-magic-mountain.jpg', 'Acceptable', 'novel', '2023-03-26', 1924, 'valable', 720),
(61, 'Moby Dick', ' Herman Melville', 'images/moby-dick.jpg', 'quite used', 'novel', '2023-03-26', 0000, 'valable', 378),
(62, 'Essays', ' Michel de Montaigne', 'images/essais.jpg', 'Good condition', 'Montaigne', '2023-03-26', 0000, 'valable', 404),
(63, 'History', ' Elsa Morante', 'images/history.jpg', 'New', 'novel', '2023-03-26', 1974, 'valable', 600),
(64, 'Beloved', ' Toni Morrison', 'images/beloved.jpg', 'quite used', 'novel', '2023-03-26', 1987, 'valable', 321),
(65, 'The Tale of Genji', ' Murasaki Shikibu', 'images/the-tale-of-genji.jpg', 'Acceptable', 'novel', '2023-03-26', 0000, 'valable', 1360),
(66, 'The Man Without Qualities', ' Robert Musil', 'images/the-man-without-qualities.jpg', 'Acceptable', 'novel', '2023-03-26', 1931, 'valable', 365),
(67, 'Lolita', ' Vladimir Nabokov', 'images/lolita.jpg', 'Good condition', 'novel', '2023-03-26', 1955, 'valable', 317),
(68, 'Nineteen Eighty-Four', ' George Orwell', 'images/nineteen-eighty-four.jpg', 'New', 'novel', '2023-03-26', 1949, 'valable', 272),
(69, 'Metamorphoses', ' Ovid', 'images/the-metamorphoses-of-ovid.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 576),
(70, 'The Book of Disquiet', ' Fernando Pessoa', 'images/the-book-of-disquiet.jpg', 'Good condition', 'novel', '2023-03-26', 1928, 'valable', 272),
(71, 'Tales', ' Edgar Allan Poe', 'images/tales-and-poems-of-edgar-allan-poe.jpg', 'quite used', 'novel', '2023-03-26', 1950, 'valable', 842),
(72, 'In Search of Lost Time', ' Marcel Proust', 'images/a-la-recherche-du-temps-perdu.jpg', 'Good condition', 'novel', '2023-03-26', 1920, 'valable', 2408),
(73, 'Gargantua and Pantagruel', ' François Rabelais', 'images/gargantua-and-pantagruel.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 623),
(74, 'Pedro Paramo', ' Juan Rulfo', 'images/pedro-paramo.jpg', 'Good condition', 'novel', '2023-03-26', 1955, 'valable', 124),
(75, 'The Masnavi', ' Rumi', 'images/the-masnavi.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 438),
(76, 'Midnights Children', ' Salman Rushdie', 'images/midnights-children.jpg', 'New', 'novel', '2023-03-26', 1981, 'valable', 536),
(77, 'Bostan', ' Saadi', 'images/bostan.jpg', 'New', 'book', '2023-03-26', 0000, 'valable', 298),
(78, 'Season of Migration to the North', ' Tayeb Salih', 'images/season-of-migration-to-the-north.jpg', 'New', 'novel', '2023-03-26', 1966, 'valable', 139),
(79, 'Blindness', ' José Saramago', 'images/blindness.jpg', 'New', 'novel', '2023-03-26', 1995, 'valable', 352),
(80, 'Hamlet', ' William Shakespeare', 'images/hamlet.jpg', 'Acceptable', 'novel', '2023-03-26', 0000, 'valable', 432),
(81, 'King Lear', ' William Shakespeare', 'images/king-lear.jpg', 'Acceptable', 'novel', '2023-03-26', 0000, 'valable', 384),
(82, 'Othello', ' William Shakespeare', 'images/othello.jpg', 'Acceptable', 'novel', '2023-03-26', 0000, 'valable', 314),
(83, 'Oedipus the King', ' Sophocles', 'images/oedipus-the-king.jpg', 'Acceptable', 'novel', '2023-03-26', 0000, 'valable', 88),
(84, 'The Red and the Black', ' Stendhal', 'images/le-rouge-et-le-noir.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 576),
(85, 'The Life And Opinions of Tristram Shandy', ' Laurence Sterne', 'images/the-life-and-opinions-of-tristram-shandy.jp', 'Acceptable', 'novel', '2023-03-26', 0000, 'valable', 640),
(86, 'Confessions of Zeno', ' Italo Svevo', 'images/confessions-of-zeno.jpg', 'New', 'novel', '2023-03-26', 1923, 'valable', 412),
(87, 'Gullivers Travels', ' Jonathan Swift', 'images/gullivers-travels.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 178),
(88, 'War and Peace', ' Leo Tolstoy', 'images/war-and-peace.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 1296),
(89, 'Anna Karenina', ' Leo Tolstoy', 'images/anna-karenina.jpg', 'Good condition', 'novel', '2023-03-26', 0000, 'valable', 864),
(90, 'The Death of Ivan Ilyich', ' Leo Tolstoy', 'images/the-death-of-ivan-ilyich.jpg', 'Good condition', 'book', '2023-03-26', 0000, 'valable', 92),
(91, 'The Adventures of Huckleberry Finn', ' Mark Twain', 'images/the-adventures-of-huckleberry-finn.jpg', 'quite used', 'novel', '2023-03-26', 0000, 'valable', 224),
(92, 'Ramayana', ' Valmiki', 'images/ramayana.jpg', 'New', 'book', '2023-03-26', 0000, 'valable', 152),
(93, 'The Aeneid', ' Virgil', 'images/the-aeneid.jpg', 'New', 'book', '2023-03-26', 0000, 'valable', 442),
(94, 'Mahabharata', ' Vyasa', 'images/the-mahab-harata.jpg', 'New', 'book', '2023-03-26', 0000, 'valable', 276),
(95, 'Leaves of Grass', ' Walt Whitman', 'images/leaves-of-grass.jpg', 'quite used', 'book', '2023-03-26', 0000, 'valable', 152),
(96, 'Mrs Dalloway', ' Virginia Woolf', 'images/mrs-dalloway.jpg', 'New', 'book', '2023-03-26', 1925, 'valable', 216),
(97, 'To the Lighthouse', ' Virginia Woolf', 'images/to-the-lighthouse.jpg', 'New', 'book', '2023-03-26', 1927, 'valable', 209),
(98, 'Memoirs of Hadrian', ' Marguerite Yourcenar', 'images/memoirs-of-hadrian.jpg', 'Good condition', 'book', '2023-03-26', 1951, 'valable', 408),
(100, '', '', NULL, '', '', '0000-00-00', 0000, 'not', 0);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `Id_reservation` int(11) NOT NULL,
  `date_de_reservation` date NOT NULL,
  `la_date_d_exper` date NOT NULL,
  `Id_ouvrage` int(11) NOT NULL,
  `Id_adhérent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`Id_reservation`, `date_de_reservation`, `la_date_d_exper`, `Id_ouvrage`, `Id_adhérent`) VALUES
(1, '2023-03-27', '0000-00-00', 9, 4),
(2, '2023-03-27', '0000-00-00', 7, 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adhérent`
--
ALTER TABLE `adhérent`
  ADD PRIMARY KEY (`Id_adhérent`),
  ADD UNIQUE KEY `Nickname` (`Nickname`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `CIN` (`CIN`);

--
-- Index pour la table `l_emprunt`
--
ALTER TABLE `l_emprunt`
  ADD PRIMARY KEY (`Id_l_emprunt`),
  ADD KEY `Id_ouvrage` (`Id_ouvrage`);

--
-- Index pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  ADD PRIMARY KEY (`Id_ouvrage`),
  ADD UNIQUE KEY `l_mage_de_couverture` (`l_mage_de_couverture`),
  ADD UNIQUE KEY `l_mage_de_couverture_2` (`l_mage_de_couverture`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Id_reservation`),
  ADD KEY `Id_ouvrage` (`Id_ouvrage`),
  ADD KEY `Id_adhérent` (`Id_adhérent`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adhérent`
--
ALTER TABLE `adhérent`
  MODIFY `Id_adhérent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `l_emprunt`
--
ALTER TABLE `l_emprunt`
  MODIFY `Id_l_emprunt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  MODIFY `Id_ouvrage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `l_emprunt`
--
ALTER TABLE `l_emprunt`
  ADD CONSTRAINT `l_emprunt_ibfk_1` FOREIGN KEY (`Id_adhérent`) REFERENCES `adhérent` (`Id_adhérent`),
  ADD CONSTRAINT `l_emprunt_ibfk_2` FOREIGN KEY (`Id_reservation`) REFERENCES `reservation` (`Id_reservation`),
  ADD CONSTRAINT `l_emprunt_ibfk_3` FOREIGN KEY (`Id_ouvrage`) REFERENCES `ouvrage` (`Id_ouvrage`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`Id_ouvrage`) REFERENCES `ouvrage` (`Id_ouvrage`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`Id_adhérent`) REFERENCES `adhérent` (`Id_adhérent`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
