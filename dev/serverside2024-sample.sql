-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 05, 2024 at 02:05 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serverside2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `follower_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `followed_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trashed` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`follower_id`, `user_id`, `followed_id`, `timestamp`, `trashed`) VALUES
(1, 1, 2, '2024-11-05 04:18:06', 'n'),
(2, 1, 3, '2024-11-05 04:18:06', 'n'),
(3, 1, 4, '2024-11-05 04:18:06', 'n'),
(4, 2, 5, '2024-11-05 04:18:06', 'n'),
(5, 2, 6, '2024-11-05 04:18:06', 'n'),
(6, 2, 7, '2024-11-05 04:18:06', 'n'),
(7, 3, 8, '2024-11-05 04:18:06', 'n'),
(8, 3, 9, '2024-11-05 04:18:06', 'n'),
(9, 4, 10, '2024-11-05 04:18:06', 'n'),
(10, 4, 11, '2024-11-05 04:18:06', 'n'),
(11, 5, 12, '2024-11-05 04:18:06', 'n'),
(12, 5, 13, '2024-11-05 04:18:06', 'n'),
(13, 6, 14, '2024-11-05 04:18:06', 'n'),
(14, 6, 15, '2024-11-05 04:18:06', 'n'),
(15, 7, 16, '2024-11-05 04:18:06', 'n'),
(16, 7, 17, '2024-11-05 04:18:06', 'n'),
(17, 8, 18, '2024-11-05 04:18:06', 'n'),
(18, 8, 19, '2024-11-05 04:18:06', 'n'),
(19, 9, 20, '2024-11-05 04:18:06', 'n'),
(20, 9, 21, '2024-11-05 04:18:06', 'n'),
(21, 10, 22, '2024-11-05 04:18:06', 'n'),
(22, 10, 23, '2024-11-05 04:18:06', 'n'),
(23, 11, 24, '2024-11-05 04:18:06', 'n'),
(24, 11, 25, '2024-11-05 04:18:06', 'n'),
(25, 12, 26, '2024-11-05 04:18:06', 'n'),
(26, 12, 27, '2024-11-05 04:18:06', 'n'),
(27, 13, 28, '2024-11-05 04:18:06', 'n'),
(28, 13, 29, '2024-11-05 04:18:06', 'n'),
(29, 14, 30, '2024-11-05 04:18:06', 'n'),
(30, 14, 31, '2024-11-05 04:18:06', 'n'),
(31, 15, 1, '2024-11-05 04:18:06', 'n'),
(32, 16, 3, '2024-11-05 04:18:06', 'n'),
(33, 17, 5, '2024-11-05 04:18:06', 'n'),
(34, 18, 7, '2024-11-05 04:18:06', 'n'),
(35, 19, 9, '2024-11-05 04:18:06', 'n'),
(36, 20, 11, '2024-11-05 04:18:06', 'n'),
(37, 21, 13, '2024-11-05 04:18:06', 'n'),
(38, 22, 15, '2024-11-05 04:18:06', 'n'),
(39, 23, 17, '2024-11-05 04:18:06', 'n'),
(40, 24, 19, '2024-11-05 04:18:06', 'n'),
(41, 25, 21, '2024-11-05 04:18:06', 'n'),
(42, 26, 23, '2024-11-05 04:18:06', 'n'),
(43, 27, 25, '2024-11-05 04:18:06', 'n'),
(44, 28, 27, '2024-11-05 04:18:06', 'n'),
(45, 29, 2, '2024-11-05 04:18:06', 'n'),
(46, 30, 4, '2024-11-05 04:18:06', 'n'),
(47, 31, 6, '2024-11-05 04:18:06', 'n'),
(48, 1, 8, '2024-11-05 04:18:06', 'n'),
(49, 2, 10, '2024-11-05 04:18:06', 'n'),
(50, 3, 12, '2024-11-05 04:18:06', 'n'),
(51, 4, 14, '2024-11-05 04:18:06', 'n'),
(52, 5, 16, '2024-11-05 04:18:06', 'n'),
(53, 6, 18, '2024-11-05 04:18:06', 'n'),
(54, 7, 20, '2024-11-05 04:18:06', 'n'),
(55, 8, 22, '2024-11-05 04:18:06', 'n'),
(56, 9, 24, '2024-11-05 04:18:06', 'n'),
(57, 10, 26, '2024-11-05 04:18:06', 'n'),
(58, 11, 28, '2024-11-05 04:18:06', 'n'),
(59, 12, 30, '2024-11-05 04:18:06', 'n'),
(60, 101, 2, '2024-11-05 04:18:06', 'n'),
(61, 102, 3, '2024-11-05 04:18:06', 'n'),
(62, 101, 5, '2024-11-05 04:18:06', 'n'),
(63, 102, 7, '2024-11-05 04:18:06', 'n'),
(64, 101, 9, '2024-11-05 04:18:06', 'n'),
(65, 102, 11, '2024-11-05 04:18:06', 'n'),
(66, 101, 13, '2024-11-05 04:18:06', 'n'),
(67, 102, 15, '2024-11-05 04:18:06', 'n'),
(68, 101, 17, '2024-11-05 04:18:06', 'n'),
(69, 102, 19, '2024-11-05 04:18:06', 'n'),
(70, 101, 21, '2024-11-05 04:18:06', 'n'),
(71, 102, 23, '2024-11-05 04:18:06', 'n'),
(72, 101, 25, '2024-11-05 04:18:06', 'n'),
(73, 102, 27, '2024-11-05 04:18:06', 'n'),
(74, 101, 29, '2024-11-05 04:18:06', 'n'),
(75, 102, 1, '2024-11-05 04:18:06', 'n'),
(76, 15, 102, '2024-11-05 04:18:06', 'n'),
(77, 25, 101, '2024-11-05 04:18:06', 'n'),
(78, 18, 102, '2024-11-05 04:18:06', 'n'),
(79, 14, 101, '2024-11-05 04:18:06', 'n'),
(80, 22, 102, '2024-11-05 04:18:06', 'n'),
(81, 31, 101, '2024-11-05 04:18:06', 'n'),
(82, 20, 102, '2024-11-05 04:18:06', 'n'),
(83, 30, 101, '2024-11-05 04:18:06', 'n'),
(84, 7, 102, '2024-11-05 04:18:06', 'n'),
(85, 9, 101, '2024-11-05 04:18:06', 'n'),
(86, 16, 102, '2024-11-05 04:18:06', 'n'),
(87, 11, 101, '2024-11-05 04:18:06', 'n'),
(88, 13, 102, '2024-11-05 04:18:06', 'n'),
(89, 6, 101, '2024-11-05 04:18:06', 'n'),
(90, 17, 102, '2024-11-05 04:18:06', 'n'),
(91, 19, 101, '2024-11-05 04:18:06', 'n'),
(92, 27, 102, '2024-11-05 04:18:06', 'n'),
(93, 23, 101, '2024-11-05 04:18:06', 'n'),
(94, 8, 102, '2024-11-05 04:18:06', 'n'),
(95, 4, 101, '2024-11-05 04:18:06', 'n'),
(96, 3, 102, '2024-11-05 04:18:06', 'n'),
(97, 5, 101, '2024-11-05 04:18:06', 'n'),
(98, 28, 102, '2024-11-05 04:18:06', 'n'),
(99, 12, 101, '2024-11-05 04:18:06', 'n'),
(100, 29, 102, '2024-11-05 04:18:06', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_code`
--

CREATE TABLE `password_reset_code` (
  `reset_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prc1` varchar(36) NOT NULL,
  `prc2` varchar(36) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trashed` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `photo_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trashed` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_copy` longtext,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trashed` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_copy`, `timestamp`, `trashed`) VALUES
(1, 1, 'Excited to start this new project! Anyone have tips?', '2024-11-05 12:47:29', 'n'),
(2, 2, 'Just finished a 10k run, feeling great!', '2024-11-05 12:47:29', 'n'),
(3, 3, 'Coffee is my fuel for the day! ☕', '2024-11-05 12:47:29', 'n'),
(4, 4, 'Can’t believe it’s already November. Where did the year go?', '2024-11-05 12:47:29', 'n'),
(5, 5, 'Looking for a good movie recommendation. Any suggestions?', '2024-11-05 12:47:29', 'n'),
(6, 6, 'The weather today is perfect for a walk. 🍂', '2024-11-05 12:47:29', 'n'),
(7, 7, 'Trying out a new recipe tonight. Hope it turns out well!', '2024-11-05 12:47:29', 'n'),
(8, 8, 'Work has been non-stop lately. Need a vacation soon!', '2024-11-05 12:47:29', 'n'),
(9, 9, 'Finally finished my book! Anyone want to discuss?', '2024-11-05 12:47:29', 'n'),
(10, 10, 'Spent the day with family, so grateful for them!', '2024-11-05 12:47:29', 'n'),
(11, 11, 'Anyone else obsessed with this new show?', '2024-11-05 12:47:29', 'n'),
(12, 12, 'I love mornings like these – peaceful and calm.', '2024-11-05 12:47:29', 'n'),
(13, 13, 'The sunset tonight was breathtaking. 🌅', '2024-11-05 12:47:29', 'n'),
(14, 14, 'Getting back into drawing after so long. Feels good!', '2024-11-05 12:47:29', 'n'),
(15, 15, 'Just wrapped up a big project. Feeling accomplished!', '2024-11-05 12:47:29', 'n'),
(16, 16, 'Why is laundry day always so exhausting?', '2024-11-05 12:47:29', 'n'),
(17, 17, 'Trying to be more mindful every day. It’s a journey.', '2024-11-05 12:47:29', 'n'),
(18, 18, 'Met an old friend today, caught up on life.', '2024-11-05 12:47:29', 'n'),
(19, 19, 'Starting a new series tonight. Hope it’s good!', '2024-11-05 12:47:29', 'n'),
(20, 20, 'Loving these cozy autumn vibes 🍁', '2024-11-05 12:47:29', 'n'),
(21, 21, 'Anyone here into photography? I’d love to learn.', '2024-11-05 12:47:29', 'n'),
(22, 22, 'Reading some thought-provoking articles today.', '2024-11-05 12:47:29', 'n'),
(23, 23, 'Just got a new gadget. Tech nerds, rejoice!', '2024-11-05 12:47:29', 'n'),
(24, 24, 'Rainy days are the best for staying in and relaxing.', '2024-11-05 12:47:29', 'n'),
(25, 25, 'Thinking of picking up a new hobby. Ideas?', '2024-11-05 12:47:29', 'n'),
(26, 26, 'Sunday brunch with friends = the best way to recharge.', '2024-11-05 12:47:29', 'n'),
(27, 27, 'Anyone have podcast recommendations?', '2024-11-05 12:47:29', 'n'),
(28, 28, 'Set a new personal record today. Proud of myself!', '2024-11-05 12:47:29', 'n'),
(29, 29, 'Weekend vibes, here we go! 🌞', '2024-11-05 12:47:29', 'n'),
(30, 30, 'Trying to be more organized. Let’s see how long it lasts.', '2024-11-05 12:47:29', 'n'),
(31, 31, 'Anyone into DIY projects? Love to hear your ideas!', '2024-11-05 12:47:29', 'n'),
(32, 101, 'Hello everyone! New to the group and excited to be here.', '2024-11-05 12:47:29', 'n'),
(33, 102, 'Had the most amazing road trip. Ready for more adventures!', '2024-11-05 12:47:29', 'n'),
(34, 1, 'Finally trying to cook something fancy tonight. Wish me luck!', '2024-11-05 12:47:29', 'n'),
(35, 2, 'Could really use a day off – anyone else?', '2024-11-05 12:47:29', 'n'),
(36, 3, 'Just signed up for a marathon! Let’s do this!', '2024-11-05 12:47:29', 'n'),
(37, 4, 'Found a new coffee shop, and it’s amazing!', '2024-11-05 12:47:29', 'n'),
(38, 5, 'Spent the day outdoors, feeling refreshed.', '2024-11-05 12:47:29', 'n'),
(39, 6, 'Is it just me, or does time fly by on weekends?', '2024-11-05 12:47:29', 'n'),
(40, 7, 'Planning a road trip soon. Any tips?', '2024-11-05 12:47:29', 'n'),
(41, 8, 'Started a new book today. Can’t put it down!', '2024-11-05 12:47:29', 'n'),
(42, 9, 'Hiking season is the best season!', '2024-11-05 12:47:29', 'n'),
(43, 10, 'I’m so ready for the holidays!', '2024-11-05 12:47:29', 'n'),
(44, 11, 'Just learned something new, feeling inspired.', '2024-11-05 12:47:29', 'n'),
(45, 12, 'Made a new playlist. Music lovers, hit me up!', '2024-11-05 12:47:29', 'n'),
(46, 13, 'Life is short, eat dessert first!', '2024-11-05 12:47:29', 'n'),
(47, 14, 'Grateful for the little things today.', '2024-11-05 12:47:29', 'n'),
(48, 15, 'Just got home from a long day. Time to relax.', '2024-11-05 12:47:29', 'n'),
(49, 16, 'Started a journal – let’s see how long this lasts.', '2024-11-05 12:47:29', 'n'),
(50, 17, 'Feeling motivated! Got big goals for this week.', '2024-11-05 12:47:29', 'n'),
(51, 18, 'Trying a new workout routine. Wish me luck!', '2024-11-05 12:48:39', 'n'),
(52, 19, 'Late night thoughts: grateful for all the little things.', '2024-11-05 12:48:39', 'n'),
(53, 20, 'Anyone else love rainy days as much as I do?', '2024-11-05 12:48:39', 'n'),
(54, 21, 'Just got a new camera. Time to capture some memories!', '2024-11-05 12:48:39', 'n'),
(55, 22, 'Sunday is perfect for catching up on sleep.', '2024-11-05 12:48:39', 'n'),
(56, 23, 'Exploring some new recipes. Cooking is an adventure!', '2024-11-05 12:48:39', 'n'),
(57, 24, 'Has anyone seen that new movie everyone’s talking about?', '2024-11-05 12:48:39', 'n'),
(58, 25, 'Feeling creative today. Time to start a new project!', '2024-11-05 12:48:39', 'n'),
(59, 26, 'Appreciating the quiet moments.', '2024-11-05 12:48:39', 'n'),
(60, 27, 'Finally got around to organizing my workspace.', '2024-11-05 12:48:39', 'n'),
(61, 28, 'Taking time to reconnect with old friends.', '2024-11-05 12:48:39', 'n'),
(62, 29, 'Life’s too short for bad coffee.', '2024-11-05 12:48:39', 'n'),
(63, 30, 'Found an amazing hiking trail today!', '2024-11-05 12:48:39', 'n'),
(64, 31, 'Trying to stay positive during stressful times.', '2024-11-05 12:48:39', 'n'),
(65, 100, 'Excited to start sharing more of my journey with you all!', '2024-11-05 12:48:39', 'n'),
(66, 100, 'Just adopted a new cat – she’s adorable!', '2024-11-05 12:48:39', 'n'),
(67, 100, 'Taking it one day at a time. Grateful for every moment.', '2024-11-05 12:48:39', 'n'),
(68, 101, 'Anyone up for a weekend road trip?', '2024-11-05 12:48:39', 'n'),
(69, 102, 'The sunrise was incredible this morning.', '2024-11-05 12:48:39', 'n'),
(70, 1, 'Working on some personal goals this week.', '2024-11-05 12:48:39', 'n'),
(71, 2, 'Can’t get enough of this new playlist!', '2024-11-05 12:48:39', 'n'),
(72, 3, 'Life update: Just got promoted!', '2024-11-05 12:48:39', 'n'),
(73, 4, 'Celebrating small wins today.', '2024-11-05 12:48:39', 'n'),
(74, 5, 'Does anyone know a good book on productivity?', '2024-11-05 12:48:39', 'n'),
(75, 6, 'Thinking about picking up a new skill.', '2024-11-05 12:48:39', 'n'),
(76, 7, 'Lazy Sunday vibes – anyone else?', '2024-11-05 12:48:39', 'n'),
(77, 8, 'Nature walks are the best therapy.', '2024-11-05 12:48:39', 'n'),
(78, 9, 'Sometimes, it’s the simple things that matter.', '2024-11-05 12:48:39', 'n'),
(79, 10, 'Aiming to be more consistent with my workouts.', '2024-11-05 12:48:39', 'n'),
(80, 11, 'Grateful for friends who lift me up.', '2024-11-05 12:48:39', 'n'),
(81, 12, 'Just binge-watched an entire season – oops!', '2024-11-05 12:48:39', 'n'),
(82, 13, 'Trying out meditation. Any tips?', '2024-11-05 12:48:39', 'n'),
(83, 14, 'Planning a surprise for someone special.', '2024-11-05 12:48:39', 'n'),
(84, 15, 'Today’s reminder: you are enough.', '2024-11-05 12:48:39', 'n'),
(85, 16, 'Catching up on reading. What’s on your shelf?', '2024-11-05 12:48:39', 'n'),
(86, 17, 'Staying positive, no matter what.', '2024-11-05 12:48:39', 'n'),
(87, 18, 'Bought myself a little treat today.', '2024-11-05 12:48:39', 'n'),
(88, 19, 'Anyone else love exploring new cafes?', '2024-11-05 12:48:39', 'n'),
(89, 20, 'Dreaming about my next adventure.', '2024-11-05 12:48:39', 'n'),
(90, 21, 'Monday motivation: you’ve got this!', '2024-11-05 12:48:39', 'n'),
(91, 22, 'Is it too early to start holiday shopping?', '2024-11-05 12:48:39', 'n'),
(92, 23, 'Found a new hobby and loving it.', '2024-11-05 12:48:39', 'n'),
(93, 24, 'Anyone want to swap book recommendations?', '2024-11-05 12:48:39', 'n'),
(94, 25, 'Trying to embrace the present moment.', '2024-11-05 12:48:39', 'n'),
(95, 26, 'Just learned something new. Feeling accomplished.', '2024-11-05 12:48:39', 'n'),
(96, 27, 'Anyone else feel like time’s flying by?', '2024-11-05 12:48:39', 'n'),
(97, 28, 'Cooking up something special tonight!', '2024-11-05 12:48:39', 'n'),
(98, 29, 'Just bought some art supplies. Time to get creative!', '2024-11-05 12:48:39', 'n'),
(99, 30, 'Enjoying the peace and quiet of this weekend.', '2024-11-05 12:48:39', 'n'),
(100, 31, 'Taking a step back to appreciate life.', '2024-11-05 12:48:39', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email_addr` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `avatar_id` int(11) DEFAULT NULL,
  `cover_id` int(11) DEFAULT NULL,
  `timezone` varchar(64) NOT NULL DEFAULT 'America/Winnipeg',
  `is_mod` enum('y','n') NOT NULL DEFAULT 'n',
  `is_admin` enum('y','n') NOT NULL DEFAULT 'n',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trashed` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email_addr`, `password`, `first_name`, `last_name`, `username`, `avatar_id`, `cover_id`, `timezone`, `is_mod`, `is_admin`, `timestamp`, `last_login`, `trashed`) VALUES
(1, 'amccrea@rrc.ca', '$2y$10$ikt80TOqqdPiTLjIEg617eRq7vCDC.M7NeHxp5tUAS3878tEi3M1e', 'Andrew', 'McCrea', 'andymac', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2023-12-09 23:07:51', '2024-10-25 01:58:22', 'n'),
(2, 'liam.smith@example.com', '$2y$10$Plg6geim1TqM3TNkN2ShEuLRuNK9XbM8.A68HXk39xH7ozC/B6tQi', 'Liam', 'Smith', 'liams', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(3, 'olivia.brown@example.com', '$2y$10$iZIvssWtnofCufue6/5bseaznTk0oLBLGLQG1lSsYX9gkxojLDOCi', 'Olivia', 'Brown', 'oliviab', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(4, 'noah.johnson@example.com', '$2y$10$7zaQBY7hrcxPFp6X14g9T.W3UG7YT/lXtScP.l5Iu3/GMYIV5J52m', 'Noah', 'Johnson', 'noahj', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(5, 'ava.wilson@example.com', '$2y$10$Up0uGENlOnvpBytYf6YjiO8VoIEZDSYGCbj4NLTxc/VXMkQkm04Ty', 'Ava', 'Wilson', 'avaw', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(6, 'william.lee@example.com', '$2y$10$as9bNBsorLEq32eO/HzznOtT4LFgb1KAkHdQ8JbZnDgRS18.O2urS', 'William', 'Lee', 'williaml', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(7, 'sophia.taylor@example.com', '$2y$10$SjNDBdRSWoHlABCFQVAM1.n5MN7J2dJUt201HOTmyfd0f.cfC5Lx6', 'Sophia', 'Taylor', 'sophiat', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(8, 'james.anderson@example.com', '$2y$10$I91J.NWPVFXEsozTGJu5e.15hkzNC0u4MhFFoTi1zLhY1KZAo9cPe', 'James', 'Anderson', 'jamesa', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(9, 'mia.thomas@example.com', '$2y$10$U326F4SjgmA..7grNLkoSugejHHL7ltOfI016qJDCpaS3hCoGSU1W', 'Mia', 'Thomas', 'miat', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(10, 'benjamin.moore@example.com', '$2y$10$agwu2B5llUjNa6C6SULDWOWhh8KBzQ/kgvQHF38tqOPLsBdp2stDi', 'Benjamin', 'Moore', 'benjaminm', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(11, 'amelia.jackson@example.com', '$2y$10$JEqMLGxmY55VeWvInms13uCv.HkNAOgErbZ8uorv3htE44i1ikpZW', 'Amelia', 'Jackson', 'ameliaj', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(12, 'lucas.white@example.com', '$2y$10$RVBxipeIe59qK4mV0Gm0hOVhsFKOnDIOroEwLgfhl6WIWBN9j.p1u', 'Lucas', 'White', 'lucasw', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(13, 'charlotte.harris@example.com', '$2y$10$.7sbH9HIszDEiPhr2ifXqeR1cO4126DnHor76j5SHiaHDdDzpsMRi', 'Charlotte', 'Harris', 'charlotteh', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(14, 'henry.martin@example.com', '$2y$10$PztKkG19PfNFddnIXr9Tj.Jw7ZbFVh3HFL2gIKbxdrUFVRSB34pWe', 'Henry', 'Martin', 'henrym', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(15, 'evelyn.young@example.com', '$2y$10$1d9kvx6rON/kkTHfQP82t.Q/BXaz0wBJQ8VYXJYMfQrQfAtcBhFCi', 'Evelyn', 'Young', 'evelyny', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(16, 'jack.campbell@example.com', '$2y$10$kka9zEbJRuktztQBnq/s2ucz5d0IPFMi7tRpHFJxOevKArOB.i6nO', 'Jack', 'Campbell', 'jackc', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(17, 'harper.mitchell@example.com', '$2y$10$PNvCtoRf5AP.YhvGkdgchudiTn0pFw8vEY8RMREQNzWK2fkidqSd2', 'Harper', 'Mitchell', 'harperm', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(18, 'alexander.carter@example.com', '$2y$10$vwYQ1Oqc5mRCB0pTJB60fOoXfM3MLwRyThT3FOGc9DDVj3HZVhH9u', 'Alexander', 'Carter', 'alexanderc', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(19, 'ella.roberts@example.com', '$2y$10$3sKD7ANfa1ftVQXP4jvcMOnnj7vImYiMafn2loX4Rf1Rb.IvOjQtu', 'Ella', 'Roberts', 'ellar', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(20, 'sebastian.davis@example.com', '$2y$10$YN61HCzANFuby2ZwHzKiDObO9nXYJMLJ81aajW0WVIuVaR.N/jd9.', 'Sebastian', 'Davis', 'sebastiand', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(21, 'avery.hill@example.com', '$2y$10$QxeE5kHFG1YfopWc.7yX/OQdDPObi1KvCCEg4jVkURiYWXei6SnDO', 'Avery', 'Hill', 'averyh', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(22, 'daniel.scott@example.com', '$2y$10$vTZ27jshVk8xTntHmNvEe./cgW4dadwRia/MVgea6ZnN/alxGGTfe', 'Daniel', 'Scott', 'daniels', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(23, 'isabella.green@example.com', '$2y$10$DHRY4yPDk4sjEa5PiCGfDeLb2Gd7U6C.xgxYBlBlQ6oTA7ZbzqBdK', 'Isabella', 'Green', 'isabellag', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(24, 'matthew.king@example.com', '$2y$10$L9GZFD/UMVY0Z7tfXxPGR.ihnB6QtfR.UFrR3jILU84WbzKg/z7a6', 'Matthew', 'King', 'matthewk', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(25, 'scarlett.wood@example.com', '$2y$10$veFSmEF4XVduixxEGVFl2.jwpw.QvyUN8aYqob9ytJGV5xm8nfjWG', 'Scarlett', 'Wood', 'scarlettw', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(26, 'logan.hall@example.com', '$2y$10$XGbA6lLjevpYkVt/5g3.1.oK8hwdwu8iSnE5vNJ4qJu3WVTlOXpdW', 'Logan', 'Hall', 'loganh', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(27, 'sofia.thompson@example.com', '$2y$10$iIYGJNnmJKc14M5DJitJLuqdtOvqGvzL8tqiVNQoPtcyYZBhKKuyO', 'Sofia', 'Thompson', 'sofiat', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(28, 'david.adams@example.com', '$2y$10$oqoBCOgRlTvtQmaI4AxkjOyet2oNbGVEYEWA2ORHhRYDuBqdntB8.', 'David', 'Adams', 'davida', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(29, 'ella.wright@example.com', '$2y$10$rJDWU1p7zfnv6Hu7rbX55ezkn5IiydJFTyU5JAFighM307tzDmlqm', 'Ella', 'Wright', 'ellaw', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(30, 'joseph.clark@example.com', '$2y$10$6tKg/rV6jc5yc3EJYujlCuSbraO5TF6o87yRWe/NcUnSDygA0//HK', 'Joseph', 'Clark', 'josephc', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(31, 'emily.jones@example.com', '$2y$10$15TqBP1GNEKDvXhTjGIY1.cWq7tNscij.e16nfMvsLqJPbPN8Wygu', 'Emily', 'Jones', 'emilyj', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(100, 'layla.rodriguez@example.com', '$2y$10$ttu6wWGHDRj0kvNa9H/3aOO7K0cYqHtgSrOpH0O/oRYjnCSkKDL22', 'Layla', 'Rodriguez', 'laylar', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:14:06', '2024-11-05 04:14:06', 'n'),
(101, 'leo.fisher@example.com', '$2y$10$ZnyAv4k91ejh4OEBunBw3eTHRJPlCx30qvCFfCk6.Cc/hWRSzlng6', 'Leo', 'Fisher', 'leof', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:19:23', '2024-11-05 04:19:23', 'n'),
(102, 'mia.stone@example.com', '$2y$10$qaG/S4wlBuAEbkO2.yEvXum4u/DXiU8vM7MhNs4FPERRiwQ9A0ktC', 'Mia', 'Stone', 'mias', NULL, NULL, 'America/Winnipeg', 'n', 'n', '2024-11-05 04:19:23', '2024-11-05 04:19:23', 'n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`follower_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `followed_id` (`followed_id`),
  ADD KEY `trashed` (`trashed`);

--
-- Indexes for table `password_reset_code`
--
ALTER TABLE `password_reset_code`
  ADD PRIMARY KEY (`reset_id`),
  ADD KEY `trashed` (`trashed`),
  ADD KEY `timestamp` (`timestamp`),
  ADD KEY `prc1` (`prc1`),
  ADD KEY `prc2` (`prc2`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `trashed` (`trashed`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `trashed` (`trashed`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `username` (`username`),
  ADD KEY `email_addr` (`email_addr`),
  ADD KEY `password` (`password`),
  ADD KEY `trashed` (`trashed`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `follower_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `password_reset_code`
--
ALTER TABLE `password_reset_code`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
