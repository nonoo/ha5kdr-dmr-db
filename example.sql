CREATE TABLE IF NOT EXISTS `dmr-db-repeaters` (
  `callsign` varchar(8) NOT NULL,
  `callsignid` int(11) NOT NULL,
  `qrg` float NOT NULL,
  `shift` float NOT NULL,
  `cc` tinyint(4) NOT NULL,
  `mix` tinyint(1) NOT NULL,
  `ctcss` float NOT NULL,
  `net` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `county` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  PRIMARY KEY (`callsignid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dmr-db-users` (
  `callsign` varchar(8) NOT NULL,
  `callsignid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  PRIMARY KEY (`callsignid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
