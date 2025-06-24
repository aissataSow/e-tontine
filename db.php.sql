-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 27 mai 2025 à 18:35
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
-- Base de données : `e_tontine`
--

-- --------------------------------------------------------

--
-- Structure de la table `cotisations`
--

CREATE TABLE `cotisations` (
  `id` int(11) NOT NULL,
  `tontine_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  `date_paiement` date DEFAULT curdate(),
  `statut` enum('payé','en attente') DEFAULT 'payé',
  `date_cotisation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cotisations`
--

INSERT INTO `cotisations` (`id`, `tontine_id`, `user_id`, `montant`, `date_paiement`, `statut`, `date_cotisation`) VALUES
(13, 10, 11, 5250.00, '2025-05-19', 'payé', '2025-05-19 21:35:56'),
(14, 6, 11, 5250.00, '2025-05-20', 'payé', '2025-05-20 11:35:02'),
(15, 6, 12, 5250.00, '2025-05-20', 'payé', '2025-05-20 11:39:52'),
(16, 6, 13, 5250.00, '2025-05-20', 'payé', '2025-05-20 13:52:01'),
(17, 6, 14, 5250.00, '2025-05-20', 'payé', '2025-05-20 19:28:18'),
(18, 6, 16, 5250.00, '2025-05-26', 'payé', '2025-05-26 13:42:39'),
(19, 10, 16, 5250.00, '2025-05-26', 'payé', '2025-05-26 23:04:09'),
(20, 6, 13, 5250.00, '2025-05-26', 'payé', '2025-05-26 23:11:56'),
(21, 6, 11, 5250.00, '2025-05-27', 'payé', '2025-05-27 15:26:24');

-- --------------------------------------------------------

--
-- Structure de la table `historiques`
--

CREATE TABLE `historiques` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `date_action` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participations`
--

CREATE TABLE `participations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tontine_id` int(11) NOT NULL,
  `date_participation` date DEFAULT curdate(),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `participations`
--

INSERT INTO `participations` (`id`, `user_id`, `tontine_id`, `date_participation`, `created_at`) VALUES
(10, 11, 10, '2025-05-19', '2025-05-20 01:58:51'),
(11, 11, 6, '2025-05-20', '2025-05-20 11:34:46'),
(12, 12, 6, '2025-05-20', '2025-05-20 11:39:33'),
(13, 13, 6, '2025-05-20', '2025-05-20 13:51:54'),
(14, 14, 6, '2025-05-20', '2025-05-20 19:28:04'),
(15, 16, 6, '2025-05-26', '2025-05-26 13:37:08'),
(16, 16, 10, '2025-05-26', '2025-05-26 23:03:34');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expire_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `expire_at`, `expires_at`) VALUES
(1, 15, '466d087a3602b1b594ec79626db9d9b9fcbb694d3da87751335c30baa0b63844', '2025-05-21 02:15:01', '2025-05-21 00:51:02'),
(2, 15, 'dec3681551aa7318dabb927fe421dba746bcdc5cf4ee72f9fbac25ff90915a7d', '2025-05-21 02:15:12', '2025-05-21 00:51:02'),
(3, 15, '603069d1aaf5f6b3cb0e4f16e3c55e75038a4c87d12aa4c14d42f2444e48db77', '2025-05-21 02:15:51', '2025-05-21 00:51:02'),
(4, 15, '458a63c51098536b01f79e249116b89e40487ae17868aba7bb938512f0a9fe91', '0000-00-00 00:00:00', '2025-05-21 02:52:18'),
(5, 15, 'cbc4b01a6691e80256f7e7d3a6e16a94e854c5b3c20005e339f0e3a9466b49e6', '0000-00-00 00:00:00', '2025-05-21 02:52:29'),
(6, 15, 'b97a554973f418b8c83884a66e75874088e96038c9bab4d846b392f92995e932', '0000-00-00 00:00:00', '2025-05-21 02:53:10'),
(7, 15, '0df171a3bb14c0414b8043ed6308bf7e9c96fd3a1639cfa6f3215a6f3250ec3a', '0000-00-00 00:00:00', '2025-05-21 02:53:24'),
(8, 15, '7539deb93ad1c95ec056bc9f92565c0e2630b499ee9268d702dd9c29d52f8160', '0000-00-00 00:00:00', '2025-05-21 02:54:31'),
(9, 15, '7c7912249848cc41c7dbc43ea8221cf5de41ba8f3a0a6cc624f3d3f2e1f51503', '0000-00-00 00:00:00', '2025-05-21 02:54:38'),
(10, 15, '74a5a5acf25243b01cbe8c5c8024478f3b5a0f1f10667d4f03512ab20ab807b4', '0000-00-00 00:00:00', '2025-05-21 02:55:04'),
(11, 15, '74fb8738aea6a18bcde8accc37728b3c95ec67a20e504d0378a5dd3b50ca62d1', '0000-00-00 00:00:00', '2025-05-21 03:09:09'),
(12, 15, 'c0561284aab2f5bba3fe00534b9bb1346a4c83849b0a0dcdebc160867d872d4c', '0000-00-00 00:00:00', '2025-05-21 03:13:59'),
(13, 15, 'bb848d321aea58135384413a6ed53ca6b1167b5e79d58de4740829afe9b26c0c', '0000-00-00 00:00:00', '2025-05-21 03:21:46'),
(14, 15, '8696bddda81101e50d37475f1206332f167b7b543d8e0b5e321b1be514f1bc36', '0000-00-00 00:00:00', '2025-05-21 03:30:11'),
(15, 15, 'daa0b9a6cb4e776fad6102975223316ff6cd1ca7f84ab01e48d76b89772e2bf1', '0000-00-00 00:00:00', '2025-05-21 03:30:18'),
(16, 15, '517b0c688b08735e423266c7eb44a1f4b9cc31ca53704dedc87af210c28966b1', '0000-00-00 00:00:00', '2025-05-21 03:30:30'),
(17, 15, 'f5c8e6e73876f7380c92b9485de33d758ed7faae91499c3163348338bb399154', '0000-00-00 00:00:00', '2025-05-21 03:32:23'),
(18, 15, '76221b8253c78f7906213d7021731dfbf35a37e9a96fb6d0fb4f2c3261ab6703', '0000-00-00 00:00:00', '2025-05-21 03:32:29'),
(19, 15, '705156bad8a959d95212199e072352e0df0872381bb0b6d0c5ffdfac08b6d025', '0000-00-00 00:00:00', '2025-05-21 03:32:40'),
(20, 15, 'c85145972f843fd0ad6338a6f30cf103e17380a087aa240b125aee45d1bbb67c', '0000-00-00 00:00:00', '2025-05-21 03:39:53'),
(21, 15, 'a818b87e9bc5f0efea544b428ebf2a0500d80ba61f5a55158ebb093c415566e4', '0000-00-00 00:00:00', '2025-05-21 03:41:59'),
(22, 15, '6da8259f58c64a0acdc6cf6c8d1a214c5d3847240420d84bf3ab4e2acb3d2b28', '0000-00-00 00:00:00', '2025-05-21 03:42:07'),
(23, 15, '273f96a11e83eebe7bd5225e8f5817ee9aa3bf40e883b61f92de5821747320a8', '0000-00-00 00:00:00', '2025-05-21 03:44:27'),
(24, 15, 'c1ecb3ac92146df949cf062af1b983cca4087e4efae0176608f72e32264763fa', '0000-00-00 00:00:00', '2025-05-22 01:56:06'),
(25, 15, '69f9353e2881623bfc3c1d3ad7b589935a32d5c46d015f2cf6b8a3af8f6e2a7a', '0000-00-00 00:00:00', '2025-05-27 18:27:43');

-- --------------------------------------------------------

--
-- Structure de la table `rotations`
--

CREATE TABLE `rotations` (
  `id` int(11) NOT NULL,
  `tontine_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ordre` int(11) NOT NULL,
  `date_reception` date DEFAULT NULL,
  `statut` enum('en attente','reçu') DEFAULT 'en attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tontines`
--

CREATE TABLE `tontines` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('mensuel','annuel') NOT NULL,
  `date_creation` date NOT NULL,
  `createur_id` int(11) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `frequence` enum('quotidien','hebdomadaire','mensuel') NOT NULL,
  `date_debut` date NOT NULL,
  `statut` enum('active','terminee') DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tontines`
--

INSERT INTO `tontines` (`id`, `nom`, `description`, `type`, `date_creation`, `createur_id`, `montant`, `frequence`, `date_debut`, `statut`, `created_by`, `created_at`) VALUES
(6, 'Tontine Alpha', 'Tontine mensuelle pour les employés.', 'mensuel', '0000-00-00', 0, 0.00, 'quotidien', '0000-00-00', 'active', NULL, '2025-05-17 23:58:48'),
(10, 'Tontine Bêta', 'Tontines annuelles pour les employés ', 'annuel', '0000-00-00', 0, 0.00, 'quotidien', '0000-00-00', 'active', NULL, '2025-05-18 00:34:07');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(9) NOT NULL,
  `Adresse` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `reset_token` varchar(64) DEFAULT NULL,
  `token_expire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `telephone`, `Adresse`, `email`, `reset_token`, `token_expire`) VALUES
(11, 'HADY', '$2y$10$ufBeN/R7SYMS2N8nStkBv.fzYj8cLHW6eooftrEBUS2mpoWjw8fdm', '782183467', 'SAINT LOUIS', 'user11@example.com', NULL, NULL),
(12, 'Aminata', '$2y$10$l7X4uWESLbvPAtAXiMBlKODWMBGnejIzV6unOEtXqf4kuON2Kig3W', '771002299', 'DAKAR', 'user12@example.com', NULL, NULL),
(13, 'Fatima', '$2y$10$VzBUdiXvDwwh/eC64vuZg.pRE6NxQyJfjUnazFapbJCSy/yFlyToW', '771346245', 'KOLDA', 'user13@example.com', NULL, NULL),
(14, 'Aida', '$2y$10$.Iv2spOHdVbZ0QKT1xru0O4oWHqydM8/OrlzvvJSYPw8TnTFKaKmW', '779707238', 'KAOLACK', 'user14@example.com', NULL, NULL),
(15, 'DIOP', '$2y$10$TceSPmlyhMrcJBPrAh.SYuDi4C03mnK09JiG8W.76YSWFBOaBN3Qi', '781234599', 'SAINT LOUIS', 'hadydiop817@gmail.com', NULL, NULL),
(16, 'AISSATA', '$2y$10$Z/p.Y1snEZV7nZvuq.O3/OnZWxfNpoJ0BBDEFnBKvgFHGlB.qTxVq', '778108616', 'KOLDA', 'aissataanne@gmail.com', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cotisations`
--
ALTER TABLE `cotisations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tontine_id` (`tontine_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `historiques`
--
ALTER TABLE `historiques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `participations`
--
ALTER TABLE `participations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tontine_id` (`tontine_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `rotations`
--
ALTER TABLE `rotations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tontine_id` (`tontine_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `tontines`
--
ALTER TABLE `tontines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cotisations`
--
ALTER TABLE `cotisations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `historiques`
--
ALTER TABLE `historiques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `participations`
--
ALTER TABLE `participations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `rotations`
--
ALTER TABLE `rotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tontines`
--
ALTER TABLE `tontines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cotisations`
--
ALTER TABLE `cotisations`
  ADD CONSTRAINT `cotisations_ibfk_1` FOREIGN KEY (`tontine_id`) REFERENCES `tontines` (`id`),
  ADD CONSTRAINT `cotisations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `historiques`
--
ALTER TABLE `historiques`
  ADD CONSTRAINT `historiques_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `participations`
--
ALTER TABLE `participations`
  ADD CONSTRAINT `participations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participations_ibfk_2` FOREIGN KEY (`tontine_id`) REFERENCES `tontines` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `rotations`
--
ALTER TABLE `rotations`
  ADD CONSTRAINT `rotations_ibfk_1` FOREIGN KEY (`tontine_id`) REFERENCES `tontines` (`id`),
  ADD CONSTRAINT `rotations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `tontines`
--
ALTER TABLE `tontines`
  ADD CONSTRAINT `tontines_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
