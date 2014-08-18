--
-- Estrutura para tabela `consumer`
--

CREATE TABLE IF NOT EXISTS `consumer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `user` int(11) NOT NULL,
  `operation` tinyint(4) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `group` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `maxinvent` int(11) DEFAULT NULL,
  `mininvent` int(11) DEFAULT NULL,
  `catmat` varchar(100) DEFAULT NULL,
  `observation` varchar(255),
  `value` decimal(19,9) NOT NULL DEFAULT '0.000000000',
  `quantity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `group` (`group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `productinput`
--

CREATE TABLE IF NOT EXISTS `productinput` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `provider` int(11) NOT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `value` decimal(19,9) NOT NULL,
  `empenho` varchar(255) DEFAULT NULL,
  `empenhodate` date DEFAULT NULL,
  `fiscnote` varchar(255) DEFAULT NULL,
  `fiscnotedate` date DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product` (`product`),
  KEY `provider` (`provider`),
  KEY `user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `productoutput`
--

CREATE TABLE IF NOT EXISTS `productoutput` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `consumer` int(11) NOT NULL,
  `responsible` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `value` decimal(19,9) NOT NULL,
  `quantity` int(11) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product` (`product`),
  KEY `consumer` (`consumer`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `provider`
--

CREATE TABLE IF NOT EXISTS `provider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `document` varchar(22) NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone1` varchar(15) DEFAULT NULL,
  `phone1resp` varchar(255) DEFAULT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `phone2resp` varchar(30) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `lastlogin` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Estrutura para tabela `productimmediate`
--

CREATE TABLE IF NOT EXISTS `productimmediate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `provider` int(11) DEFAULT NULL,
  `consumer` int(11) NOT NULL,
  `responsible` varchar(30) NOT NULL,
  `document` varchar(30) DEFAULT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `value` decimal(19,9) NOT NULL,
  `fiscnote` varchar(50) NOT NULL,
  `fiscnotedate` date NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Restrições para tabelas `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`group`) REFERENCES `group` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT;

--
-- Restrições para tabelas `productinput`
--
ALTER TABLE `productinput`
  ADD CONSTRAINT `productinput_ibfk_1` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  ADD CONSTRAINT `productinput_ibfk_2` FOREIGN KEY (`provider`) REFERENCES `provider` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  ADD CONSTRAINT `productinput_ibfk_3` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT;

--
-- Restrições para tabelas `productoutput`
--
ALTER TABLE `productoutput`
  ADD CONSTRAINT `productoutput_ibfk_1` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  ADD CONSTRAINT `productoutput_ibfk_2` FOREIGN KEY (`consumer`) REFERENCES `consumer` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  ADD CONSTRAINT `productoutput_ibfk_3` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT;

--
-- Restrições para tabelas `productimmediate`
--
ALTER TABLE `productimmediate`
  ADD CONSTRAINT `productimmediate_ibfk_1` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  ADD CONSTRAINT `productimmediate_ibfk_2` FOREIGN KEY (`consumer`) REFERENCES `consumer` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  ADD CONSTRAINT `productimmediate_ibfk_3` FOREIGN KEY (`provider`) REFERENCES `provider` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  ADD CONSTRAINT `productimmediate_ibfk_4` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT;

--
-- Usuário admin
--
INSERT INTO `almoxarifado`.`user` (`id`, `name`, `login`, `password`, `level`, `lastlogin`, `active`) VALUES (NULL, 'admin', 'admin', SHA1('123456'), '3', NULL, '1');
