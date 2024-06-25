-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 11. čen 2024, 16:55
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `usi`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$TJGAMiL.au/M7ISuoF9xYeCrd2lCZSqGJitr5BCBwPIAAr4EJ9a/.');

-- --------------------------------------------------------

--
-- Struktura tabulky `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `category`
--

INSERT INTO `category` (`category_id`, `title`) VALUES
(1, 'rodinné pečení');

-- --------------------------------------------------------

--
-- Struktura tabulky `category_event`
--

CREATE TABLE `category_event` (
  `category_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `event`
--

INSERT INTO `event` (`event_id`, `title`, `date`, `location`, `description`, `author_id`) VALUES
(1, ' Alarm für Cobra 11', '2024-04-30', 'Alarm für Cobra 11', 'Semir Gerkhan dálniční policie', 1),
(3, 'awdasd', '2024-04-19', 'awdasd', 'sadawd', 1),
(4, 'karel', '2024-05-01', 'awdas d', 'awdasd', 1),
(5, 'Dsadasdd', '2024-05-18', 'lokace', 'ahojda', 1),
(6, 'Dsassd', '2024-05-17', 'asd', 'asdgg', 1),
(7, 'admin', '2024-05-02', 'admin', 'admin', 1),
(8, 'admin', '2024-05-02', 'admin', 'admin', 1),
(9, 'kjjkkj', '2024-05-03', 'jjkkjkjkj', 'kjjkkjjkkj', 1),
(10, 'dwawd', '2024-05-10', 'sdawd', 'sadaw', 1),
(12, 'Robo Rumble', '2024-05-21', 'lokace 1234', 'Lorem ipsum dolor dasfafd asdf dsaf asdf asd fasd fas fdasfd asd', 1),
(13, 'Unikovka', '2024-05-01', 'lokace 12', 'asdfasdf asdsfasdfa sfdsadfsafd asdf asdf asdfd dsa fas fdsaf', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `image`
--

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL,
  `url` varchar(512) NOT NULL,
  `isVideo` tinyint(1) NOT NULL DEFAULT 0,
  `event_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `image`
--

INSERT INTO `image` (`image_id`, `url`, `isVideo`, `event_id`, `school_id`) VALUES
(40, 'image_default.png', 0, 6, NULL),
(42, 'image_default.png', 0, 8, NULL),
(45, 'image_default.png', 0, 10, NULL),
(46, 'image_default.png', 0, 9, NULL),
(47, 'image_default.png', 0, 7, NULL),
(48, 'image_default.png', 0, 4, NULL),
(49, 'image_default.png', 0, 1, NULL),
(50, 'image_default.png', 0, 3, NULL),
(55, 'image_664b10330fb1a.jpg', 0, 12, NULL),
(56, 'image_664c3bacb39eb.png', 0, 12, NULL),
(57, 'image_default.png', 0, NULL, 1),
(58, 'image_default.png', 0, NULL, 2),
(59, 'image_664c555b0da10.jpg', 0, 13, NULL),
(60, 'image_664c686a14009.png', 0, NULL, 20),
(64, 'image_66598319843b0.png', 0, 12, NULL),
(68, 'image_66598e2c929bb.png', 0, NULL, 21),
(69, 'image_66599e76111eb.jpg', 0, 5, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `school`
--

CREATE TABLE `school` (
  `school_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `headmaster` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `logoUrl` varchar(512) NOT NULL,
  `webUrl` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `school`
--

INSERT INTO `school` (`school_id`, `title`, `address`, `headmaster`, `description`, `logoUrl`, `webUrl`) VALUES
(1, 'Střední průmyslová škola', 'Gen. Kholla 897', 'Jan Jirátko', 'Lorem ipsum dolor simet adsf asdf asdf asdfas fsadf a sdfasfd asdfa sdf', 'image_default.png', 'https://spsrakovnik.cz'),
(2, 'Střední umělecká škola', 'Ulice 123', 'Nekdo Nekdo', 'sdahf asdf ahdfhajfkha dfafdasf asdfasdfa ads', '', ''),
(3, 'Gymnazium ABC', 'Adresa 123', 'Ředitel 1', 'bla bla blabla bla blabla bla blabla bla bla', 'image_664c587707b8d.jpg', 'https://www.gymzl.cz/'),
(4, 'Nejaka skola', 'Adresa 123', 'Ředitel 3', 'asdasd fsa fasdfsadf sadfsad fasd fasdf ', 'image_default.png', 'https://www.gymzl.cz/'),
(5, 'nakaskola', 'Adresa 123', 'Ředitel 2', 'adffsda fasdf asfd asfd asfd asf a', 'image_default.png', 'https://www.gymzl.cz/'),
(6, 'spsrakovnik', 'Adresa 123', 'Ředitel 1', 'asdfasdf sdaf sad fdsf a fasd fdsaf asd fasfd ', 'image_default.png', 'https://www.spsrakovnik.cz/'),
(7, 'sddfasdfasdf', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_default.png', 'https://www.spsrakovnik.cz/'),
(8, 'sddfasdfasdf', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_default.png', 'https://www.spsrakovnik.cz/'),
(9, 'sddfasdfasdf', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_default.png', 'https://www.spsrakovnik.cz/'),
(10, 'sddfasdfasdf', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_default.png', 'https://www.spsrakovnik.cz/'),
(11, 'sddfasdfasdf', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_default.png', 'https://www.spsrakovnik.cz/'),
(12, 'sddfasdfasdf', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_default.png', 'https://www.spsrakovnik.cz/'),
(13, 'sddfasdfasdf', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_default.png', 'https://www.spsrakovnik.cz/'),
(14, 'sddfasdfasdf', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_default.png', 'https://www.spsrakovnik.cz/'),
(15, 'sddfasdfasdf', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_default.png', 'https://www.spsrakovnik.cz/'),
(16, 'sddfasdfasdf', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_default.png', 'https://www.spsrakovnik.cz/'),
(17, 'sddfasdfasdf', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_default.png', 'https://www.spsrakovnik.cz/'),
(18, 'sddfasdfasdf', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_default.png', 'https://www.spsrakovnik.cz/'),
(19, 'sddfasdfasdf', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_664c683d378f1.png', 'https://www.spsrakovnik.cz/'),
(20, 'sddfasdfasdf', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_664c686a13e1c.jpg', 'https://www.spsrakovnik.cz/'),
(21, 'balin', 'Adresa 123', 'Ředitel 1', 'asdfasdf sadf asdf asf asf asf', 'image_66598d432030c.jpg', 'https://www.spsrakovnik.cz/'),
(22, 'novaskola', 'novaadresa', 'Jan Novy', 'asdfa sdsdf asdf asdf asd f', 'image_664c7067344fa.png', 'https://www.spsrakovnik.cz/');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexy pro tabulku `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexy pro tabulku `category_event`
--
ALTER TABLE `category_event`
  ADD PRIMARY KEY (`category_id`,`event_id`),
  ADD KEY `event_id` (`event_id`) USING BTREE;

--
-- Indexy pro tabulku `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `author_id` (`author_id`) USING BTREE;

--
-- Indexy pro tabulku `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `event_id` (`event_id`) USING BTREE,
  ADD KEY `school_id` (`school_id`) USING BTREE;

--
-- Indexy pro tabulku `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`school_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pro tabulku `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT pro tabulku `school`
--
ALTER TABLE `school`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `category_event`
--
ALTER TABLE `category_event`
  ADD CONSTRAINT `category_event_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `category_event_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`);

--
-- Omezení pro tabulku `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `admin` (`admin_id`);

--
-- Omezení pro tabulku `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`),
  ADD CONSTRAINT `image_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `school` (`school_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
