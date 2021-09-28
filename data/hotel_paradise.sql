-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2020 at 09:28 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_paradise`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(255) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_room` int(10) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `num_people` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `id_user`, `id_room`, `check_in`, `check_out`, `num_people`, `status`) VALUES
(1, 5, 1, '2020-03-25', '2020-03-28', 2, 1),
(2, 10, 13, '2020-03-25', '2020-03-26', 2, 1),
(3, 10, 1, '2020-04-07', '2020-04-10', 2, 1),
(4, 1, 1, '2020-04-09', '2020-04-10', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(255) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `link`, `name`, `position`) VALUES
(1, 'index.php', 'Home', 1),
(2, 'rooms.php', 'Rooms', 2),
(6, 'restaurant.php', 'Restaurant', 6),
(7, 'about.php', 'About', 7),
(8, 'contact.php', 'Contact', 8),
(9, 'register.php', 'Register', 9),
(10, 'login.php', 'Login', 10),
(11, 'logout.php', 'Logout', 12),
(12, 'admin/admin.php', 'Admin Panel', 11);

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

CREATE TABLE `menu_role` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`id`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 11),
(10, 2, 1),
(11, 2, 2),
(15, 2, 6),
(16, 2, 7),
(17, 2, 8),
(18, 2, 11),
(19, 3, 1),
(20, 3, 2),
(24, 3, 6),
(25, 3, 7),
(26, 3, 8),
(27, 3, 9),
(28, 3, 10),
(29, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(11) NOT NULL,
  `price` decimal(50,0) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_room` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `price`, `date`, `id_room`) VALUES
(1, '80', '2020-03-25 10:55:37', 1),
(2, '100', '2020-03-25 10:57:08', 2),
(3, '150', '2020-03-25 10:57:52', 3),
(4, '200', '2020-03-25 10:57:59', 4),
(5, '75', '2020-03-25 11:00:34', 5),
(6, '50', '2020-03-25 11:00:34', 6),
(7, '65', '2020-03-25 11:00:34', 7),
(8, '95', '2020-03-25 11:00:34', 8),
(9, '85', '2020-03-25 11:00:34', 9),
(10, '800', '2020-03-26 16:07:49', 10),
(11, '500', '2020-03-26 16:07:56', 11),
(12, '65', '2020-03-25 11:00:34', 12),
(13, '100', '2020-03-25 11:00:34', 13),
(14, '210', '2020-03-25 11:00:34', 14),
(15, '170', '2020-03-25 11:00:34', 15);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Authorized user'),
(3, 'Unauthorized user');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(255) NOT NULL,
  `number` int(255) NOT NULL,
  `size` int(10) NOT NULL,
  `num_people` int(10) NOT NULL,
  `num_beds` int(10) NOT NULL,
  `coverImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `id_view` int(255) NOT NULL,
  `id_room_type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `number`, `size`, `num_people`, `num_beds`, `coverImage`, `description`, `id_view`, `id_room_type`) VALUES
(1, 100, 45, 2, 1, 'room-1', 'An elegant atmosphere envelops the guest in our standard room; the original 30s-style furniture contributes to creating a charming and unique style, where the accuracy of the details blends with the futuristic design.  A unique experience in a sophisticated environment: a comfortable briarwood bed, soft carpets with geometric patterns, an elegant curtain that allows natural light to filter through, a bathroom equipped with every comfort, will welcome you to give you an unforgettable stay. Although it is defined as \"standard\", you can indeed find refined and Novecento style finishes and furnishings, unique in Venice, with all the comforts that a guest could wish for. Rooms area varies between 12 and 16 square metres and it is equipped with a double or twin bed.  The private bathroom with marble finishes is complete with hairdryer, heated towel rack, bathrobe, slippers and courtesy kit. In all the rooms you will also find a free Wi-Fi connection, TV, air conditioning, mini-bar and safe.  Furthermore, for our guests we have reserved an exclusive 15% discount at La Rivista Restaurant, an unmissable opportunity to try out typical Venetian cuisine revamped in a modern way.', 1, 1),
(2, 101, 60, 5, 3, 'room-2', 'This is the ideal solution for those travelling together as a family. Our Family Room is furnished to accommodate, with style and design, families composed of 2 adults and 1 or more children. The double or twin beds are comfortable and the room, which has an area up to 25 square metres, can comfortably accommodate a third bed. But let\'s not forget our younger guests: on request we can provide a comfortable cot.\r\n\r\nThe Family Rooms are always decorated with the characteristic Art Deco style, using original pieces or faithful reproductions, to give the whole family an unforgettable experience in the first design hotel in Venice, a stone\'s throw from the Accademia and Zattere bridges. Each one different from the other, with a high attention to detail starting from the entrance doors and window handles, in typical Ca\' Pisani Design Boutique Hotel style.\r\n\r\nThe family rooms are equipped with private bathroom with bathtub and/or shower, hairdryer, heated towel rail and quality courtesy kit. We also offer free WIFI connection, air conditioning, TV with satellite channels, safe.\r\n\r\nFor trying out the typical dishes of Venetian cuisine, the guests of the Family Room have a 15% discount at our La Rivista Restaurant', 1, 2),
(3, 102, 100, 3, 2, 'room-3', 'An elegant atmosphere envelops the guest in our standard room; the original 30s-style furniture contributes to creating a charming and unique style, where the accuracy of the details blends with the futuristic design.  A unique experience in a sophisticated environment: a comfortable briarwood bed, soft carpets with geometric patterns, an elegant curtain that allows natural light to filter through, a bathroom equipped with every comfort, will welcome you to give you an unforgettable stay. Although it is defined as \"standard\", you can indeed find refined and Novecento style finishes and furnishings, unique in Venice, with all the comforts that a guest could wish for. Rooms area varies between 12 and 16 square metres and it is equipped with a double or twin bed.  The private bathroom with marble finishes is complete with hairdryer, heated towel rack, bathrobe, slippers and courtesy kit. In all the rooms you will also find a free Wi-Fi connection, TV, air conditioning, mini-bar and safe.  Furthermore, for our guests we have reserved an exclusive 15% discount at La Rivista Restaurant, an unmissable opportunity to try out typical Venetian cuisine revamped in a modern way.', 1, 3),
(4, 103, 120, 4, 3, 'room-4', 'Sophisticated materials and attention to detail are the features that most guests of our  rooms are looking for. They have been created to be different from each other while being united by a refined and modern design, to give you a unique and unforgettable experience. The finish of the bamboo parquet floor gives the room warmth and intimacy and helps create a welcoming atmosphere, while the original Déco style furniture gives the room an elegant and refined style. Here too, every detail, even the door and window handles, have been carefully selected. The Déco Superior Room is larger than the standard one, with an area ranging from 19 to 20 metres.  In all rooms you will find the comforts you need to spend a relaxing and stimulating stay: double bed, air conditioning, safe, mini-bar, Wi-Fi connection, private bathroom with hairdryer, bathrobe, slippers and courtesy kit.', 2, 3),
(5, 104, 75, 4, 2, 'room-5', 'This is the ideal solution for those travelling together as a family. Our Family Room is furnished to accommodate, with style and design, families composed of 2 adults and 1 or more children. The double or twin beds are comfortable and the room, which has an area up to 25 square metres, can comfortably accommodate a third bed. But let\'s not forget our younger guests: on request we can provide a comfortable cot.\r\n\r\nThe Family Rooms are always decorated with the characteristic Art Deco style, using original pieces or faithful reproductions, to give the whole family an unforgettable experience in the first design hotel in Venice, a stone\'s throw from the Accademia and Zattere bridges. Each one different from the other, with a high attention to detail starting from the entrance doors and window handles, in typical Ca\' Pisani Design Boutique Hotel style.\r\n\r\nThe family rooms are equipped with private bathroom with bathtub and/or shower, hairdryer, heated towel rail and quality courtesy kit. We also offer free WIFI connection, air conditioning, TV with satellite channels, safe.\r\n\r\nFor trying out the typical dishes of Venetian cuisine, the guests of the Family Room have a 15% discount at our La Rivista Restaurant', 2, 2),
(6, 105, 30, 1, 1, 'room-6', 'Sophisticated materials and attention to detail are the features that most guests of our  rooms are looking for. They have been created to be different from each other while being united by a refined and modern design, to give you a unique and unforgettable experience. The finish of the bamboo parquet floor gives the room warmth and intimacy and helps create a welcoming atmosphere, while the original Déco style furniture gives the room an elegant and refined style. Here too, every detail, even the door and window handles, have been carefully selected. The Déco Superior Room is larger than the standard one, with an area ranging from 19 to 20 metres.  In all rooms you will find the comforts you need to spend a relaxing and stimulating stay: double bed, air conditioning, safe, mini-bar, Wi-Fi connection, private bathroom with hairdryer, bathrobe, slippers and courtesy kit.', 2, 1),
(7, 106, 40, 2, 2, 'room-7', 'An elegant atmosphere envelops the guest in our standard room; the original 30s-style furniture contributes to creating a charming and unique style, where the accuracy of the details blends with the futuristic design.  A unique experience in a sophisticated environment: a comfortable briarwood bed, soft carpets with geometric patterns, an elegant curtain that allows natural light to filter through, a bathroom equipped with every comfort, will welcome you to give you an unforgettable stay. Although it is defined as \"standard\", you can indeed find refined and Novecento style finishes and furnishings, unique in Venice, with all the comforts that a guest could wish for. Rooms area varies between 12 and 16 square metres and it is equipped with a double or twin bed.  The private bathroom with marble finishes is complete with hairdryer, heated towel rack, bathrobe, slippers and courtesy kit. In all the rooms you will also find a free Wi-Fi connection, TV, air conditioning, mini-bar and safe.  Furthermore, for our guests we have reserved an exclusive 15% discount at La Rivista Restaurant, an unmissable opportunity to try out typical Venetian cuisine revamped in a modern way.', 3, 1),
(8, 107, 80, 4, 3, 'room-8', 'This is the ideal solution for those travelling together as a family. Our Family Room is furnished to accommodate, with style and design, families composed of 2 adults and 1 or more children. The double or twin beds are comfortable and the room, which has an area up to 25 square metres, can comfortably accommodate a third bed. But let\'s not forget our younger guests: on request we can provide a comfortable cot.  The Family Rooms are always decorated with the characteristic Art Deco style, using original pieces or faithful reproductions, to give the whole family an unforgettable experience in the first design hotel in Venice, a stone\'s throw from the Accademia and Zattere bridges. Each one different from the other, with a high attention to detail starting from the entrance doors and window handles, in typical Ca\' Pisani Design Boutique Hotel style.  The family rooms are equipped with private bathroom with bathtub and/or shower, hairdryer, heated towel rail and quality courtesy kit. We also offer free WIFI connection, air conditioning, TV with satellite channels, safe.  For trying out the typical dishes of Venetian cuisine, the guests of the Family Room have a 15% discount at our La Rivista Restaurant', 3, 2),
(9, 108, 70, 2, 1, 'room-9', 'A charming and refined design environment: you will be impressed by this upon entering our Duplex Room, the main feature of which is the division into two levels, a furnishing solution that contributes to creating a unique living experience.  An elegant living area welcomes guests on the first level with refined pieces, original art deco or faithful reproductions and with the usual attention to detail. The private bathroom is finished with star light marble and equipped with a hairdryer, heated towel rack, bathtub and/or shower and a quality courtesy kit.  A scenic staircase in glass and/or wood leads to the second level: a mezzanine dedicated to the sleeping area with comfortable double or twin beds.  Guests visiting our Duplex rooms can also enjoy some exclusive privileges, such as the possibility of consuming free soft drinks from the mini-bar and a 15% discount for a lunch or dinner at our La Rivista Restaurant.', 3, 3),
(10, 109, 200, 5, 7, 'room-10', 'A charming and refined design environment: you will be impressed by this upon entering our Duplex Room, the main feature of which is the division into two levels, a furnishing solution that contributes to creating a unique living experience.  An elegant living area welcomes guests on the first level with refined pieces, original art deco or faithful reproductions and with the usual attention to detail. The private bathroom is finished with star light marble and equipped with a hairdryer, heated towel rack, bathtub and/or shower and a quality courtesy kit.  A scenic staircase in glass and/or wood leads to the second level: a mezzanine dedicated to the sleeping area with comfortable double or twin beds.  Guests visiting our Duplex rooms can also enjoy some exclusive privileges, such as the possibility of consuming free soft drinks from the mini-bar and a 15% discount for a lunch or dinner at our La Rivista Restaurant.', 1, 3),
(11, 110, 150, 3, 2, 'room-11', 'A charming and refined design environment: you will be impressed by this upon entering our Duplex Room, the main feature of which is the division into two levels, a furnishing solution that contributes to creating a unique living experience.  An elegant living area welcomes guests on the first level with refined pieces, original art deco or faithful reproductions and with the usual attention to detail. The private bathroom is finished with star light marble and equipped with a hairdryer, heated towel rack, bathtub and/or shower and a quality courtesy kit.  A scenic staircase in glass and/or wood leads to the second level: a mezzanine dedicated to the sleeping area with comfortable double or twin beds.  Guests visiting our Duplex rooms can also enjoy some exclusive privileges, such as the possibility of consuming free soft drinks from the mini-bar and a 15% discount for a lunch or dinner at our La Rivista Restaurant.', 3, 3),
(12, 111, 40, 2, 1, 'room-12', 'Take a break and pamper yourself in our suite: elegant design solutions for an exclusive and comfortable stay.  In our suites the living area is separated from the sleeping area: a small lounge will welcome you for moments of relaxation with art deco furnishings and completely unique pieces of funiture.  Each one different from the next, the suites share the original parquet from the 40s and 50s, worked and laid with refined geometric patterns. They are airy rooms, with a generous area ranging from 24 to 28 square metres, equipped with a large private bathroom in star light marble, furnished with heated towel rails, hairdryer and quality courtesy kit.  In all the suites you will find free WIFI connection, air conditioning, TV with satellite channels, safe and mini-bar where our guests can consume non-alcoholic soft drinks for free.  To delight even the most demanding palates, we also offer Junior Suite guests an exclusive 15% discount at our La Rivista Restaurant.', 1, 1),
(13, 112, 60, 3, 3, 'room-13', 'Take a break and pamper yourself in our suite: elegant design solutions for an exclusive and comfortable stay.  In our suites the living area is separated from the sleeping area: a small lounge will welcome you for moments of relaxation with art deco furnishings and completely unique pieces of funiture.  Each one different from the next, the suites share the original parquet from the 40s and 50s, worked and laid with refined geometric patterns. They are airy rooms, with a generous area ranging from 24 to 28 square metres, equipped with a large private bathroom in star light marble, furnished with heated towel rails, hairdryer and quality courtesy kit.  In all the suites you will find free WIFI connection, air conditioning, TV with satellite channels, safe and mini-bar where our guests can consume non-alcoholic soft drinks for free.  To delight even the most demanding palates, we also offer Junior Suite guests an exclusive 15% discount at our La Rivista Restaurant.', 2, 1),
(14, 113, 120, 5, 6, 'room-14', 'This is the ideal solution for those travelling together as a family. Our Family Room is furnished to accommodate, with style and design, families composed of 2 adults and 1 or more children. The double or twin beds are comfortable and the room, which has an area up to 25 square metres, can comfortably accommodate a third bed. But let\'s not forget our younger guests: on request we can provide a comfortable cot.  The Family Rooms are always decorated with the characteristic Art Deco style, using original pieces or faithful reproductions, to give the whole family an unforgettable experience in the first design hotel in Venice, a stone\'s throw from the Accademia and Zattere bridges. Each one different from the other, with a high attention to detail starting from the entrance doors and window handles, in typical Ca\' Pisani Design Boutique Hotel style.  The family rooms are equipped with private bathroom with bathtub and/or shower, hairdryer, heated towel rail and quality courtesy kit. We also offer free WIFI connection, air conditioning, TV with satellite channels, safe.  For trying out the typical dishes of Venetian cuisine, the guests of the Family Room have a 15% discount at our La Rivista Restaurant', 3, 2),
(15, 114, 90, 4, 2, 'room-15', 'This is the ideal solution for those travelling together as a family. Our Family Room is furnished to accommodate, with style and design, families composed of 2 adults and 1 or more children. The double or twin beds are comfortable and the room, which has an area up to 25 square metres, can comfortably accommodate a third bed. But let\'s not forget our younger guests: on request we can provide a comfortable cot.  The Family Rooms are always decorated with the characteristic Art Deco style, using original pieces or faithful reproductions, to give the whole family an unforgettable experience in the first design hotel in Venice, a stone\'s throw from the Accademia and Zattere bridges. Each one different from the other, with a high attention to detail starting from the entrance doors and window handles, in typical Ca\' Pisani Design Boutique Hotel style.  The family rooms are equipped with private bathroom with bathtub and/or shower, hairdryer, heated towel rail and quality courtesy kit. We also offer free WIFI connection, air conditioning, TV with satellite channels, safe.  For trying out the typical dishes of Venetian cuisine, the guests of the Family Room have a 15% discount at our La Rivista Restaurant', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `id` int(255) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_room` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`id`, `link`, `id_room`) VALUES
(1, 'room-1-1', 1),
(2, 'insta-4', 1),
(3, 'room-2-1', 2),
(4, 'room-3-1', 3),
(5, 'room-4-1', 4),
(6, 'room-5-1', 5),
(7, 'room-6-1', 6),
(8, 'room-7-1', 7),
(9, 'room-8-1', 8),
(10, 'room-9-1', 9),
(11, 'room-10-1', 10),
(12, 'room-11-1', 11),
(13, 'room-12-1', 12),
(14, 'room-13-1', 13),
(15, 'room-14-1', 14),
(16, 'room-15-1', 15);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `name`) VALUES
(1, 'Classic'),
(2, 'Family'),
(3, 'Luxury');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_role` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `id_role`) VALUES
(1, 'Milica', 'Zivanic', 'milicazivanic97@gmail.com', '932e512d0da2821efe2b81539f0b82c5', '2020-03-23 18:52:09', 1),
(5, 'Jovana', 'Jovanovic', 'jovana@gmail.com', '067a9d48f2884037e1320ac03b18e86f', '2020-03-23 18:57:40', 2),
(10, 'Pera', 'Peric', 'pera@gmail.com', '33d2fdf4beeb539408b3ae5208f35949', '2020-03-23 22:24:53', 2);

-- --------------------------------------------------------

--
-- Table structure for table `view`
--

CREATE TABLE `view` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `view`
--

INSERT INTO `view` (`id`, `name`) VALUES
(1, 'Sea'),
(2, 'City'),
(3, 'Park');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_room` (`id_room`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`id`,`id_role`,`id_menu`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_room` (`id_room`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `id_room_type` (`id_room_type`),
  ADD KEY `id_view` (`id_view`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_room` (`id_room`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `view`
--
ALTER TABLE `view`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `menu_role`
--
ALTER TABLE `menu_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `view`
--
ALTER TABLE `view`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `room` (`id`);

--
-- Constraints for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD CONSTRAINT `menu_role_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_role_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);

--
-- Constraints for table `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `price_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `room` (`id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room` FOREIGN KEY (`id_view`) REFERENCES `view` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`id_room_type`) REFERENCES `room_type` (`id`);

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `room` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
