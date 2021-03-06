-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: imobiliaria
-- ------------------------------------------------------
-- Server version	5.7.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contrato_aluguel`
--

DROP TABLE IF EXISTS `contrato_aluguel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contrato_aluguel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locatario_id` int(11) DEFAULT NULL,
  `imovel_id` int(11) DEFAULT NULL,
  `contrato` longtext,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `taxa_administracao` decimal(10,2) DEFAULT NULL,
  `valor_aluguel` decimal(10,2) DEFAULT NULL,
  `valor_condominio` decimal(10,2) DEFAULT NULL,
  `valor_iptu` decimal(10,2) DEFAULT NULL,
  `codigo_contrato` varchar(200) DEFAULT NULL,
  `status_contrato` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contrato_aluguel_locatario1_idx` (`locatario_id`),
  KEY `fk_contrato_aluguel_imoveis1_idx` (`imovel_id`),
  CONSTRAINT `fk_contrato_aluguel_imoveis1` FOREIGN KEY (`imovel_id`) REFERENCES `imoveis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contrato_aluguel_locatario1` FOREIGN KEY (`locatario_id`) REFERENCES `locatario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrato_aluguel`
--

LOCK TABLES `contrato_aluguel` WRITE;
/*!40000 ALTER TABLE `contrato_aluguel` DISABLE KEYS */;
INSERT INTO `contrato_aluguel` VALUES (12,9,7,'<!DOCTYPE html>\n<html lang=\"pt-br\">\n	<head>\n		<meta charset=\"utf-8\">\n		<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n		<meta name=\"description\" content=\"sistemaphp\">\n\n		<link\n		rel=\"icon\" href=\"http://localhost/imobiliaria/assets/global/icons/icone.ico\" type=\"image/x-icon\">\n\n		<!--css sidebar-->\n		<link href=\"http://localhost/imobiliaria/assets/adm/css/all.css\" rel=\"stylesheet\">\n\n		<title></title>\n	</head>\n\n	<body>\n		<div class=\"container\">\n			<div class=\"text-center mt-5 mb-5\">\n				<b>LOCA????O RESIDENCIAL</b>\n			</div>\n\n			<p>\n				Camila Oliveira,\n				(91) 98820-3131, doravante denominado LOCADOR;\n				Wesley Vila Seca Sanches,\n				(91) 98820-3132, Lorem Ipsum, doravante denominado LOCAT??RIO, celebram o presente contrato de loca????o residencial, com as cl??usulas e condi????es seguintes:\n			</p>\n\n			<div class=\"\">\n				<ul>\n					<li>1)     O LOCADOR cede para loca????o residencial ao LOCAT??RIO, o im??vel situado\n						Travessa W-Nove, CEP\n						68459-810\n						n??\n						521, bairro\n						COHAB, cidade\n						Tucuru??, estado\n						PA.</li>\n\n					<li>2)     A loca????o destina-se ao uso exclusivo como resid??ncia e domicilio do LOCAT??RIO.</li>\n\n					<li>3)     O prazo de loca????o ?? de (12 meses), iniciando-se em\n						\n						e terminando em\n						, limite de tempo em que o im??vel objeto do presente dever?? ser restitu??do independentemente de qualquer notifica????o ou interpela????o sob pena de caracterizar infra????o contratual.</li>\n\n					<li>4)     O aluguel mensal ser?? de R$\n						\n						e dever?? ser pago at?? a data de seu vencimento, todo dia 1?? do m??s seguinte ao vencido, no local do endere??o do LOCADOR ou outro que o mesma venha a designar.</li>\n\n					<div class=\"ms-2\">\n						<li>4.1) A impontualidade acarretar?? juros morat??rios na base de 1% (um por cento) ao m??s calculado sobre o valor do aluguel. O atraso superior a 30 (trinta) dias implicar?? em corre????o monet??ria do valor do aluguel e encargos de cobran??a correspondentes a 10% (dez por cento) do valor assim corrigido.</li>\n\n						<li>\n							4.2) O pagamento de qualquer dos alugu??is n??o implica em ren??ncia do direito de cobran??a de eventuais diferen??as de alugu??is, de encargos ou impostos que oportunamente n??o tiverem sidos lan??ados nos respectivos recibos.\n						</li>\n					</div>\n\n					<li>\n						5)     O aluguel ser?? reajustado anualmente pela varia????o do ...... (??NDICE, exemplo: IGP-M, INPC-IBGE, etc.). Entretanto, se em virtude de lei subsequente vier a ser admitida a corre????o e periodicidade inferior a prevista na legisla????o vigente ?? ??poca de sua celebra????o, que ?? anual, concordam as partes desde j?? e em car??ter irrevog??vel que a corre????o do aluguel e o seu indexador passar?? automaticamente a ser feito no menor prazo que for permitido pela lei posterior e pelo maior ??ndice vigente dentre os permitidos pelo Governo Federal e que venha a refletir a varia????o do per??odo.\n					</li>\n					<li>\n						6)     Havendo prorroga????o t??cita ou expressa do presente contrato o mesmo ser?? reajustado a pre??o de mercado sem qualquer rela????o com o patamar aqui pactuado a ser estabelecido pelo LOCADOR, que poder?? ainda estipular, de comum acordo com o LOCAT??RIO, o ??ndice de reajuste e periodicidade.\n					</li>\n\n					<li>\n						7)     Nas cobran??as judiciais e extrajudiciais de alugueis em atraso os mesmos ser??o acrescidos de juros de mora, atualiza????o monet??ria e honor??rios advocat??cios, na base de 20% ( vinte por cento ) sendo que qualquer recebimento feitos pela LOCADOR fora dos prazos e condi????es convencionais neste contrato, ser?? havido como mera toler??ncia e n??o induzir?? nova????o bem como resgate de recibos posteriores n??o significar?? quita????o de alugu??is e outras obriga????es contratuais deixadas de quitar nas ??pocas certas.\n					</li>\n					<li>\n						8)     O im??vel da presente loca????o destina-se ao uso exclusivo como resid??ncia e domicilio do LOCAT??RIO, conforme cl??usula 2, n??o sendo permitida a transfer??ncia, subloca????o, cess??o ou empr??stimo no todo ou em parte, sem a pr??via e expressa autoriza????o do LOCADOR.\n					</li>\n					<li>\n						9)     Al??m do aluguel s??o de responsabilidade do LOCAT??RIO as despesas com consumo de luz, ??gua, esgoto, seguro contra inc??ndio, imposto predial e todas as demais taxas ou impostos, tributos municipais e encargos da loca????o, que venham a incidir sobre o im??vel, inclusive taxa de condom??nio, que dever??o ser pagas diretamente pela mesma, o qual ficar?? obrigada a apresentar os comprovantes de quita????o juntamente com o pagamento do aluguel.\n					</li>\n					<li>\n						10) O LOCAT??RIO declara neste ato tomar conhecimento da exist??ncia de regras estabelecidas na CONVEN????O DE CONDOM??NIOS e compromete-se a respeit??-las e cumpri-las, juntamente com seus familiares e prepostos, sob pena de rescis??o contratual.\n					</li>\n\n					<li>\n						11) Encerrada a loca????o a entrega das chaves s?? ser?? processada mediante exibi????o ao LOCADOR, dos comprovantes de quita????o das despesas e encargos da loca????o referidos nas cl??usulas anteriores, inclusive corte final de luz.\n					</li>\n					<li>\n						12) Fica facultado ao LOCADOR ou ao seu representante legal vistoriar o im??vel sempre que julgar necess??rio.\n					</li>\n					<li>\n						13) O LOCAT??RIO se obriga, sob pena de cometer infra????o contratual, a comunicar por escrito ao LOCADOR, com antecipa????o m??nima de 30 (trinta) dias, a sua inten????o de devolver o im??vel antes do prazo aqui previsto.\n					</li>\n					<li>\n						14) O LOCAT??RIO assume o compromisso de solicitar ao LOCADOR uma vistoria 30 (trinta) dias antes de desocupar o im??vel para ser constatado o estado de conserva????o do mesmo.\n					</li>\n					<li>\n						15) Quaisquer modifica????es no im??vel locadas s?? poder??o ser feitas com expressa autoriza????o do LOCADOR. Aderem ao mesmo as benfeitorias sejam elas ??teis, necess??rias ou volunt??rias independente de sua natureza, n??o cabendo direito de indeniza????o, reten????o, compensa????o ou reembolso.\n					</li>\n					<li>\n						16) Se no curso da loca????o vier a ocorrer inc??ndio ou danos no pr??dio que demandem obras que impe??am o seu uso normal por mais de 30 (trinta) dias, fal??ncia ou insolv??ncia do LOCAT??RIO, bem como desapropria????o do im??vel, ficar?? rescindida de pleno direito a rela????o locat??cia, sem qualquer direito de indeniza????o ou reten????o do objeto do presente contrato.\n					</li>\n					<li>\n						17) O LOCAT??RIO autoriza ao LOCADOR desde j??, a proceder a sua cita????o inicial, interpela????o, intima????o, notifica????o, ou qualquer outro ato de comunica????o processual mediante comunica????o por e-mail, whatsapp ou outro formato eletr??nico, afora as demais formas previstas em lei.\n					</li>\n\n					<li>\n						18) Fica convencionado que a parte que infringir o presente contrato em qualquer dos seus termos, se sujeita ao pagamento em benef??cio da outra, da multa contratual correspondente a 1 (uma) vez o valor do aluguel vigente ?? ??poca da infra????o, tantas vezes forem as infra????es praticadas, sem preju??zo da resolu????o contratual e demais comunica????es previstas neste instrumento.\n					</li>\n					<li>\n						19) Se o LOCAT??RIO vier a usar da faculdade que lhe confere o contido no artigo 4?? da Lei n ?? 8.245/1991 e devolver o im??vel antes do vencimento do prazo ajustado, pagar?? a multa compensat??ria equivalente a 02 (duas) vezes o valor do aluguel vigente, reduzido proporcionalmente ao tempo do contrato j?? cumprido.\n					</li>\n					<li>\n						20) Salvo declara????o escrita do LOCADOR, quaisquer toler??ncia ou concess??es por ela feita n??o implicam em ren??ncia de direito ou em altera????o contratual, n??o podendo ser invocada pelo LOCAT??RIO como procedente para se furtar ao cumprimento do contrato.\n					</li>\n					<li>\n						21) Permanecendo o LOCAT??RIO no im??vel ap??s o prazo de desocupa????o volunt??ria nos casos de den??ncia condicionada, pagar?? ele o aluguel pena que vier a ser arbitrado na notifica????o premonit??ria na forma de que disp??e o artigo 575 do Novo C??digo Civil Brasileiro, o mesmo ocorrendo no caso de m??tuo acordo nos termos do artigo 9, inciso I da Lei n ?? 8.245/1991, quando a desocupa????o n??o se verificar na data convencionada.\n					</li>\n					<li>\n						22) No caso do im??vel ser posto ?? venda, o LOCAT??RIO declara que n??o possui interesse em sua aquisi????o, renunciando expressamente ao eventual direito de prefer??ncia e autoriza desde j??, a visita de interessados, em hor??rios previamente convencionados.\n					</li>\n					<li>\n						23) O LOCAT??RIO declara, para todos os fins e efeitos de direito, que recebe o im??vel locado em condi????es plenas de uso, em perfeito estado de conserva????o, higiene e limpeza, obrigando-se e comprometendo-se a devolv??-lo em iguais condi????es, independente de qualquer aviso ou notifica????o pr??via, e qualquer que seja o motivo da devolu????o, sob pena de incorrer nas comina????es previstas neste contrato ou estipuladas em lei, al??m da obriga????o de indenizar por danos ou preju??zos decorrentes da inobserv??ncia desta obriga????o, salvo as deteriora????es decorrentes de uso normal do im??vel.\n					</li>\n					<li>\n						24) Assina tamb??m o presente contrato como FIADOR e PRINCIPAL PAGADOR, solidariamente com o LOCAT??RIO, por todas as obriga????es e responsabilidades constantes deste acordo com disposi????es dos artigos 827 e seguintes do Novo C??digo Civil Brasileiro, inclusive alugu??is vencidos, danos ao im??vel e demais encargos decorrentes da loca????o, (NOME) (CPF) (IDENTIDADE) (ENDERE??O), consoante o artigo 818 do Novo C??digo Civil Brasileiro, declarando expressamente, desistir da faculdade estabelecida nos artigos 835 e 838 e renunciando  ao benef??cio de ordem do artigo 827 do mesmo c??digo, perdurando sua responsabilidade at?? a entrega das chaves, inclusive em caso de prorroga????o.\n					</li>\n\n					<li>\n						25) Em caso de aus??ncia, interdi????o, recupera????o judicial, fal??ncia ou insolv??ncia do fiador, declaradas judicialmente, suas obriga????es se transferem aos seus herdeiros e/ou sucessores e o LOCAT??RIO se obriga, dentro de 30 (trinta) dias a dar substituto id??neo, a ju??zo do LOCADOR, ficando aquele em mora e sujeito ?? multa contratual e despejo, se n??o o fizer nesses dias de mera toler??ncia.\n					</li>\n\n					<li>\n						26) Elegem as partes o foro do domic??lio do LOCADOR, para dirimir quaisquer d??vidas oriundas do presente contrato, renunciando a qualquer outro por mais privilegiado que seja.\n					</li>\n\n				</ul>\n			</div>\n\n\n			<div class=\"mt-5\">\n				E por estarem LOCADOR e LOCAT??RIO de pleno acordo com o disposto neste instrumento particular, assinam-no na presen??a das duas testemunhas abaixo, em ....... vias de igual teor e forma, destinando-se uma via para cada uma das partes.\n\n			</div>\n			Local e Data:\n\n			<div class=\"row mt-5\">\n				<div class=\"col-md-6 text-center\">\n					________________________________\n					<p>\n						Wesley Vila Seca Sanches</p>\n				</div>\n\n				<div class=\"col-md-6 text-center\">\n					________________________________\n					<p>\n						Camila Oliveira</p>\n				</div>\n\n			</div>\n\n		</div>\n	</body>\n\n	<script type=\"text/javascript\">\n		window.print();\n		window.addEventListener(\"afterprint\", function(event) { window.close(); });\n		window.onafterprint();\n	</script>\n</html>\n','2022-03-08','2023-04-01',5.00,800.00,250.00,50.00,NULL,1);
/*!40000 ALTER TABLE `contrato_aluguel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faturas`
--

DROP TABLE IF EXISTS `faturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) DEFAULT NULL,
  `observacoes` longtext,
  `codFatura` varchar(45) DEFAULT NULL,
  `data_vencimento` date DEFAULT NULL,
  `valor_fatura` decimal(10,2) DEFAULT NULL,
  `valor_repasse` decimal(10,2) DEFAULT NULL,
  `valor_taxaadministrativa` decimal(10,2) DEFAULT NULL,
  `status_fatura` int(11) DEFAULT '0' COMMENT '0 - em aberto | 1 - pago',
  `parcela_concorrente` int(11) DEFAULT NULL,
  `status_repasse` int(11) DEFAULT NULL,
  `data_repasse` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_faturas_contrato_aluguel_idx` (`contrato_id`),
  CONSTRAINT `fk_faturas_contrato_aluguel` FOREIGN KEY (`contrato_id`) REFERENCES `contrato_aluguel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faturas`
--

LOCK TABLES `faturas` WRITE;
/*!40000 ALTER TABLE `faturas` DISABLE KEYS */;
INSERT INTO `faturas` VALUES (1,12,'','','2022-04-01',816.13,589.84,40.81,0,1,0,'2022-04-05'),(2,12,'','','2022-05-01',1100.00,795.00,55.00,0,2,0,'2022-05-05'),(3,12,'','','2022-06-01',1100.00,795.00,55.00,0,3,0,'2022-06-05'),(4,12,'','','2022-07-01',1100.00,795.00,55.00,0,4,0,'2022-07-05'),(5,12,'','','2022-08-01',1100.00,795.00,55.00,0,5,0,'2022-08-05'),(6,12,'','','2022-09-01',1100.00,795.00,55.00,0,6,0,'2022-09-05'),(7,12,'','','2022-10-01',1100.00,795.00,55.00,0,7,0,'2022-10-05'),(8,12,'','','2022-11-01',1100.00,795.00,55.00,0,8,0,'2022-11-05'),(9,12,'','','2022-12-01',1100.00,795.00,55.00,0,9,0,'2022-12-05'),(10,12,'','','2023-01-01',1100.00,795.00,55.00,0,10,0,'2023-01-05'),(11,12,'','','2023-02-01',1100.00,795.00,55.00,0,11,0,'2023-02-05'),(12,12,'','','2023-03-01',1100.00,795.00,55.00,0,12,0,'2023-03-05'),(13,12,'','','2023-04-01',1100.00,795.00,55.00,0,13,0,'2023-04-05');
/*!40000 ALTER TABLE `faturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imoveis`
--

DROP TABLE IF EXISTS `imoveis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imoveis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locador_id` int(11) DEFAULT NULL,
  `cep` varchar(45) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `numero` decimal(10,0) DEFAULT NULL,
  `bairro` varchar(200) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `complemento` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `status_imovel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_imoveis_locador1_idx` (`locador_id`),
  CONSTRAINT `fk_imoveis_locador1` FOREIGN KEY (`locador_id`) REFERENCES `locador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imoveis`
--

LOCK TABLES `imoveis` WRITE;
/*!40000 ALTER TABLE `imoveis` DISABLE KEYS */;
INSERT INTO `imoveis` VALUES (6,3,'66623-270','Passagem H-1',20,'Marambaia','PA','proximo a sn6',NULL,'Bel??m',1),(7,3,'68459-810','Travessa W-Nove',521,'COHAB','PA','Prox a Perimetral',NULL,'Tucuru??',1),(8,4,'66053-430','Alameda Maria Jos?? Nobre',10,'Reduto','PA','Pr??dio Ab??lio Velho AP 502',NULL,'Bel??m',1),(9,4,'66053-430','Alameda Maria Jos?? Nobre',20,'Reduto','PA','Pr??dio Ab??lio Velho AP 602',NULL,'Bel??m',1);
/*!40000 ALTER TABLE `imoveis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locador`
--

DROP TABLE IF EXISTS `locador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telefone` varchar(200) DEFAULT NULL,
  `data_repasse` int(11) DEFAULT NULL,
  `status_locador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locador`
--

LOCK TABLES `locador` WRITE;
/*!40000 ALTER TABLE `locador` DISABLE KEYS */;
INSERT INTO `locador` VALUES (3,'Wesley Vila Seca Sanches','wesley@mail.com','(91) 98820-3132',5,1),(4,'Jeremias Sanches','jeremias@mail.com','(91) 88888-8888',1,1);
/*!40000 ALTER TABLE `locador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locatario`
--

DROP TABLE IF EXISTS `locatario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locatario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telefone` varchar(200) NOT NULL,
  `status_locatario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locatario`
--

LOCK TABLES `locatario` WRITE;
/*!40000 ALTER TABLE `locatario` DISABLE KEYS */;
INSERT INTO `locatario` VALUES (9,'Camila Oliveira','camila@mail.com','(91) 98820-3131',1),(10,'Maria do Socorro Vila Seca','maria@mail.com','(91) 98888-8888',1),(11,'Lorem Valdo','lorem@mail.com','(91) 91919-1919',2);
/*!40000 ALTER TABLE `locatario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `enable` varchar(1) NOT NULL DEFAULT 'N',
  `enabled` varchar(1) DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'Wesley Sanches','wesley.vilaseca@hotmail.com','wesley','e10adc3949ba59abbe56e057f20f883e','S','S');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-09  0:21:27
