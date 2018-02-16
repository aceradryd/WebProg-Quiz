-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Feb 2018 um 16:41
-- Server Version: 5.5.59-0+deb8u1
-- PHP-Version: 5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `WebProg`
--

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `anzahlGelesenerSeiten`
--
CREATE TABLE IF NOT EXISTS `anzahlGelesenerSeiten` (
`Anzahl` bigint(21)
,`nutzer_id` bigint(20) unsigned
);
-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `einzelbewertung`
--
CREATE TABLE IF NOT EXISTS `einzelbewertung` (
`quiz_id` bigint(20) unsigned
,`nutzer_id` bigint(20) unsigned
,`versuch` int(11)
,`erfolgreich` int(11)
,`frage` text
);
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `freitext`
--

CREATE TABLE IF NOT EXISTS `freitext` (
  `id` bigint(20) unsigned NOT NULL,
  `frage` text,
  `antwort` text,
  `hinweis` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `freitext`
--

INSERT INTO `freitext` (`id`, `frage`, `antwort`, `hinweis`) VALUES
(11, 'Was ist der Geheimtext zum Klartext "HI" beim Caesarverfahren mit der Verschiebung 3? (Groß- und Kleinschreibung ist irrelevant)', '/^kl$/', 'Lesen Sie dies <a href="/info/#3">hier</a> nochmal nach.'),
(12, 'Fülle die folgende Lücke auf:<br><br>Die Stützpfeiler der Datensicherheit sind ___________, Vertraulichkeit, Integrität und Authentizität.', '/^verfügbarkeit$/', 'Lesen Sie dies <a href="/info/#1">hier</a> nochmal nach.'),
(13, 'Wie heißt das eingeführte Verfahren für asymmetrische Verschlüsselung? (___-Verfahren)', '/^rsa$/', 'Lesen Sie dies <a href="/info/#5">hier</a> nochmal nach.'),
(14, 'Die Formel zur RSA-Verschlüsselung lautet: ', '/^c=m\\^emodn$/', 'Lesen Sie dies <a href="/info/#5">hier</a> nochmal nach.'),
(15, 'Welcher Buchstabe kommt raus, wenn man 32 mit dem geheimen Schlüsselpaar (5;91) entschlüsselt (A=1, B=2, ...)?', '/^b$/', 'Lesen Sie dies <a href="/info/#5">hier</a> nochmal nach.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `geleseneSeiten`
--

CREATE TABLE IF NOT EXISTS `geleseneSeiten` (
  `seiten_id` bigint(20) unsigned NOT NULL,
  `nutzer_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `gesamtbewertung`
--
CREATE TABLE IF NOT EXISTS `gesamtbewertung` (
`nutzer_id` bigint(20) unsigned
,`erfolgreich` decimal(32,0)
,`anzahl` bigint(21)
);
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `multipleChoice`
--

CREATE TABLE IF NOT EXISTS `multipleChoice` (
  `id` bigint(20) unsigned NOT NULL,
  `frage` text,
  `hinweis` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `multipleChoice`
--

INSERT INTO `multipleChoice` (`id`, `frage`, `hinweis`) VALUES
(6, 'In welche der folgenden Punkte unterteilt sich die Kryptologie?', 'Lies die <a href="/info/#1">Einführung</a> nochmal.'),
(7, 'Was kann man mithilfe des öffentlichen Schlüssels bei asymmetrischen Verfahren machen?', 'Lesen Sie dies <a href="/info/#4">hier</a> nochmal nach.'),
(8, 'Wenn beim Caesarverfahren A auf Z und B auf A abbildet, worauf bildet X ab?', 'Lies dies im Abschnitt <a href="/info/#3">"Caesar-Verfahren"</a> nochmal nach.'),
(9, 'Der öffentliche Schlüssel besteht beim RSA-Verfahren aus:', 'Lies dies im Abschnitt <a href="/info/#5">"RSA-Verfahren"</a> nochmal nach.'),
(10, 'Der private Schlüssel besteht beim RSA-Verfahren aus:', 'Lies dies im Abschnitt <a href="/info/#5">"RSA-Verfahren"</a> nochmal nach.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `multipleChoiceAnswers`
--

CREATE TABLE IF NOT EXISTS `multipleChoiceAnswers` (
  `id` bigint(20) unsigned NOT NULL,
  `multipleChoice_id` bigint(20) unsigned NOT NULL,
  `antwort` text,
  `richtig` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `multipleChoiceAnswers`
--

INSERT INTO `multipleChoiceAnswers` (`id`, `multipleChoice_id`, `antwort`, `richtig`) VALUES
(1, 6, 'Kryptographie', 1),
(1, 7, 'Verschlüsseln', 1),
(1, 8, 'W', 1),
(1, 9, 'd', 0),
(1, 10, 'd', 1),
(2, 6, 'Kryptoanalyse', 1),
(2, 7, 'Entschlüsseln', 0),
(2, 8, 'X', 0),
(2, 9, 'e', 1),
(2, 10, 'e', 0),
(3, 6, 'Symmetrische Verfahren', 0),
(3, 8, 'Y', 0),
(3, 9, 'N', 1),
(3, 10, 'N', 1),
(4, 6, 'Asymmetrische Verfahren', 0),
(4, 8, 'Z', 0),
(4, 9, 'y', 0),
(4, 10, 'y', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nutzer`
--

CREATE TABLE IF NOT EXISTS `nutzer` (
`id` bigint(20) unsigned NOT NULL,
  `nutzername` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `passwort` varchar(72) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
`id` bigint(20) unsigned NOT NULL,
  `typ` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `quiz`
--

INSERT INTO `quiz` (`id`, `typ`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `quizbereitschaft`
--
CREATE TABLE IF NOT EXISTS `quizbereitschaft` (
`Anzahl` bigint(21)
,`nutzer_id` bigint(20) unsigned
);
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `quizerfolg`
--

CREATE TABLE IF NOT EXISTS `quizerfolg` (
  `quiz_id` bigint(20) unsigned NOT NULL,
  `nutzer_id` bigint(20) unsigned NOT NULL,
  `versuch` int(10) DEFAULT NULL,
  `erfolgreich` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `seiten`
--

CREATE TABLE IF NOT EXISTS `seiten` (
  `id` bigint(20) unsigned NOT NULL,
  `titel` text,
  `inhalt` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `seiten`
--

INSERT INTO `seiten` (`id`, `titel`, `inhalt`) VALUES
(1, 'Einführung', 'Die Datensicherheit bezeichnet Grundsätze zum Schutz von Daten. Dabei stützt sich die Datensicherheit auf die vier Stützpfeiler Vertraulichkeit, Integrität, Verfügbarkeit, Authentizität.<br><br><ul>	<li>Vertraulichkeit: Nur dazu berechtigte Personen dürfen Daten lesen und diese verändern</li>	<li>Integrität: Jegliche Änderung von Daten muss jederzeit nachvollziehbar sein.</li>	<li>Verfügbarkeit: Der Zugriff auf Daten muss in einem bestimmten Zeitraum gewährleistet sein.</li>	<li>Authentizität: Es ist überprüfbar, von wem die Daten stammen.</li></ul>Die Kryptologie versucht die Vertraulichkeit zu sichern und unterteilt sich in Kryptografie und Kryptoanalyse.<br>Die Kryptografie unterteilt sich dabei wieder in symmetrische und asymmetrische Verfahren.<br><br><img src="/_include/img/unterteilung.png" width="600px"><br><br>Kryptografie beschäftigt sich hierbei mit der Absicherung von Informationen. Dies geschieht beispielsweise durch Verschlüsselung von Nachrichten.<br>Bei der Kryptoanalyse geht es darum, die Verschlüsselungsverfahren auf ihre Sicherheit zu überprüfen.<br>'),
(2, 'Symmetrische Verfahren', 'Symmetrische Verfahren sind die bekanntesten Verschlüsselungsverfahren. Hierbei besitzen sowohl der Empfänger als auch der Sender denselben Schlüssel zur Ver- und Entschlüsselung. Bis 1976 wurde ausschließlich dieses Prinzip in der Kryptografie angewendet und man benutzt sie auch heute noch zur Verschlüsselung und als Integritätsschutz von Daten.<br><br>Das Prinzip der symmetrischen Verfahren kann man an folgendem Beispiel einfach verstehen:<br>Alice möchte Bob eine Nachricht per Postkarte (unsicherer Kanal) mitteilen, kann sich aber nicht sicher sein, dass niemand die Nachricht mitliest. Damit Alice die Nachricht trotzdem vertraulich Bob mitteilen kann, verschlüsselt sie diese erst mit einem geheimen Schlüssel. Dieser Schlüssel wird dann von der Nachricht getrennt sicher übermittelt. Dies kann zum Beispiel in einem persönlichen Gespräch erfolgen. Die verschlüsselte Nachricht wird daraufhin unsicher übertragen und anschließend von Bob mit dem geheimen Schlüssel wieder entschlüsselt.<br><br>Das Verfahren nennt man hierbei symmetrisch, da für die Verschlüsselung als auch für die Entschlüsselung der gleiche Schlüssel benutzt wird. Dies wird in folgendem Schema noch mal dargestellt:<br><br><img src="https://upload.wikimedia.org/wikipedia/commons/7/7b/Orange_blue_symmetric_cryptography_de.svg" width="600px">'),
(3, 'Caesar-Verschlüsselung', 'Das Caesarverfahren ist wohl das bekannteste symmetrische Verschlüsselungsverfahren.Der Name dieses Verfahrens kommt daher, dass Julius Cäsar dieses Verfahren für militärische Korrespondenz benutzt haben soll.<br><br><img src="https://upload.wikimedia.org/wikipedia/commons/archive/2/2b/20061227194048%21Caesar3.svg" width="600px"><br><br>Hierbei wird jeder Buchstabe um eine bestimmte und für alle Buchstaben gleiche Anzahl im Alphabet verschoben. Also wird bei einer Verschiebung von 3 das A zu einem D und das B zu einem E. Bei Buchstaben gegen Ende des Alphabets wird dabei angenommen das nach ...,X,Y,Z A,B,C,... kommt, wodurch aus Z C wird.<br><br>Um die Daten wieder zu entschlüsseln, wird jeder Buchstabe um die gleiche Anzahl im Alphabet zurückgeschoben. Das heißt, aus D wird wieder ein A und aus C ein Z. Hierbei ist die Anzahl der Verschiebung (in unserem Beispiel 3) der geheime Schlüssel.<br>'),
(4, 'Asymmetrische Verfahren', 'Die asymmetrische Verschlüsselung ist im Gegensatz zur symmetrischen Verschlüsselung sehr neu und wurde erstmalig 1976 von Whitfield Diffie, Martin Hellman und Ralph Merkle eingeführt. Bei der symmetrischen Verschlüsselung gab es das Problem, dass der geheime Schlüssel über einen sicheren Kanal ausgetauscht werden musste. Außerdem kann es sein, dass Alice oder Bob den Schlüssel weiterverkaufen, wodurch die Vertraulichkeit der Daten nicht mehr sichergestellt werden kann. Um diese Probleme zu umgehen, hat man sich ein Verfahren ausgedacht, bei dem es möglich war, mit einem öffentlichen Schlüssel die Daten zu verschlüsseln und mit einem privaten geheimen Schlüssel wieder zu entschlüsseln.<br><br><img src="/_include/img/asymmetrisch.png" width="600px"><br><br>Dies kann man sich so vorstellen, dass eine Truhe mit einem Schloss (öffentlicher Schlüssel) verschlossen wird und nur vom Schlüsselbesitzer wieder mit diesem privaten (geheimen) Schlüssel geöffnet werden kann.'),
(5, 'RSA-Verschlüsselung', 'Das RSA-Verfahren (Rivest-Shamir-Adleman) ist das am häufigsten benutzte asymmetrische Verfahren.<br><br>Beim RSA-Verfahren wird zuerst ein Schlüsselpaar aus einem öffentlichen und einem privaten Schlüssel erstellt.<br>Schlüsselerstellung (mit Beispiel):<br><ol>	<li>Wähle zwei verschiedene Primzahlen p und q: p=7 und q=13</li>	<li>Berechne das RSA-Modul N=p*q: N=91=7*12</li>	<li>Berechne den Wert der eulerschen Phi-Funktion &phi;(N)=(p-1)*(q-1): &phi;(91)=6*12=72</li>	<li>Wähle eine zu &phi;(N) teilerfremde Zahl e mit 1&lt;e&lt;&phi;(N): e=29</li>	<li>Das Tupel (e,N) ist der öffentliche Schlüssel: (29,91)</li>	<br>	<li>Wähle eine Zahl d für die folgendes gilt e*d mod &phi;(N) = 1: d=5</li>	<li>Das Tupel (d,N) ist der private Schlüssel: (5,91)</li></ol><br>Verschlüsselung (am Beispiel B):<br><ol>	<li>Konvertiere das Zeichen B in eine Zahl m (Bsp: A=1, B=2, ...): m=2</li>	<li>Berechne c=m^e mod N: c=2^29 mod 91=32</li>	<li>c ist das verschlüsselte Zeichen: c=32</li></ol><br>Entschlüsselung (am Beispiel 32):<br><ol>	<li>Berechne m=c^d mod N: m=32^5 mod 91=2</li>	<li>Konvertiere die Zahl m in ein Zeichen (Bsp: A=1, B=2, ...): B</li>	<li>B ist das entschlüsselte Zeichen.</li></ol>');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `singleChoice`
--

CREATE TABLE IF NOT EXISTS `singleChoice` (
  `id` bigint(20) unsigned NOT NULL,
  `frage` text,
  `antwort` int(11) DEFAULT NULL,
  `hinweis` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `singleChoice`
--

INSERT INTO `singleChoice` (`id`, `frage`, `antwort`, `hinweis`) VALUES
(1, 'Symmetrische Verfahren haben einen öffentlichen und einen geheimen Schlüssel.', 2, 'Asymetrische Verfahren haben einen öffentlichen und geheimen Schlüssel. Welche Schlüsselarten symmetrische Verfahren dagegen haben erfährst du <a href="/info/#2">hier</a>.'),
(2, 'Asymmetrische Verfahren werden schon viel länger benutzt als symmetrische Verfahren.', 1, 'Lies die <a href="/info/#2">hier</a> und <a href="/info/#4">hier</a> nochmal nach.'),
(3, 'Den geheimen Schlüssel bei symmetrischen Verfahren über einen unsicheren Kanal auszutauschen ist unbedenklich.', 2, 'Lies dies <a href="/info/#2">hier</a> nochmal nach.'),
(4, 'Symmetrische und asymmetrische Verfahren sind Teilgebiete der Kryptografie.', 1, 'Lies dies <a href="/info/#1">hier</a> nochmal nach.'),
(5, 'Die Kryptoanalyse beschäftigt sich mit der Analyse von Absicherungverfahren.', 1, 'Lies dies <a href="/info/#1">hier</a> nochmal nach.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `singleChoiceAnswers`
--

CREATE TABLE IF NOT EXISTS `singleChoiceAnswers` (
  `id` bigint(20) unsigned NOT NULL,
  `singleChoice_id` bigint(20) unsigned NOT NULL,
  `antwort` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `singleChoiceAnswers`
--

INSERT INTO `singleChoiceAnswers` (`id`, `singleChoice_id`, `antwort`) VALUES
(1, 1, 'Wahr'),
(1, 2, 'Falsch'),
(1, 3, 'Wahr'),
(1, 4, 'Wahr'),
(1, 5, 'Wahr'),
(2, 1, 'Falsch'),
(2, 2, 'Wahr'),
(2, 3, 'Falsch'),
(2, 4, 'Falsch'),
(2, 5, 'Falsch');

-- --------------------------------------------------------

--
-- Struktur des Views `anzahlGelesenerSeiten`
--
DROP TABLE IF EXISTS `anzahlGelesenerSeiten`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `anzahlGelesenerSeiten` AS select count(0) AS `Anzahl`,`geleseneSeiten`.`nutzer_id` AS `nutzer_id` from `geleseneSeiten` group by `geleseneSeiten`.`nutzer_id`;

-- --------------------------------------------------------

--
-- Struktur des Views `einzelbewertung`
--
DROP TABLE IF EXISTS `einzelbewertung`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `einzelbewertung` AS select `quizerfolg`.`quiz_id` AS `quiz_id`,`quizerfolg`.`nutzer_id` AS `nutzer_id`,`quizerfolg`.`versuch` AS `versuch`,`quizerfolg`.`erfolgreich` AS `erfolgreich`,`singleChoice`.`frage` AS `frage` from (`quizerfolg` join `singleChoice` on((`quizerfolg`.`quiz_id` = `singleChoice`.`id`))) where ((`quizerfolg`.`versuch` = 2) or (`quizerfolg`.`erfolgreich` = 1)) union select `quizerfolg`.`quiz_id` AS `quiz_id`,`quizerfolg`.`nutzer_id` AS `nutzer_id`,`quizerfolg`.`versuch` AS `versuch`,`quizerfolg`.`erfolgreich` AS `erfolgreich`,`multipleChoice`.`frage` AS `frage` from (`quizerfolg` join `multipleChoice` on((`quizerfolg`.`quiz_id` = `multipleChoice`.`id`))) where ((`quizerfolg`.`versuch` = 2) or (`quizerfolg`.`erfolgreich` = 1)) union select `quizerfolg`.`quiz_id` AS `quiz_id`,`quizerfolg`.`nutzer_id` AS `nutzer_id`,`quizerfolg`.`versuch` AS `versuch`,`quizerfolg`.`erfolgreich` AS `erfolgreich`,`freitext`.`frage` AS `frage` from (`quizerfolg` join `freitext` on((`quizerfolg`.`quiz_id` = `freitext`.`id`))) where ((`quizerfolg`.`versuch` = 2) or (`quizerfolg`.`erfolgreich` = 1));

-- --------------------------------------------------------

--
-- Struktur des Views `gesamtbewertung`
--
DROP TABLE IF EXISTS `gesamtbewertung`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `gesamtbewertung` AS select `einzelbewertung`.`nutzer_id` AS `nutzer_id`,sum(`einzelbewertung`.`erfolgreich`) AS `erfolgreich`,count(`einzelbewertung`.`erfolgreich`) AS `anzahl` from `einzelbewertung` group by `einzelbewertung`.`nutzer_id`;

-- --------------------------------------------------------

--
-- Struktur des Views `quizbereitschaft`
--
DROP TABLE IF EXISTS `quizbereitschaft`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `quizbereitschaft` AS select `anzahlGelesenerSeiten`.`Anzahl` AS `Anzahl`,`anzahlGelesenerSeiten`.`nutzer_id` AS `nutzer_id` from `anzahlGelesenerSeiten` where (`anzahlGelesenerSeiten`.`Anzahl` = 5);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `freitext`
--
ALTER TABLE `freitext`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `geleseneSeiten`
--
ALTER TABLE `geleseneSeiten`
 ADD PRIMARY KEY (`seiten_id`,`nutzer_id`), ADD KEY `geleseneSeiten_nutzer_id_idx` (`nutzer_id`);

--
-- Indizes für die Tabelle `multipleChoice`
--
ALTER TABLE `multipleChoice`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `multipleChoiceAnswers`
--
ALTER TABLE `multipleChoiceAnswers`
 ADD PRIMARY KEY (`id`,`multipleChoice_id`), ADD KEY `multipleChoiceAnswers_multipleChoice_id_idx` (`multipleChoice_id`);

--
-- Indizes für die Tabelle `nutzer`
--
ALTER TABLE `nutzer`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nutzername_UNIQUE` (`nutzername`);

--
-- Indizes für die Tabelle `quiz`
--
ALTER TABLE `quiz`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `quizerfolg`
--
ALTER TABLE `quizerfolg`
 ADD PRIMARY KEY (`quiz_id`,`nutzer_id`), ADD KEY `quizerfolg_nutzer_id_idx` (`nutzer_id`);

--
-- Indizes für die Tabelle `seiten`
--
ALTER TABLE `seiten`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `singleChoice`
--
ALTER TABLE `singleChoice`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `singleChoiceAnswers`
--
ALTER TABLE `singleChoiceAnswers`
 ADD PRIMARY KEY (`id`,`singleChoice_id`), ADD KEY `singleChoiceAnswers_singleChoice_id_idx` (`singleChoice_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `nutzer`
--
ALTER TABLE `nutzer`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT für Tabelle `quiz`
--
ALTER TABLE `quiz`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `freitext`
--
ALTER TABLE `freitext`
ADD CONSTRAINT `freitext_quiz_id` FOREIGN KEY (`id`) REFERENCES `quiz` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `geleseneSeiten`
--
ALTER TABLE `geleseneSeiten`
ADD CONSTRAINT `geleseneSeiten_nutzer_id` FOREIGN KEY (`nutzer_id`) REFERENCES `nutzer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `geleseneSeiten_seiten_id` FOREIGN KEY (`seiten_id`) REFERENCES `seiten` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `multipleChoice`
--
ALTER TABLE `multipleChoice`
ADD CONSTRAINT `multipleChoice_id` FOREIGN KEY (`id`) REFERENCES `quiz` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `multipleChoiceAnswers`
--
ALTER TABLE `multipleChoiceAnswers`
ADD CONSTRAINT `multipleChoiceAnswers_multipleChoice_id` FOREIGN KEY (`multipleChoice_id`) REFERENCES `multipleChoice` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `quizerfolg`
--
ALTER TABLE `quizerfolg`
ADD CONSTRAINT `quizerfolg_nutzer_id` FOREIGN KEY (`nutzer_id`) REFERENCES `nutzer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `quizerfolg_quiz_id` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `singleChoice`
--
ALTER TABLE `singleChoice`
ADD CONSTRAINT `singleChoice` FOREIGN KEY (`id`) REFERENCES `quiz` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `singleChoiceAnswers`
--
ALTER TABLE `singleChoiceAnswers`
ADD CONSTRAINT `singleChoiceAnswers_singleChoice_id` FOREIGN KEY (`singleChoice_id`) REFERENCES `singleChoice` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
