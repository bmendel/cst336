-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2018 at 03:59 PM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dungeon_keeper`
--

-- --------------------------------------------------------

--
-- Table structure for table `dk_admin`
--

CREATE TABLE `dk_admin` (
  `userId` int(4) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dk_admin`
--

INSERT INTO `dk_admin` (`userId`, `username`, `password`) VALUES
(1, 'admin', 'E5E9FA1BA31ECD1AE84F75CAAA474F3A663F05F4');

-- --------------------------------------------------------

--
-- Table structure for table `dk_categories`
--

CREATE TABLE `dk_categories` (
  `categoryId` int(4) NOT NULL,
  `categoryName` varchar(16) NOT NULL,
  `categoryDesc` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dk_categories`
--

INSERT INTO `dk_categories` (`categoryId`, `categoryName`, `categoryDesc`) VALUES
(1, 'Undead', 'Reanimated remains of the recently deceased'),
(2, 'Animal', 'Unnatural and dangerous wild creatures'),
(3, 'Spirit', 'Tormented soul unable to move on to the afterlife'),
(4, 'Construct', 'Magical artificial creation with special traits'),
(5, 'Sorcerer', 'A master of the magical arts'),
(6, 'Cursed', 'A corrupted human with unnatural abilities'),
(7, 'Giant', 'Massive creature with brute strength'),
(8, 'Warrior', 'Manthings thirsting for battle');

-- --------------------------------------------------------

--
-- Table structure for table `dk_products`
--

CREATE TABLE `dk_products` (
  `productId` int(4) NOT NULL,
  `productName` varchar(20) NOT NULL,
  `productCategory` int(3) NOT NULL,
  `productImage` varchar(300) NOT NULL,
  `productDescription` varchar(300) NOT NULL,
  `productValue` int(8) NOT NULL,
  `productStock` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dk_products`
--

INSERT INTO `dk_products` (`productId`, `productName`, `productCategory`, `productImage`, `productDescription`, `productValue`, `productStock`) VALUES
(1, 'Skeleton', 1, 'https://i.pinimg.com/originals/30/ea/91/30ea911360af942bb6b82585dfab8949.jpg', 'Basic undead skeleton soldier. Raised from the grave and conditioned to obey any orders.', 25, 300),
(2, 'Slime', 4, 'https://www.aidedd.org/dnd/images/ochreJelly.jpg', 'A formless mass that devours everything it comes into contact with. Rather slow, but very hard to slay.', 100, 200),
(3, 'Spider', 2, 'https://media-waterdeep.cursecdn.com/avatars/thumbnails/0/323/1000/1000/636252775648743317.jpeg', 'Large cave spider enhanced by dark magic.', 75, 550),
(4, 'Wraith', 3, 'https://www.aidedd.org/dnd/images/wraith.jpg', 'Tormented corporeal spirit forced to stay behind after death. Able to be controlled with necromancy.', 125, 175),
(5, 'Goblin', 8, 'https://media-waterdeep.cursecdn.com/avatars/thumbnails/0/351/1000/1000/636252777818652432.jpeg', 'Small, humanoid cave creature with basic intelligence and decent strength.', 275, 145),
(6, 'Troll', 7, 'https://media-waterdeep.cursecdn.com/avatars/thumbnails/0/95/1000/1000/636252739682234623.jpeg', 'Large lumbering swamp creature infused with nature magic.', 450, 80),
(7, 'Giant Rat', 2, 'https://bravenewdungeon.files.wordpress.com/2013/11/dire_rat.jpg', 'Common rodent grown to an enormous size with dark magic. ', 50, 1450),
(8, 'Poltergeist', 3, 'https://i.pinimg.com/originals/b8/cb/0c/b8cb0c37cee9faf1bd51218b1243811a.jpg', 'Fierce spiritual force that can manipulate objects.', 150, 100),
(9, 'Mimic', 4, 'https://media-waterdeep.cursecdn.com/avatars/thumbnails/0/211/1000/1000/636252764731637373.jpeg', 'Ravenous creature disguised as a closed treasure chest.', 300, 235),
(10, 'Ghoul', 1, 'https://i.pinimg.com/originals/05/32/0c/05320c85ef6b3502cff56eaf901b5a9a.jpg', 'Twisted undead that feeds on the blood and bones of the living', 335, 105),
(11, 'Beastman', 6, 'https://www.aidedd.org/dnd/images/wereWolf.jpg', 'A half-man, half-wolf driven to insanity by its twisted form and endless hunger.', 345, 110),
(12, 'Vampire', 6, 'https://i.pinimg.com/originals/46/bd/6a/46bd6aefa398d47a8f663d90d0d0cad5.jpg', 'An undead human twisted by dark magic. Constantly thirsts for blood.', 675, 95),
(13, 'Necromancer', 5, 'https://dungeonsmaster.com/wp-content/uploads/2009/09/Necromancer11.jpg', 'An evil sorcerer well-versed in dark magic. Can raise and control the dead.', 725, 105),
(14, 'Orc', 8, 'https://media-waterdeep.cursecdn.com/avatars/thumbnails/0/301/1000/1000/636252771691385727.jpeg', 'A strong and proud warrior creature capable of head-to-head combat.', 485, 250),
(15, 'Possessed Armor', 3, 'http://www.aidedd.org/dnd/images/animatedArmor.jpg', 'A special spirit that sealed its essence in a hefty suit of armor. ', 375, 185),
(16, 'Golem', 4, 'https://media-waterdeep.cursecdn.com/avatars/thumbnails/0/243/1000/1000/636252767318152303.jpeg', 'A massive clay idol given life through magic sigils.', 500, 215),
(17, 'Automaton', 4, 'https://i.pinimg.com/736x/b1/d0/05/b1d00522890fe7a6cb581904e88dff2a.jpg', 'A mighty mechanical construct powered by an ancient power source.', 800, 20),
(18, 'Witch', 5, 'http://i.imgur.com/Igz6VBF.jpg', 'A wicked sorcerer that concocts vile potions', 725, 105),
(19, 'Ogre', 7, 'https://media-waterdeep.cursecdn.com/avatars/thumbnails/0/285/1000/1000/636252770535203221.jpeg', 'An ugly brute of a cave creature that devours anything and anyone.', 675, 295),
(20, 'Zombie', 1, 'https://i.pinimg.com/originals/52/cb/28/52cb2838ad2b5c7d37e61f555f391a92.png', 'An unsightly reanimated corpse that feeds on the flesh of the living.', 25, 650);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dk_admin`
--
ALTER TABLE `dk_admin`
  ADD PRIMARY KEY (`userId`) USING BTREE;

--
-- Indexes for table `dk_categories`
--
ALTER TABLE `dk_categories`
  ADD PRIMARY KEY (`categoryId`) USING BTREE;

--
-- Indexes for table `dk_products`
--
ALTER TABLE `dk_products`
  ADD PRIMARY KEY (`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dk_products`
--
ALTER TABLE `dk_products`
  MODIFY `productId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
