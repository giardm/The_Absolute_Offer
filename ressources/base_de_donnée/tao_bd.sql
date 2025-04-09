-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 09 avr. 2025 à 16:20
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
  `thumb_path` varchar(255) DEFAULT NULL,
  `thumb_alt` varchar(255) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`news_id`, `title`, `content`, `thumb_path`, `thumb_alt`, `added_at`, `user_id`, `category_id`) VALUES
(34, 'Elden Ring : le DLC « Shadow of the Erdtree » s\'annonce colossal', '<p>FromSoftware frappe à nouveau très fort. Après des mois d\'attente, le studio japonais a enfin dévoilé de nouveaux détails sur le très attendu DLC Shadow of the Erdtree pour Elden Ring. Et le moins que l\'on puisse dire, c\'est que les fans ne vont pas être déçus.</p><p><br></p><p>Prévu pour une sortie cet été, cette extension promet de repousser encore plus les limites du monde ouvert déjà acclamé par la critique. De nouvelles zones, de nouveaux boss et un lore encore plus dense viendront enrichir une expérience déjà monumentale.</p><p><br></p><p>Hidetaka Miyazaki, directeur du jeu, a déclaré lors d\'une interview : « Nous voulions offrir aux joueurs une véritable continuité spirituelle, tout en introduisant des éléments inédits en termes de gameplay et d’exploration. »</p><p><br></p><p>Parmi les nouveautés les plus attendues :</p><p><br></p><p>- Une nouvelle région sombre et mystérieuse à explorer</p><p><br></p><p>- Plus de 10 nouveaux boss inédits</p><p><br></p><p>- Un système de personnalisation d’armes amélioré</p><p><br></p><p>- Un bestiaire encore plus varié, avec des créatures inspirées du folklore nordique</p><p><br></p><p>Les premières images dévoilées laissent entrevoir une ambiance bien plus sombre que celle du jeu de base, flirtant presque avec l’horreur gothique. Les fans de Bloodborne y verront sans doute un clin d’œil.</p><p><br></p><p>Du côté de la communauté, l’enthousiasme est à son comble. Sur Reddit, les spéculations vont bon train. Certains pensent que ce DLC pourrait même servir de passerelle vers un nouvel univers partagé entre les jeux FromSoftware. D\'autres s\'attendent à un twist narratif majeur qui bouleverserait l\'histoire telle qu\'on la connaît.</p><p><br></p><p>Shadow of the Erdtree pourrait bien marquer une nouvelle ère pour les Souls-like. Une chose est sûre : les Terres Intermédiaires n’ont pas encore livré tous leurs secrets.</p>', 'public/images/uploads/67f63d74c008d_sahdow_of_the_erdtree.jpg', 'L\'Arbre-Monde flétri sous un ciel obscur dans Shadow of the Erdtree, le DLC d’Elden Ring', '2025-04-09 09:27:16', 6, 6),
(36, 'Starfield : Une ambition galactique freinée par sa technique', '<p>Après plus d\'une <strong>décennie </strong>d’attente, Starfield, le RPG spatial signé Bethesda, est enfin sorti sur PC et Xbox Series en septembre 2024. Si l’exploration interstellaire et la profondeur du contenu ont <strong>impressionné</strong>, la technique en dents de scie a <strong>refroidi </strong>certains joueurs.</p><p><br></p><p>L’univers de Starfield est <strong>vaste</strong>, <strong>complexe</strong>, et propose plus de <strong>100 </strong>systèmes stellaires à explorer. Le système de création de vaisseaux a été largement salué, tout comme la qualité d’écriture des quêtes principales. Pourtant, malgré les ambitions affichées, le moteur Creation Engine 2 montre ses limites. Problèmes de performances sur les configurations moyennes, bugs de collision et IA parfois aux fraises viennent ternir l’expérience.</p><p><br></p><p>Les critiques oscillent entre 7 et 9/10, avec un point commun : Starfield est une œuvre <strong>ambitieuse</strong>, mais aurait mérité encore <strong>quelques mois</strong> de polish. Bethesda promet déjà <strong>plusieurs </strong>mises à jour majeures d’ici 2025.</p>', 'public/images/uploads/67f643a83661d_starfield_cockpit.jpg', 'Cockpit futuriste dans Starfield, le RPG spatial de Bethesda', '2025-04-09 09:53:44', 6, 1),
(37, 'Valorant Champions 2024 : la Corée sur le toit du monde', '<p>L’édition 2024 des Valorant Champions a offert un spectacle grandiose. La finale opposait DRX (Corée du Sud) à LOUD (Brésil), dans un BO5 historique remporté 3-2 par les Coréens après plus de 5 heures de match.</p><p><br></p><p>Ce tournoi marque un tournant : la Corée, longtemps en retrait dans la scène Valorant face à l’Amérique du Sud et l’Europe, s’impose désormais comme la nouvelle référence stratégique. DRX, avec son style discipliné et son coach visionnaire, a littéralement décortiqué le jeu de ses adversaires.</p><p><br></p><p>Côté audience, Riot Games annonce plus de 3,2 millions de spectateurs en simultané lors de la finale, un record absolu pour le titre.</p>', 'public/images/uploads/67f644185e8ce_drx_champions.jpg', 'L’équipe DRX soulevant le trophée Valorant Champions 2024', '2025-04-09 09:55:36', 6, 2),
(39, 'Un joueur finit Baldur’s Gate 3... avec un grille-pain modifié', '<p>2024 aura vu naître bien des records insolites, mais celui-ci est peut-être le plus farfelu : un joueur australien a terminé Baldur’s Gate 3 en utilisant... un grille-pain customisé en manette.</p><p><br></p><p>Baptisé « Toast Controller », l’appareil fonctionne via un microcontrôleur Arduino et des résistances thermiques simulant des pressions de touches. Oui, vraiment. Chaque tranche de pain lancée active une commande, comme l’ouverture d’un inventaire ou une attaque.</p><p><br></p><p>L’exploit a été accompli en stream sur Twitch en 94 heures. Larian Studios a félicité le joueur en lui envoyant une version dorée du jeu.</p>', 'public/images/uploads/67f645807e539_baldur(s_gate_3.jpg', 'Contrôleur insolite en forme de grille-pain utilisé pour finir Baldur&#039;s Gate 3', '2025-04-09 10:01:36', 6, 3),
(40, 'PlayStation 6 officiellement annoncée : une console pensée pour durer 10 ans', '<p>Sony a enfin levé le voile sur ce qui était jusqu’ici l’un des secrets les mieux gardés de l’industrie : la PlayStation 6, prévue pour fin 2026. Lors d’une conférence exceptionnelle tenue à Tokyo, Jim Ryan (CEO de Sony Interactive Entertainment) a présenté une vision ambitieuse : créer une console évolutive pensée pour durer au moins une décennie, dans un écosystème plus ouvert, plus durable et davantage tourné vers le cloud.</p><p><br></p><p>Le design a immédiatement marqué les esprits : plus compact que la PS5, mais arborant une structure modulaire permettant de changer facilement le SSD, la RAM ou même le GPU. Sony parle d’une architecture « vivante », pensée pour s’adapter aux besoins des développeurs comme des joueurs.</p><p><br></p><p>Côté specs, la bête embarquera un CPU AMD Zen 5 custom, un GPU RDNA 4, et supportera le ray tracing complet avec intelligence dynamique. Mais au-delà de la puissance brute, c’est le système qui fait la différence : la PS6 fonctionnera en synergie avec le PlayStation Cloud Link, un système permettant de jouer à distance sans console physique, avec transfert instantané des sauvegardes.</p><p><br></p><p>Autre nouveauté : la PlayStation ID biométrique. Chaque manette (DualSense Next) intégrera un lecteur d’empreintes pour se connecter, débloquer des sauvegardes chiffrées, ou désactiver l’accès parental en toute sécurité.</p><p><br></p><p>L\'annonce a suscité des réactions explosives sur les réseaux. Xbox, de son côté, a déclaré \"préparer une réponse cohérente\", sans pour autant montrer ses cartes.</p><p><br></p><p>Les précommandes seront ouvertes dès fin 2025, avec un prix estimé autour de 599 €. Préparez vos économies.</p>', 'public/images/uploads/67f6463b6b757_ps6.jpg', 'Prototype conceptuel de la PlayStation 6 présenté par Sony à Tokyo', '2025-04-09 10:04:43', 6, 6),
(41, 'Ubisoft lance Game4All : un moteur de jeu entièrement pensé pour l’accessibilité', '<p>Dans un communiqué inédit, Ubisoft a annoncé cette semaine la création de Game4All, un nouveau moteur de jeu propriétaire conçu avec un objectif unique : l’inclusion totale des personnes en situation de handicap.</p><p><br></p><p>Développé en collaboration avec des associations comme AbleGamers, Handicap International et des experts en neurosciences, Game4All redéfinit ce que signifie « jouer sans barrière ». Le moteur inclut en natif :</p><p><br></p><p>La reconnaissance vocale avancée permettant de jouer intégralement à la voix</p><p><br></p><p>Un mappage gestuel utilisant la caméra frontale ou un simple smartphone</p><p><br></p><p>Une interface adaptative basée sur l’intensité visuelle et auditive de chaque scène</p><p><br></p><p>Un système de sous-titrage dynamique prenant en compte les sons contextuels, les émotions du personnage et les éléments de gameplay</p><p><br></p><p>Mais l’innovation la plus applaudie reste le Game Narrator AI, une IA qui décrit vocalement l’action en direct pour les joueurs malvoyants, avec des accents émotionnels, une compréhension contextuelle et un langage accessible.</p><p><br></p><p>Lancé en interne sur un projet pilote (nom de code : Jade), Game4All pourrait devenir open-source d’ici fin 2025. De nombreux développeurs indépendants ont déjà demandé à participer au programme.</p><p><br></p><p>Cette annonce positionne Ubisoft comme un pionnier de l’accessibilité en jeu vidéo, bien au-delà des simples options de sous-titrage. Une évolution nécessaire, inspirante, et résolument humaine.</p>', 'public/images/uploads/67f64735c2c27_game4all.jpg', 'Joueuse en fauteuil roulant utilisant une manette adaptée pour jouer à un jeu vidéo', '2025-04-09 10:08:53', 6, 4),
(42, 'Une intelligence artificielle crée le premier jeu vidéo... sans développeur humain', '<p>Ce n’est ni une blague, ni un canular. En avril 2024, un laboratoire indépendant de Seattle a révélé avoir conçu un jeu complet, intitulé The Echo Within, entièrement produit par une intelligence artificielle, sans intervention humaine directe.</p><p><br></p><p>L’IA nommée LYRA, entraînée sur plus de 500 millions de lignes de code Unity, 100 000 scripts narratifs et des bibliothèques de design visuel, a été lancée avec une simple instruction : “Crée une aventure narrative jouable en 8 heures”. Deux semaines plus tard, LYRA avait généré :</p><p><br></p><p>Un scénario complet avec trois fins différentes</p><p><br></p><p>Une map interactive de 16 zones</p><p><br></p><p>Des mécaniques de choix à conséquences</p><p><br></p><p>Un système de combat simplifié au tour par tour</p><p><br></p><p>Une bande-son générée par IA avec variations adaptatives</p><p><br></p><p>Les testeurs ayant essayé The Echo Within rapportent une expérience “étrangement fluide et dérangeante”. Le jeu aborde des thèmes philosophiques profonds sur la mémoire, le deuil et le libre arbitre – des concepts que LYRA n’a jamais « vécus ».</p><p><br></p><p>Le code source, analysé par des développeurs humains, est fonctionnel mais... non commenté. « C’est comme si l’IA codait pour elle-même, et non pour un collègue », commente John Navarro, ingénieur chez Epic Games.</p><p><br></p><p>Cette expérience soulève de vraies questions sur la création de contenu automatisée, et les limites (ou pas) de l’art numérique. L’industrie observe avec attention, et peut-être un peu d’appréhension.</p>', 'public/images/uploads/67f647a1173e0_ia.jpg', 'Robot humanoïde en train de réfléchir, entouré de données binaires symbolisant l’intelligence artificielle', '2025-04-09 10:10:41', 6, 3),
(43, 'Senua’s Saga: Hellblade II – Une claque audiovisuelle, mais à quel prix ?', '<p>Sorti au printemps 2024, Senua’s Saga: Hellblade II a confirmé la volonté de Ninja Theory d’élever le jeu vidéo au rang d’expérience cinématographique. En exploitant les capacités de l’Unreal Engine 5 et la puissance de la Xbox Series X, le studio livre un spectacle visuel impressionnant, où chaque expression faciale, chaque souffle du vent et chaque goutte de pluie semblent avoir été capturés avec un soin maniaque.</p><p><br></p><p>Mais ce chef-d\'œuvre visuel soulève une question essentielle : jusqu’où peut-on aller dans la narration émotionnelle sans sacrifier le gameplay ? Le jeu est extrêmement linéaire, avec peu de mécaniques en dehors de la résolution d’énigmes et de quelques combats chorégraphiés. Pour certains, c’est une expérience intime, bouleversante et profondément humaine. Pour d\'autres, une “cinématique de 7 heures”.</p><p><br></p><p>L’aspect audio est à couper le souffle : les voix internes de Senua, toujours aussi angoissantes, sont traitées avec un réalisme binaural saisissant. Le résultat ? Un jeu qui se vit plus qu’il ne se joue.</p>', 'public/images/uploads/67f65f64a491d_hellblades.jpg', 'Senua debout dans une vallée sombre, entourée de brume et de tension dramatique', '2025-04-09 11:52:04', 6, 1),
(44, 'Overwatch 2 : Blizzard relance la scène compétitive avec l’OWC 2024', '<p>Après une année 2023 en demi-teinte, Blizzard revient en force en 2024 avec l’Overwatch Champions Circuit (OWC), une toute nouvelle ligue internationale qui remplace l\'Overwatch League. Ce changement stratégique redonne un coup de fouet à une scène compétitive qui peinait à retrouver son public.</p><p><br></p><p>L’OWC introduit un format hybride mêlant équipes franchisées et équipes open qualifiers, avec une emphase forte sur le contenu communautaire, les streams locaux, et l’interactivité avec le public. Les cashprizes ont été revus à la hausse, et les matchs sont désormais retransmis en réalité augmentée via le système OverStream, une technologie qui permet aux spectateurs de “bouger dans l’arène” pendant les parties.</p><p><br></p><p>Les premières phases du circuit ont déjà vu des équipes comme Team Liquid ou Seoul Dynasty s’imposer comme favoris. Blizzard a promis un soutien à long terme avec un plan sur 5 ans.</p>', 'public/images/uploads/67f65fa002bbe_owc2024.jpg', 'Match d’esport Overwatch 2 en plein direct, avec effets visuels futuristes et ambiance de stade', '2025-04-09 11:53:04', 6, 2),
(45, 'Steam ajoute des filtres d’accessibilité natifs pour tous les jeux', '<p>C’est officiel : depuis janvier 2024, Steam propose désormais des filtres d’accessibilité intégrés à sa plateforme. Grâce à une collaboration entre Valve et plusieurs associations spécialisées, chaque fiche de jeu peut désormais indiquer si le titre supporte :</p><p><br></p><p>- Des sous-titres personnalisables</p><p><br></p><p>- Un mode daltonien</p><p><br></p><p>- Des commandes remappables</p><p><br></p><p>- Un gameplay jouable à une main</p><p><br></p><p>- Des options de lecture audio pour les menus</p><p><br></p><p>Ces filtres sont disponibles dès la page d’accueil, dans les résultats de recherche et même dans les recommandations automatiques. Valve propose également une API gratuite pour que les développeurs puissent intégrer un “badge accessibilité” vérifié.</p><p><br></p><p>L’initiative a été accueillie avec enthousiasme par la communauté, et des plateformes comme GOG ou Epic Games Store ont déjà annoncé vouloir suivre l’exemple.</p>', 'public/images/uploads/67f65fdfa7d40_steam_accessibility.jpg', 'options de customisations des touches pour manettes sur steam', '2025-04-09 11:54:07', 6, 4),
(46, 'Summer Game Fest 2024 : le retour du grand spectacle, sans E3', '<p>Avec la disparition définitive du salon E3, tous les regards étaient tournés vers le Summer Game Fest 2024, orchestré une fois encore par Geoff Keighley. Et cette année, le show a été à la hauteur des attentes.</p><p><br></p><p>Entre les trailers de Ghost of Tsushima 2, Death Stranding 2, et le retour inattendu de F-Zero Reignite, les fans ont eu droit à une avalanche de révélations et de surprises. Le show a duré plus de 3 heures et a été suivi par 12,5 millions de spectateurs en direct.</p><p><br></p><p>L’événement a aussi innové avec une présence en réalité virtuelle pour les utilisateurs Meta Quest 3 et PSVR2 : chaque conférence pouvait être suivie comme si on y était, dans un auditorium virtuel.</p><p><br></p><p>Un moment marquant fut l’apparition surprise de Hideo Kojima, qui a dévoilé un teaser cryptique d’un projet baptisé OD. La hype est bien réelle, et le Summer Game Fest est désormais, sans conteste, le nouveau centre de gravité du jeu vidéo mondial.</p>', 'public/images/uploads/67f6600c0044a_summer_game_fest_2024.webp', 'Scène du Summer Game Fest 2024 avec éclairages colorés et écran géant dévoilant une bande-annonce', '2025-04-09 11:54:52', 6, 5),
(47, 'Ubisoft ressuscite Splinter Cell avec un reboot sombre et narratif', '<p>Attendue depuis près de 10 ans, la licence Splinter Cell renaît enfin avec un reboot complet, officialisé pour fin 2024 sur PC, Xbox Series et PS5. Le projet, confié à Ubisoft Toronto, repart de zéro avec une ambition : moderniser la formule tout en respectant l’ADN d’infiltration tactique.</p><p><br></p><p>Le jeu adoptera un ton plus sombre, inspiré de thrillers modernes comme Jack Ryan ou Zero Dark Thirty. Sam Fisher, doublé par Michael Ironside, est de retour dans une version plus âgée, usée, mais toujours redoutable. Les développeurs promettent une narration non-linéaire avec des embranchements, et une IA ennemie bien plus intelligente.</p><p><br></p><p>Nouveauté majeure : un mode \"Ghost Run\" en ligne qui permettra à plusieurs joueurs de planifier une infiltration en coopération silencieuse, façon Payday mais sans le chaos.</p><p><br></p><p>L’alpha technique prévue pour septembre 2024 est déjà surchargée d’inscriptions.</p>', 'public/images/uploads/67f6602d53859_splinter_cell.jpg', 'Sam Fisher en tenue tactique, éclairé par une lumière verte emblématique dans l’obscurité', '2025-04-09 11:55:25', 6, 6),
(48, 'Like a Dragon: Infinite Wealth – Quand la folie devient chef-d’œuvre', '<p>Le huitième opus de la saga Yakuza, rebaptisée Like a Dragon, revient en force avec Infinite Wealth, un jeu aussi déjanté que profondément humain. Sorti début 2024, ce RPG japonais made in SEGA poursuit les aventures de Ichiban Kasuga à Hawaï, où mafias locales et scandales gouvernementaux s’entrechoquent.</p><p><br></p><p>Le gameplay fusionne des combats au tour par tour toujours plus tactiques, un humour absurde (oui, vous pouvez combattre un dauphin mafieux en peignoir), et des moments de narration d’une tendresse inattendue. Les quêtes secondaires sont hilarantes mais parfois touchantes, avec des thèmes comme la solitude des expatriés ou la pression du succès familial.</p><p><br></p><p>Graphiquement, le jeu impressionne avec des environnements ultra colorés, des expressions faciales réalistes, et un souci du détail qui rivalise avec les plus gros studios occidentaux. La bande-son alterne entre jazz funky, chants japonais et ballades mélancoliques, créant une atmosphère aussi unique que le jeu lui-même.</p><p><br></p><p>Avec plus de 70 heures de contenu principal et une rejouabilité énorme, Infinite Wealth est un incontournable de 2024.</p>', 'public/images/uploads/67f6604fd9d0a_dragon_infinite_wealth.avif', 'Ichiban Kasuga dans Like a Dragon: Infinite Wealth, bras levés sur une plage hawaïenne', '2025-04-09 11:55:59', 6, 1),
(49, 'League of Legends : le patch 14.5 révolutionne la meta compétitive', '<p>Le patch 14.5 de League of Legends, déployé juste avant le MSI 2024, a totalement chamboulé la scène compétitive. Entre les nerfs massifs de la jungle, la refonte de certains objets mythiques, et la montée en puissance des supports en carry, c’est un nouveau jeu que doivent affronter les pros.</p><p><br></p><p>La LCK et la LEC ont immédiatement réagi : on a vu apparaître des picks inattendus comme Brand jungle, Taric top, ou encore un retour inattendu de Twisted Fate mid AP full mobilité.</p><p><br></p><p>Le patch introduit également un nouveau système de \"fatigue de mana\" qui modifie profondément le tempo des early games. Résultat : des parties plus longues, stratégiques, mais aussi parfois plus imprévisibles, ce qui ravit les spectateurs.</p><p><br></p><p>Les analystes saluent la prise de risque de Riot, tandis que certains pros demandent un rollback. Mais une chose est sûre : le patch 14.5 restera dans l’histoire comme celui qui a redéfini les bases.</p>', 'public/images/uploads/67f66077a8dd3_lol_patch_14.5.jpg', 'Aperçu du patch 14.5 de League of Legends, interface avec les changements majeurs en surbrillance', '2025-04-09 11:56:39', 6, 2),
(50, 'Un joueur découvre un easter egg caché depuis 14 ans dans Red Dead Redemption', '<p>En avril 2024, un speedrunner américain connu sous le pseudo DustyDraws a fait une découverte qui a bouleversé la communauté Red Dead : un easter egg resté invisible pendant 14 ans dans le tout premier Red Dead Redemption sur PS3.</p><p><br></p><p>La scène se déclenche si, à un endroit précis de la carte (près du canyon El Presidio), le joueur reste immobile pendant 7 minutes, à cheval, à 4h44 du matin en jeu. Une cinématique jamais répertoriée se déclenche alors, dans laquelle John Marston regarde le lever du soleil tout en parlant de la vie, de la nature, et du destin.</p><p><br></p><p>Rockstar n’a jamais confirmé ou nié l’existence de cet événement. Certains fans pensent que c’était une scène coupée intégrée par erreur, d’autres y voient un hommage codé de développeurs nostalgiques. Reddit est en feu depuis.</p><p><br></p><p>Un documentaire YouTube de 45 minutes retrace l’enquête et la découverte, déjà vu par 2,5 millions de fans en 3 jours.</p>', 'public/images/uploads/67f6609bcbb94_rdr2.webp', 'John Marston regardant l’horizon dans Red Dead Redemption, au lever du soleil', '2025-04-09 11:57:15', 6, 3),
(51, 'Gamescom 2024 : CD Projekt annonce un nouveau Witcher exclusif PC', '<p>La Gamescom 2024 n’a pas manqué de surprises, mais celle qui a fait exploser Internet fut sans doute l’annonce choc de CD Projekt Red : un nouvel opus de la saga The Witcher, exclusivement sur PC (dans un premier temps).</p><p><br></p><p>Baptisé The Witcher: Origins of Chaos, ce nouvel épisode se déroulera plusieurs siècles avant Geralt, à l’époque où les premiers Sorceleurs furent créés. Le studio polonais promet un gameplay plus immersif que jamais : une narration générée partiellement par IA, des villes vivantes à la manière d’un GTA VI, et un système de combat évolutif en fonction du style du joueur.</p><p><br></p><p>Le jeu est prévu pour 2026, mais les premières images ont déjà mis la barre très haut : 4K native, gestion dynamique de la météo magique, et système de “vérités variables” influant sur le monde.</p><p><br></p><p>Les fans sont fous d’impatience. CDPR a confirmé qu’aucun NFT ne serait utilisé dans le jeu, pour éviter les erreurs passées.</p>', 'public/images/uploads/67f660bdbd85f_the_witch_2024.webp', 'Artwork du nouveau jeu The Witcher: Origins of Chaos dévoilé à la Gamescom 2024', '2025-04-09 11:57:49', 6, 5),
(52, 'Horizon Access+ : Guerrilla dévoile un mode narratif sans combat', '<p>Guerrilla Games a surpris positivement les joueurs cette année en annonçant Horizon Access+, une mise à jour gratuite pour Horizon Forbidden West intégrant un tout nouveau mode narratif entièrement jouable sans combat.</p><p><br></p><p>Pensée pour les personnes en situation de handicap moteur ou neurologique, cette version permet de vivre toute l’histoire d’Aloy avec des interactions simplifiées. Les énigmes ont été repensées, les QTE désactivés, et les déplacements assistés avec un seul stick ou la souris.</p><p><br></p><p>Mais le plus impressionnant reste le mode lecture automatique des textes et descriptions de scènes, accessible via un simple raccourci. Ce système repose sur une voix IA naturalisée développée par Sony AI Labs.</p><p><br></p><p>La communauté a salué l\'initiative, la qualifiant de “révolution tranquille” dans l’accessibilité vidéoludique. Espérons que d’autres studios s’en inspireront.</p>', 'public/images/uploads/67f660eb1dd01_aloy_horizon_forbiden_west.jpg', 'Aloy observant l’horizon dans Horizon Forbidden West, avec une interface simplifiée visible à l’écran', '2025-04-09 11:58:35', 6, 4),
(53, 'Elden Ring sans manette : une streameuse termine le jeu avec le cerveau', '<p>Dans un exploit aussi impressionnant que futuriste, la streameuse Perrikaryal a récemment fait sensation en venant à bout d’Elden Ring, un des jeux les plus difficiles de la décennie… sans même toucher une manette. À la place, elle a utilisé une interface neuronale qui lui permet de contrôler son personnage grâce à son activité cérébrale.</p><p><br></p><p>Le système repose sur un casque EEG (électroencéphalogramme), capable de détecter et d’interpréter certains signaux émis par le cerveau. Grâce à un entraînement rigoureux et une configuration technique sur mesure, Perrikaryal a pu associer différentes actions en jeu à des pensées spécifiques. Par exemple, penser à \"pousser\" pouvait déclencher une attaque, tandis qu’une visualisation mentale différente pouvait permettre d’esquiver ou de se soigner.</p><p><br></p><p>Il a fallu des semaines de préparation, de calibrage et d’adaptation pour que ce projet prenne vie. L’objectif n’était pas seulement de réussir un exploit technique, mais aussi de montrer le potentiel incroyable des interfaces cerveau-machine dans le domaine du jeu vidéo. Cette prouesse ouvre d’ailleurs de nombreuses perspectives, notamment en matière d’accessibilité pour les personnes en situation de handicap.</p><p><br></p><p>Au-delà de la performance, c’est aussi une démonstration d’endurance mentale : se concentrer durant de longues sessions de jeu sans pouvoir se reposer sur des réflexes physiques est une tâche éreintante. Perrikaryal a su prouver qu’avec assez de volonté, de créativité et de technologie, les limites du gameplay traditionnel peuvent être repoussées.</p><p><br></p><p>Sa communauté a suivi cette aventure avec admiration, et les extraits de ses streams sont rapidement devenus viraux. Ce n’est peut-être que le début d’une nouvelle ère où notre esprit, littéralement, prendra les commandes.</p><p><br></p><p><br></p>', 'public/images/uploads/67f666f43bfed_eldenring.jpg', 'La streameuse Perrikaryal utilisant un casque EEG pour jouer à Elden Ring avec le cerveau, pendant un combat de boss', '2025-04-09 12:24:20', 6, 3),
(54, 'Retour sur la dernière Coupe du Monde Fortnite : une compétition dantesque', '<p>La dernière Coupe du Monde Fortnite a une fois de plus prouvé que le jeu d’Epic Games reste un pilier incontournable de la scène esport internationale. Organisé avec une précision millimétrée, l’événement a rassemblé des millions de spectateurs à travers le monde, aussi bien en ligne qu’en présentiel, et a vu s\'affronter les meilleurs joueurs de la planète pour décrocher une part du cash prize vertigineux mis en jeu.</p><p><br></p><p>Cette édition a été marquée par une intensité compétitive sans précédent. Des retournements de situation spectaculaires, des clutchs de dernière seconde, des stratégies inédites et une maîtrise du jeu à couper le souffle ont rythmé chaque partie. On a vu émerger de nouveaux talents prometteurs, capables de rivaliser avec les vétérans de la scène, ce qui a rendu chaque match totalement imprévisible.</p><p><br></p><p>Mais au-delà du jeu en lui-même, c’est toute la mise en scène de l’événement qui a bluffé les fans : une production audiovisuelle digne des plus grands spectacles, des animations entre les matchs, des interviews exclusives, et un public chauffé à blanc ont contribué à créer une ambiance unique. Epic Games continue de repousser les limites de ce qu’un événement esport peut être, transformant chaque édition en un véritable show multimédia.</p><p><br></p><p>Sur le plan technique, la compétition a aussi mis en lumière l’évolution du gameplay Fortnite dans sa dimension compétitive. De nouvelles mécaniques ont été pleinement exploitées, et le méta du moment a donné lieu à des choix tactiques audacieux, prouvant que le jeu reste en constante évolution, même plusieurs années après sa sortie.</p><p><br></p><p>Enfin, l’engouement sur les réseaux sociaux a été monumental. Chaque highlight, chaque fail, chaque victoire a été relayé, commenté et analysé par la communauté. Cette Coupe du Monde n’a pas seulement été un tournoi : c’était un véritable phénomène culturel, qui prouve que Fortnite est encore loin d’avoir dit son dernier mot.</p>', 'public/images/uploads/67f6672a4625e_fortnitecup.jpg', 'Logo coloré de la Fortnite World Cup avec un trophée flottant et le bus iconique en fond', '2025-04-09 12:25:14', 6, 2),
(55, 'Assassin’s Creed Shadows : notre review complète', '<p>Avec Assassin’s Creed Shadows, Ubisoft nous embarque dans un voyage spectaculaire au cœur du Japon féodal, une période longtemps rêvée par les fans de la saga. Et le moins que l’on puisse dire, c’est que ce nouvel opus ne déçoit pas. Bien au contraire, il redéfinit en profondeur les codes de la série tout en restant fidèle à l’essence qui a fait son succès.</p><p><br></p><p>Dès les premières minutes, on est frappé par la richesse de la direction artistique. Les paysages sont somptueux : des forêts de bambous baignées de lumière aux villages enneigés, chaque environnement respire le soin du détail. L’équipe artistique a manifestement mis tout son cœur dans la reconstitution historique, sans tomber dans le piège de la carte postale. L’univers est vivant, habité, et invite constamment à l’exploration.</p><p><br></p><p>Le gameplay a lui aussi été repensé pour offrir une expérience plus fluide et tactique. L’infiltration retrouve une place centrale, avec des mécaniques qui rappellent les tout premiers épisodes de la série, mais modernisées pour correspondre aux standards actuels. Les combats sont plus nerveux, plus techniques, et la possibilité d’incarner deux protagonistes aux approches complémentaires ajoute une belle profondeur stratégique.</p><p><br></p><p>Narrativement, Assassin’s Creed Shadows s’illustre par une histoire dense, mêlant enjeux politiques, conflits de loyauté et quête identitaire. Les dialogues sont bien écrits, les quêtes secondaires parfois aussi captivantes que l’intrigue principale, et le doublage japonais contribue à l’immersion totale. Le jeu propose également de nombreux moments contemplatifs, où l’on peut simplement s’arrêter pour admirer un coucher de soleil sur un temple ou écouter le vent dans les feuilles — une pause bienvenue dans une aventure souvent intense.</p><p><br></p><p>Enfin, impossible de ne pas mentionner les performances techniques. Sur consoles nouvelle génération et PC haut de gamme, le jeu tourne avec une fluidité remarquable. Les temps de chargement sont quasi inexistants, l’IA ennemie a été largement améliorée, et le niveau de finition global témoigne du soin apporté par les développeurs.</p><p><br></p><p>En résumé, Assassin’s Creed Shadows n’est pas seulement un bon Assassin’s Creed, c’est probablement l’un des meilleurs jeux de la franchise. Un hommage vibrant au Japon médiéval et une preuve que, même après tant d’années, la licence a encore de nombreuses histoires à raconter.</p><p><br></p><p><br></p>', 'public/images/uploads/67f66757bca30_ac_shadows.jpg', 'Deux personnages d&#039;Assassin&#039;s Creed Shadows en tenue de samouraï et ninja, prêts à combattre devant un château japonais', '2025-04-09 12:25:59', 6, 1),
(56, 'Les avancées majeures pour les joueurs en situation de handicap', '<p>L’industrie du jeu vidéo a longtemps été critiquée pour son manque d’inclusivité envers les personnes en situation de handicap. Pourtant, ces dernières années, les choses évoluent à grande vitesse, et 2024 a été particulièrement marquante en matière d’accessibilité vidéoludique. Ce qui n’était autrefois qu’un bonus pour certains développeurs est désormais devenu une priorité pour de nombreux studios — petits comme grands.</p><p><br></p><p>Des options de reconfiguration complète des touches, des sous-titres dynamiques, des aides visuelles et auditives, des modes daltoniens, ou encore des assistances à la visée : les jeux modernes intègrent de plus en plus de paramètres personnalisables qui permettent aux joueurs de façonner leur expérience selon leurs besoins spécifiques.</p><p><br></p><p>Mais il ne s’agit pas uniquement de fonctionnalités logicielles. Du côté du matériel aussi, l’innovation bat son plein. Des manettes adaptatives comme celle développée par Microsoft, ou des accessoires comme le PlayStation Access Controller, permettent à des personnes ayant une mobilité réduite de retrouver du plaisir à jouer dans de bonnes conditions.</p><p><br></p><p>En parallèle, de plus en plus de studios intègrent des consultants en accessibilité dès les premières phases de développement, afin que l’inclusivité ne soit pas une simple couche ajoutée en fin de production, mais un pilier central de la conception. Cela se traduit aussi par des tests utilisateurs spécifiques, des retours de communautés engagées, et une communication plus transparente.</p><p><br></p><p>Ces efforts commencent à porter leurs fruits. On voit naître une nouvelle génération de joueurs et de créateurs qui considèrent que l’accessibilité ne devrait pas être une option, mais un standard. Des événements comme les Accessibility Awards, qui mettent en lumière les jeux les plus inclusifs de l’année, participent à cette dynamique positive.</p>', 'public/images/uploads/67f6679e79c8a_accessibility.jpg', 'Joueur en situation de handicap tenant une manette adaptative avec les bras, concentré sur une partie', '2025-04-09 12:27:10', 6, 4),
(57, 'Les nominés des derniers Game Awards révélés', '<p>C’est un moment très attendu par les joueurs, les développeurs et toute l’industrie : la révélation des nominés pour les Game Awards a eu lieu, et comme chaque année, elle a enflammé la toile. Cet événement majeur, souvent surnommé \"les Oscars du jeu vidéo\", célèbre l’excellence vidéoludique sous toutes ses formes, et les sélections de cette édition témoignent d’une année 2024 riche, variée et créative.</p><p><br></p><p>Sans grande surprise, on retrouve en tête des nominations plusieurs poids lourds du jeu vidéo. Elden Ring : Shadow of the Erdtree, Baldur’s Gate III, Spider-Man 2 et Starfield figurent parmi les titres les plus représentés, tant pour leurs performances techniques que pour leur direction artistique ou leur narration. Ces jeux ont marqué les esprits et s’affichent comme les grands favoris de la cérémonie.</p><p><br></p><p>Mais cette année, les productions indépendantes ne sont pas en reste. Des pépites comme Sea of Stars, Cocoon ou encore Venba se sont taillé une place dans les catégories majeures, démontrant une fois de plus que l’innovation et l’émotion ne sont pas l’apanage des AAA. Ces titres, souvent portés par de petites équipes passionnées, ont su conquérir le cœur des joueurs grâce à leur originalité, leur sincérité et leur gameplay raffiné.</p><p><br></p><p>Du côté des catégories spécifiques, on remarque une grande diversité : meilleure narration, meilleure direction artistique, jeu le plus innovant en accessibilité, performance d’acteur, bande-son de l’année, et bien d’autres encore. Ces distinctions permettent de mettre en lumière des aspects parfois négligés du développement vidéoludique, et rendent hommage au travail titanesque de milliers de créateurs.</p><p><br></p><p>L’annonce des nominés a également été accompagnée de débats enflammés sur les réseaux sociaux, comme c’est souvent le cas. Certains fans regrettent l’absence de leurs jeux préférés, tandis que d’autres se réjouissent de la reconnaissance accordée à des œuvres parfois discrètes. Mais au fond, cette effervescence est aussi ce qui fait la beauté de cette période : elle témoigne de la passion collective pour un médium devenu l’un des plus importants au monde.</p><p><br></p><p>Les Game Awards ne sont pas seulement une cérémonie de récompenses. C’est aussi un moment de rassemblement mondial, un spectacle mêlant musique live, bandes-annonces exclusives et surprises inattendues. L’édition à venir s’annonce comme un grand cru, et tous les regards sont désormais tournés vers la scène, en attendant de découvrir qui repartira avec les prestigieux trophées.</p>', 'public/images/uploads/67f667c58ba90_gamewards.jpg', 'Affiche rouge et noire des Game Awards avec la date de l&#039;événement et la silhouette stylisée du trophée', '2025-04-09 12:27:49', 6, 5),
(58, ' Karmine Corp sacrée championne du LEC', '<p>C’est officiel : la Karmine Corp a remporté le titre tant convoité de <strong>champion </strong>du LEC (League of Legends EMEA Championship), inscrivant une nouvelle page glorieuse dans l’histoire de l’esport français. Ce sacre, longtemps attendu par une fanbase parmi les plus ferventes d’Europe, vient couronner des mois de travail acharné, de stratégie millimétrée et de passion pure.</p><p><br></p><p>L’équipe bleue, fondée par Kameto, Prime et Tretre, a su gravir les échelons de la scène compétitive avec une régularité impressionnante. Après avoir conquis l’ERL (European Regional League) et remporté plusieurs EU Masters, la KCorp a fait une entrée fracassante dans le LEC, et n’a cessé depuis de démontrer qu’elle avait sa place parmi les plus grands. Cette victoire marque une étape décisive : la Karmine n’est plus une équipe montante. Elle est désormais une référence.</p><p><br></p><p>La finale du LEC a été un moment d’intensité rare, opposant la Karmine à un adversaire redoutable dans une série en BO5 haletante. Portés par un public en délire, que ce soit dans l’arène ou sur les lives, les joueurs de la KCorp ont fait preuve d’un sang-froid et d’une maîtrise exceptionnelle. Chaque appel stratégique, chaque teamfight, chaque macro-décision semblait calibré à la perfection. Des joueurs comme Cabochard, Saken ou encore Targamas ont brillé par leur performance, rappelant à tous pourquoi cette équipe suscite tant d’enthousiasme.</p><p><br></p><p>Mais ce succès ne se limite pas au plan sportif. Il représente aussi une victoire culturelle et communautaire. La Karmine Corp, c’est bien plus qu’une structure : c’est un phénomène de société. Avec une communication maîtrisée, un storytelling fort et une base de fans hyper engagée — les fameux \"Ultras\" — la KCorp a su transformer chaque match en événement, chaque victoire en célébration collective.</p><p><br></p><p>La consécration au LEC vient légitimer un projet qui bouscule les codes, mélangeant entertainment, compétition et identité de marque avec une efficacité redoutable. Et si certains observateurs doutaient encore de la capacité d’une équipe aussi jeune à dominer la scène européenne, cette saison leur a clairement répondu.</p><p><br></p><p>L’avenir s’annonce radieux pour la Karmine Corp. Avec ce titre, elle s’ouvre les portes de la scène mondiale — potentiellement jusqu’aux Worlds — et continue d’écrire une success story à la française qui inspire bien au-delà de l’univers du gaming.</p><p><br></p><p><br></p>', 'public/images/uploads/67f668789ee4e_kc_lec.jpg', 'L’équipe Karmine Corp levant le trophée du LEC sur une scène illuminée, entourée d’effets lumineux et de fans', '2025-04-09 12:30:48', 6, 2);

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
(6, 'superadmin', 'superadmin@admin.com', '$2y$10$6nGw.N2iHXpTfbtiXtSdjebuFFqIjk.6CeutI2LsnWfe7AcTV1G.2', 'admin', '2025-04-04 12:25:56'),
(7, 'superuser', 'superuser@gmail.com', '$2y$10$5v4Sn7rCglq9cNwGD3MiAu9npNcH1TT59B1v9QnRWTGzBmzgqqGP6', 'user', '2025-04-09 13:59:26');

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
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
