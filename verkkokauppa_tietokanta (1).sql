-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 05:50 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verkkokauppa_tietokanta`
--

-- --------------------------------------------------------

--
-- Table structure for table `asiakas`
--

CREATE TABLE `asiakas` (
  `id_asiakas` int(11) NOT NULL,
  `etunimi` varchar(128) NOT NULL,
  `sukunimi` varchar(128) NOT NULL,
  `osoite` varchar(128) NOT NULL,
  `postinro` varchar(5) NOT NULL,
  `postitmp` varchar(128) NOT NULL,
  `puhelinnro` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `kayttajatunnus` varchar(64) NOT NULL,
  `salasana` varchar(64) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asiakas`
--


-- --------------------------------------------------------

--
-- Table structure for table `tilaus`
--

CREATE TABLE `tilaus` (
  `tilausnro` int(11) NOT NULL,
  `tilauspvm` datetime NOT NULL,
  `id_asiakas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tilausrivi`
--

CREATE TABLE `tilausrivi` (
  `rivinro` int(11) NOT NULL,
  `tilausnro` int(11) NOT NULL,
  `tuotenro` int(11) NOT NULL,
  `kpl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tuote`
--

CREATE TABLE `tuote` (
  `tuotenro` int(11) NOT NULL,
  `tuotenimi` varchar(128) NOT NULL,
  `kuvaus` varchar(256) NOT NULL,
  `kuvannimi` varchar(128) NOT NULL,
  `hinta` decimal(10,2) NOT NULL,
  `tuoteryhmanro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tuote`
--

INSERT INTO `tuote` (`tuotenro`, `tuotenimi`, `kuvaus`, `kuvannimi`, `hinta`, `tuoteryhmanro`) VALUES
(1, 'Kahvi', 'Kahvi, johon voit valita makusi mukaan maidon ja sokerin tai molemmat.', 'tuote_kahvi.jpg', '2.50', 1),
(2, 'Cappuccino', 'Espressokahvi, johon on lisätty kuumaa maitoa ja maitovaahtoa.', 'tuote_capuccino.jpg', '3.50', 1),
(3, 'Caffe Latte', 'Kahvijuoma, joka sisältää 1/3 espressoa ja 3/4 vaahdotettua maitoa.', 'tuote_caffelatte.jpg', '4.00', 1),
(4, 'Espresso', 'Vahva sokerilla maustettu kahvijuoma.', 'tuote_espresso.jpg', '3.50', 1),
(5, 'Kaakao', 'Lämmin suklainen kaakao.', 'tuote_kaakao.jpg', '4.00', 2),
(6, 'Tee', 'Kupillinen kuumaa teetä makusi mukaan.', 'tuote_earlgray.jpg', '3.00', 2),
(7, 'Juustoleipä', 'Herkullinen kahdella juustolla ja sesongin vihanneksilla/hedelmillä täytetty leipä.', 'tuote_juustoleipa.jpg', '5.00', 4),
(8, 'Croissant', 'Tuore croissant valitsemillasi täytteillä.', 'tuote_croissant.jpg', '5.50', 4),
(9, 'Kinkkupiiras', 'Maistuva palanen kinkkupiirakkaa.', 'tuote_kinkkupiirakka.jpg', '5.00', 4),
(10, 'Macchiato', 'Kahvi, jonka pohjana espresso sekä lisänä pieni määrä vaahdotettua maitoa.', 'tuote_macchiato.jpg', '4.50', 1),
(11, 'Mansikkaleivos', 'Makea mansikkaleivos.', 'tuote_mansikkaleivos.jpg', '5.50', 3),
(12, 'Mustikkamuffini', 'Tuoreista mustikoista leivottu muffinini.', 'tuote_mustikkamuffini.jpg', '4.50', 3),
(13, 'Mutakakku', 'Suklainen mutakakku kermavaahdolla.', 'tuote_mutakakku.jpg', '5.00', 3),
(14, 'Omenapiirakka', 'Lämmin palanen omenapiirakkaa.', 'tuote_omenapiirakka.jpg', '4.00', 3),
(15, 'Prezel', 'Suolainen makupala.', 'tuote_prezel.jpg', '3.00', 4),
(16, 'Rooibos', 'Maukas rooibostee.', 'tuote_rooibos.jpg', '2.50', 2),
(17, 'Suklaacookie', 'Suklainen cookie.', 'tuote_suklaacookie', '2.00', 3),
(18, 'Täytetty leipä', 'Leipä omavalintaisilla täytteillä.', 'tuote_tayteleipa.jpg', '4.50', 4),
(19, 'Vihreä tee', 'Lämmin kupillinen vihreää teetä.', 'tuote_vihreatee.jpg', '2.50', 2),
(20, 'Yrttitee', 'Tuoreilla yrteillä maustettu haudutettu tee.', 'tuote_yrttitee.jpg', '2.00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tuoteryhma`
--

CREATE TABLE `tuoteryhma` (
  `tuoteryhmanro` int(11) NOT NULL,
  `tuoteryhmanimi` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tuoteryhma`
--

INSERT INTO `tuoteryhma` (`tuoteryhmanro`, `tuoteryhmanimi`) VALUES
(1, 'Kahvit'),
(2, 'Teet ja muut lämpimät juomat'),
(3, 'Makeat syötävät'),
(4, 'Suolaiset syötävät');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asiakas`
--
ALTER TABLE `asiakas`
  ADD PRIMARY KEY (`id_asiakas`);

--
-- Indexes for table `tilaus`
--
ALTER TABLE `tilaus`
  ADD PRIMARY KEY (`tilausnro`),
  ADD KEY `asiakas_viiteavain` (`id_asiakas`);

--
-- Indexes for table `tilausrivi`
--
ALTER TABLE `tilausrivi`
  ADD PRIMARY KEY (`rivinro`,`tilausnro`),
  ADD KEY `tilausrivi_viiteavain` (`tuotenro`);

--
-- Indexes for table `tuote`
--
ALTER TABLE `tuote`
  ADD PRIMARY KEY (`tuotenro`),
  ADD KEY `tuoteryhmanro` (`tuoteryhmanro`);

--
-- Indexes for table `tuoteryhma`
--
ALTER TABLE `tuoteryhma`
  ADD PRIMARY KEY (`tuoteryhmanro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asiakas`
--
ALTER TABLE `asiakas`
  MODIFY `id_asiakas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tilaus`
--
ALTER TABLE `tilaus`
  MODIFY `tilausnro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tuote`
--
ALTER TABLE `tuote`
  MODIFY `tuotenro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tuoteryhma`
--
ALTER TABLE `tuoteryhma`
  MODIFY `tuoteryhmanro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tilaus`
--
ALTER TABLE `tilaus`
  ADD CONSTRAINT `asiakas_viiteavain` FOREIGN KEY (`id_asiakas`) REFERENCES `asiakas` (`id_asiakas`);

--
-- Constraints for table `tilausrivi`
--
ALTER TABLE `tilausrivi`
  ADD CONSTRAINT `tilausrivi_viiteavain` FOREIGN KEY (`tuotenro`) REFERENCES `tuote` (`tuotenro`);

--
-- Constraints for table `tuote`
--
ALTER TABLE `tuote`
  ADD CONSTRAINT `tuote_viiteavain` FOREIGN KEY (`tuoteryhmanro`) REFERENCES `tuoteryhma` (`tuoteryhmanro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
