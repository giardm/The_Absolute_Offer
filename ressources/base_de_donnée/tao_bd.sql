-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 07 avr. 2025 à 16:27
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tao_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Tests & Reviews', 'Critiques et analyses de jeux vidéo récents ou à venir.'),
(2, 'Esport', 'Compétitions, résultats et actus du sport électronique.'),
(3, 'Inclassables / Insolites', 'Histoires surprenantes, exploits originaux ou insolites dans le gaming.'),
(4, 'Accessibilité & Inclusion', 'Avancées, outils et initiatives pour rendre le jeu vidéo plus accessible à tous.'),
(5, 'Événements & Récompenses', 'Cérémonies, salons, festivals et autres grands rendez-vous vidéoludiques.'),
(6, 'Actualités du Jeu Vidéo', 'Toutes les dernières informations et tendances de l’industrie vidéoludique.');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `featured_offers`
--

CREATE TABLE `featured_offers` (
  `featured_offer_id` int(11) NOT NULL,
  `steam_id` int(11) DEFAULT NULL,
  `game_title` varchar(255) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `api_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `featured_offers`
--

INSERT INTO `featured_offers` (`featured_offer_id`, `steam_id`, `game_title`, `added_at`, `user_id`, `api_id`) VALUES
(39, 1245620, 'ELDEN RING', '2025-04-04 10:52:56', 3, 236717),
(40, 2246340, 'Monster Hunter Wilds', '2025-04-04 12:05:22', 3, 287215),
(41, 2622380, 'ELDEN RING NIGHTREIGN', '2025-04-04 12:05:38', 3, 297970),
(42, 367520, 'Hollow Knight', '2025-04-04 12:05:51', 3, 165363),
(43, 504230, 'Celeste', '2025-04-04 12:06:06', 3, 177485);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `thumb_alt` varchar(255) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`news_id`, `title`, `content`, `thumb`, `thumb_alt`, `added_at`, `user_id`, `category_id`) VALUES
(2, 'Elden Ring sans manette : une streameuse termine le jeu avec le cerveau', 'Dans un exploit aussi impressionnant que futuriste, la streameuse Perrikaryal a récemment fait sensation en venant à bout d’Elden Ring, un des jeux les plus difficiles de la décennie… sans même toucher une manette. À la place, elle a utilisé une interface neuronale qui lui permet de contrôler son personnage grâce à son activité cérébrale.\r\n\r\nLe système repose sur un casque EEG (électroencéphalogramme), capable de détecter et d’interpréter certains signaux émis par le cerveau. Grâce à un entraînement rigoureux et une configuration technique sur mesure, Perrikaryal a pu associer différentes actions en jeu à des pensées spécifiques. Par exemple, penser à \"pousser\" pouvait déclencher une attaque, tandis qu’une visualisation mentale différente pouvait permettre d’esquiver ou de se soigner.\r\n\r\nIl a fallu des semaines de préparation, de calibrage et d’adaptation pour que ce projet prenne vie. L’objectif n’était pas seulement de réussir un exploit technique, mais aussi de montrer le potentiel incroyable des interfaces cerveau-machine dans le domaine du jeu vidéo. Cette prouesse ouvre d’ailleurs de nombreuses perspectives, notamment en matière d’accessibilité pour les personnes en situation de handicap.\r\n\r\nAu-delà de la performance, c’est aussi une démonstration d’endurance mentale : se concentrer durant de longues sessions de jeu sans pouvoir se reposer sur des réflexes physiques est une tâche éreintante. Perrikaryal a su prouver qu’avec assez de volonté, de créativité et de technologie, les limites du gameplay traditionnel peuvent être repoussées.\r\n\r\nSa communauté a suivi cette aventure avec admiration, et les extraits de ses streams sont rapidement devenus viraux. Ce n’est peut-être que le début d’une nouvelle ère où notre esprit, littéralement, prendra les commandes.', '/public/images/news/news-01.jpg', 'La streameuse Perrikaryal en train de jouer à Elden Ring', '2025-02-06 06:36:04', 6, 3),
(3, 'Retour sur la dernière Coupe du Monde Fortnite : une compétition dantesque', 'La dernière Coupe du Monde Fortnite a une fois de plus prouvé que le jeu d’Epic Games reste un pilier incontournable de la scène esport internationale. Organisé avec une précision millimétrée, l’événement a rassemblé des millions de spectateurs à travers le monde, aussi bien en ligne qu’en présentiel, et a vu s\'affronter les meilleurs joueurs de la planète pour décrocher une part du cash prize vertigineux mis en jeu.\r\n\r\nCette édition a été marquée par une intensité compétitive sans précédent. Des retournements de situation spectaculaires, des clutchs de dernière seconde, des stratégies inédites et une maîtrise du jeu à couper le souffle ont rythmé chaque partie. On a vu émerger de nouveaux talents prometteurs, capables de rivaliser avec les vétérans de la scène, ce qui a rendu chaque match totalement imprévisible.\r\n\r\nMais au-delà du jeu en lui-même, c’est toute la mise en scène de l’événement qui a bluffé les fans : une production audiovisuelle digne des plus grands spectacles, des animations entre les matchs, des interviews exclusives, et un public chauffé à blanc ont contribué à créer une ambiance unique. Epic Games continue de repousser les limites de ce qu’un événement esport peut être, transformant chaque édition en un véritable show multimédia.\r\n\r\nSur le plan technique, la compétition a aussi mis en lumière l’évolution du gameplay Fortnite dans sa dimension compétitive. De nouvelles mécaniques ont été pleinement exploitées, et le méta du moment a donné lieu à des choix tactiques audacieux, prouvant que le jeu reste en constante évolution, même plusieurs années après sa sortie.\r\n\r\nEnfin, l’engouement sur les réseaux sociaux a été monumental. Chaque highlight, chaque fail, chaque victoire a été relayé, commenté et analysé par la communauté. Cette Coupe du Monde n’a pas seulement été un tournoi : c’était un véritable phénomène culturel, qui prouve que Fortnite est encore loin d’avoir dit son dernier mot.', '/public/images/news/news-02.jpg', 'Logo de la Fortnite Cup', '2025-02-18 06:36:04', 6, 6),
(4, 'Assassin’s Creed Shadows : notre review complète', 'Avec Assassin’s Creed Shadows, Ubisoft nous embarque dans un voyage spectaculaire au cœur du Japon féodal, une période longtemps rêvée par les fans de la saga. Et le moins que l’on puisse dire, c’est que ce nouvel opus ne déçoit pas. Bien au contraire, il redéfinit en profondeur les codes de la série tout en restant fidèle à l’essence qui a fait son succès.\r\n\r\nDès les premières minutes, on est frappé par la richesse de la direction artistique. Les paysages sont somptueux : des forêts de bambous baignées de lumière aux villages enneigés, chaque environnement respire le soin du détail. L’équipe artistique a manifestement mis tout son cœur dans la reconstitution historique, sans tomber dans le piège de la carte postale. L’univers est vivant, habité, et invite constamment à l’exploration.\r\n\r\nLe gameplay a lui aussi été repensé pour offrir une expérience plus fluide et tactique. L’infiltration retrouve une place centrale, avec des mécaniques qui rappellent les tout premiers épisodes de la série, mais modernisées pour correspondre aux standards actuels. Les combats sont plus nerveux, plus techniques, et la possibilité d’incarner deux protagonistes aux approches complémentaires ajoute une belle profondeur stratégique.\r\n\r\nNarrativement, Assassin’s Creed Shadows s’illustre par une histoire dense, mêlant enjeux politiques, conflits de loyauté et quête identitaire. Les dialogues sont bien écrits, les quêtes secondaires parfois aussi captivantes que l’intrigue principale, et le doublage japonais contribue à l’immersion totale. Le jeu propose également de nombreux moments contemplatifs, où l’on peut simplement s’arrêter pour admirer un coucher de soleil sur un temple ou écouter le vent dans les feuilles — une pause bienvenue dans une aventure souvent intense.\r\n\r\nEnfin, impossible de ne pas mentionner les performances techniques. Sur consoles nouvelle génération et PC haut de gamme, le jeu tourne avec une fluidité remarquable. Les temps de chargement sont quasi inexistants, l’IA ennemie a été largement améliorée, et le niveau de finition global témoigne du soin apporté par les développeurs.\r\n\r\nEn résumé, Assassin’s Creed Shadows n’est pas seulement un bon Assassin’s Creed, c’est probablement l’un des meilleurs jeux de la franchise. Un hommage vibrant au Japon médiéval et une preuve que, même après tant d’années, la licence a encore de nombreuses histoires à raconter.', '/public/images/news/news-03.jpg', 'Personnages de Assassin’s Creed Shadows', '2025-03-02 06:36:04', 6, 1),
(5, 'les avancées majeures pour les joueurs en situation de handicap', 'L’industrie du jeu vidéo a longtemps été critiquée pour son manque d’inclusivité envers les personnes en situation de handicap. Pourtant, ces dernières années, les choses évoluent à grande vitesse, et 2024 a été particulièrement marquante en matière d’accessibilité vidéoludique. Ce qui n’était autrefois qu’un bonus pour certains développeurs est désormais devenu une priorité pour de nombreux studios — petits comme grands.\r\n\r\nDes options de reconfiguration complète des touches, des sous-titres dynamiques, des aides visuelles et auditives, des modes daltoniens, ou encore des assistances à la visée : les jeux modernes intègrent de plus en plus de paramètres personnalisables qui permettent aux joueurs de façonner leur expérience selon leurs besoins spécifiques. Des titres comme The Last of Us Part II, Forza Horizon 5 ou plus récemment Spider-Man 2 sont souvent cités en exemple pour leur profondeur d’options et leur volonté réelle de rendre le jeu accessible à tous.\r\n\r\nMais il ne s’agit pas uniquement de fonctionnalités logicielles. Du côté du matériel aussi, l’innovation bat son plein. Des manettes adaptatives comme celle développée par Microsoft, ou des accessoires comme le PlayStation Access Controller, permettent à des personnes ayant une mobilité réduite de retrouver du plaisir à jouer dans de bonnes conditions. De nombreux joueurs saluent la modularité de ces équipements et leur compatibilité avec plusieurs plateformes.\r\n\r\nEn parallèle, de plus en plus de studios intègrent des consultants en accessibilité dès les premières phases de développement, afin que l’inclusivité ne soit pas une simple couche ajoutée en fin de production, mais un pilier central de la conception. Cela se traduit aussi par des tests utilisateurs spécifiques, des retours de communautés engagées, et une communication plus transparente.\r\n\r\nCes efforts commencent à porter leurs fruits. On voit naître une nouvelle génération de joueurs et de créateurs qui considèrent que l’accessibilité ne devrait pas être une option, mais un standard. Des événements comme les Accessibility Awards, qui mettent en lumière les jeux les plus inclusifs de l’année, participent à cette dynamique positive.\r\n\r\nLe chemin est encore long, bien sûr. Tous les jeux ne sont pas encore au même niveau, et certains genres posent encore de grands défis en matière d’accessibilité. Mais le vent tourne, et il souffle dans la bonne direction : celle d’un monde vidéoludique plus ouvert, plus juste et plus respectueux des différences.', '/public/images/news/news-04.jpg', 'Personne en situation de handicap qui joue à la manette', '2025-03-14 06:36:04', 6, 4),
(6, 'Les nominés des derniers Game Awards révélés', 'C’est un moment très attendu par les joueurs, les développeurs et toute l’industrie : la révélation des nominés pour les Game Awards a eu lieu, et comme chaque année, elle a enflammé la toile. Cet événement majeur, souvent surnommé \"les Oscars du jeu vidéo\", célèbre l’excellence vidéoludique sous toutes ses formes, et les sélections de cette édition témoignent d’une année 2024 riche, variée et créative.\r\n\r\nSans grande surprise, on retrouve en tête des nominations plusieurs poids lourds du jeu vidéo. Elden Ring : Shadow of the Erdtree, Baldur’s Gate III, Spider-Man 2 et Starfield figurent parmi les titres les plus représentés, tant pour leurs performances techniques que pour leur direction artistique ou leur narration. Ces jeux ont marqué les esprits et s’affichent comme les grands favoris de la cérémonie.\r\n\r\nMais cette année, les productions indépendantes ne sont pas en reste. Des pépites comme Sea of Stars, Cocoon ou encore Venba se sont taillé une place dans les catégories majeures, démontrant une fois de plus que l’innovation et l’émotion ne sont pas l’apanage des AAA. Ces titres, souvent portés par de petites équipes passionnées, ont su conquérir le cœur des joueurs grâce à leur originalité, leur sincérité et leur gameplay raffiné.\r\n\r\nDu côté des catégories spécifiques, on remarque une grande diversité : meilleure narration, meilleure direction artistique, jeu le plus innovant en accessibilité, performance d’acteur, bande-son de l’année, et bien d’autres encore. Ces distinctions permettent de mettre en lumière des aspects parfois négligés du développement vidéoludique, et rendent hommage au travail titanesque de milliers de créateurs.\r\n\r\nL’annonce des nominés a également été accompagnée de débats enflammés sur les réseaux sociaux, comme c’est souvent le cas. Certains fans regrettent l’absence de leurs jeux préférés, tandis que d’autres se réjouissent de la reconnaissance accordée à des œuvres parfois discrètes. Mais au fond, cette effervescence est aussi ce qui fait la beauté de cette période : elle témoigne de la passion collective pour un médium devenu l’un des plus importants au monde.\r\n\r\nLes Game Awards ne sont pas seulement une cérémonie de récompenses. C’est aussi un moment de rassemblement mondial, un spectacle mêlant musique live, bandes-annonces exclusives et surprises inattendues. L’édition à venir s’annonce comme un grand cru, et tous les regards sont désormais tournés vers la scène, en attendant de découvrir qui repartira avec les prestigieux trophées.', '/public/images/news/news-05.jpg', 'Affiche des Game Awards', '2025-03-26 06:36:04', 6, 5),
(7, 'Karmine Corp sacrée championne du LEC', 'C’est officiel : la Karmine Corp a remporté le titre tant convoité de champion du LEC (League of Legends EMEA Championship), inscrivant une nouvelle page glorieuse dans l’histoire de l’esport français. Ce sacre, longtemps attendu par une fanbase parmi les plus ferventes d’Europe, vient couronner des mois de travail acharné, de stratégie millimétrée et de passion pure.\r\n\r\nL’équipe bleue, fondée par Kameto, Prime et Tretre, a su gravir les échelons de la scène compétitive avec une régularité impressionnante. Après avoir conquis l’ERL (European Regional League) et remporté plusieurs EU Masters, la KCorp a fait une entrée fracassante dans le LEC, et n’a cessé depuis de démontrer qu’elle avait sa place parmi les plus grands. Cette victoire marque une étape décisive : la Karmine n’est plus une équipe montante. Elle est désormais une référence.\r\n\r\nLa finale du LEC a été un moment d’intensité rare, opposant la Karmine à un adversaire redoutable dans une série en BO5 haletante. Portés par un public en délire, que ce soit dans l’arène ou sur les lives, les joueurs de la KCorp ont fait preuve d’un sang-froid et d’une maîtrise exceptionnelle. Chaque appel stratégique, chaque teamfight, chaque macro-décision semblait calibré à la perfection. Des joueurs comme Cabochard, Saken ou encore Targamas ont brillé par leur performance, rappelant à tous pourquoi cette équipe suscite tant d’enthousiasme.\r\n\r\nMais ce succès ne se limite pas au plan sportif. Il représente aussi une victoire culturelle et communautaire. La Karmine Corp, c’est bien plus qu’une structure : c’est un phénomène de société. Avec une communication maîtrisée, un storytelling fort et une base de fans hyper engagée — les fameux \"Ultras\" — la KCorp a su transformer chaque match en événement, chaque victoire en célébration collective.\r\n\r\nLa consécration au LEC vient légitimer un projet qui bouscule les codes, mélangeant entertainment, compétition et identité de marque avec une efficacité redoutable. Et si certains observateurs doutaient encore de la capacité d’une équipe aussi jeune à dominer la scène européenne, cette saison leur a clairement répondu.\r\n\r\nL’avenir s’annonce radieux pour la Karmine Corp. Avec ce titre, elle s’ouvre les portes de la scène mondiale — potentiellement jusqu’aux Worlds — et continue d’écrire une success story à la française qui inspire bien au-delà de l’univers du gaming.', '/public/images/news/news-06.jpg', 'L’équipe Karmine Corp qui soulève le trophée de LEC', '2025-04-07 05:36:04', 6, 2);

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hash_password` varchar(250) NOT NULL,
  `role` varchar(50) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `hash_password`, `role`, `added_at`) VALUES
(1, 'xx_dark_sasuke_xx', 'dark_sasuke@example.com', 'hashed_password_1', 'user', '2025-03-27 10:45:30'),
(2, 'the_great_pineapple_king', 'pineapple_king@example.com', 'hashed_password_2', 'user', '2025-03-27 10:45:30'),
(3, 'super_ninja_sonic', 'ninja_banana@example.com', 'hashed_password_3', 'user', '2025-03-27 10:45:30'),
(4, 'queen_of_the_universe_42', 'queen_universe@example.com', 'hashed_password_4', 'user', '2025-03-27 10:45:30'),
(5, 'mighty_icecream', 'icecream_hero@example.com', 'hashed_password_5', 'user', '2025-03-27 10:45:30'),
(6, 'superadmin', 'superadmin@admin.com', '$2y$10$6nGw.N2iHXpTfbtiXtSdjebuFFqIjk.6CeutI2LsnWfe7AcTV1G.2', 'admin', '2025-04-04 12:25:56');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Index pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `featured_offers`
--
ALTER TABLE `featured_offers`
  ADD PRIMARY KEY (`featured_offer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `featured_offers`
--
ALTER TABLE `featured_offers`
  MODIFY `featured_offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`comment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `featured_offers`
--
ALTER TABLE `featured_offers`
  ADD CONSTRAINT `featured_offers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Contraintes pour la table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
