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
INSERT INTO `contrato_aluguel` VALUES (12,9,7,'<!DOCTYPE html>\n<html lang=\"pt-br\">\n	<head>\n		<meta charset=\"utf-8\">\n		<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n		<meta name=\"description\" content=\"sistemaphp\">\n\n		<link\n		rel=\"icon\" href=\"http://localhost/imobiliaria/assets/global/icons/icone.ico\" type=\"image/x-icon\">\n\n		<!--css sidebar-->\n		<link href=\"http://localhost/imobiliaria/assets/adm/css/all.css\" rel=\"stylesheet\">\n\n		<title></title>\n	</head>\n\n	<body>\n		<div class=\"container\">\n			<div class=\"text-center mt-5 mb-5\">\n				<b>LOCAÇÃO RESIDENCIAL</b>\n			</div>\n\n			<p>\n				Camila Oliveira,\n				(91) 98820-3131, doravante denominado LOCADOR;\n				Wesley Vila Seca Sanches,\n				(91) 98820-3132, Lorem Ipsum, doravante denominado LOCATÁRIO, celebram o presente contrato de locação residencial, com as cláusulas e condições seguintes:\n			</p>\n\n			<div class=\"\">\n				<ul>\n					<li>1)     O LOCADOR cede para locação residencial ao LOCATÁRIO, o imóvel situado\n						Travessa W-Nove, CEP\n						68459-810\n						nº\n						521, bairro\n						COHAB, cidade\n						Tucuruí, estado\n						PA.</li>\n\n					<li>2)     A locação destina-se ao uso exclusivo como residência e domicilio do LOCATÁRIO.</li>\n\n					<li>3)     O prazo de locação é de (12 meses), iniciando-se em\n						\n						e terminando em\n						, limite de tempo em que o imóvel objeto do presente deverá ser restituído independentemente de qualquer notificação ou interpelação sob pena de caracterizar infração contratual.</li>\n\n					<li>4)     O aluguel mensal será de R$\n						\n						e deverá ser pago até a data de seu vencimento, todo dia 1º do mês seguinte ao vencido, no local do endereço do LOCADOR ou outro que o mesma venha a designar.</li>\n\n					<div class=\"ms-2\">\n						<li>4.1) A impontualidade acarretará juros moratórios na base de 1% (um por cento) ao mês calculado sobre o valor do aluguel. O atraso superior a 30 (trinta) dias implicará em correção monetária do valor do aluguel e encargos de cobrança correspondentes a 10% (dez por cento) do valor assim corrigido.</li>\n\n						<li>\n							4.2) O pagamento de qualquer dos aluguéis não implica em renúncia do direito de cobrança de eventuais diferenças de aluguéis, de encargos ou impostos que oportunamente não tiverem sidos lançados nos respectivos recibos.\n						</li>\n					</div>\n\n					<li>\n						5)     O aluguel será reajustado anualmente pela variação do ...... (ÍNDICE, exemplo: IGP-M, INPC-IBGE, etc.). Entretanto, se em virtude de lei subsequente vier a ser admitida a correção e periodicidade inferior a prevista na legislação vigente à época de sua celebração, que é anual, concordam as partes desde já e em caráter irrevogável que a correção do aluguel e o seu indexador passará automaticamente a ser feito no menor prazo que for permitido pela lei posterior e pelo maior índice vigente dentre os permitidos pelo Governo Federal e que venha a refletir a variação do período.\n					</li>\n					<li>\n						6)     Havendo prorrogação tácita ou expressa do presente contrato o mesmo será reajustado a preço de mercado sem qualquer relação com o patamar aqui pactuado a ser estabelecido pelo LOCADOR, que poderá ainda estipular, de comum acordo com o LOCATÁRIO, o índice de reajuste e periodicidade.\n					</li>\n\n					<li>\n						7)     Nas cobranças judiciais e extrajudiciais de alugueis em atraso os mesmos serão acrescidos de juros de mora, atualização monetária e honorários advocatícios, na base de 20% ( vinte por cento ) sendo que qualquer recebimento feitos pela LOCADOR fora dos prazos e condições convencionais neste contrato, será havido como mera tolerância e não induzirá novação bem como resgate de recibos posteriores não significará quitação de aluguéis e outras obrigações contratuais deixadas de quitar nas épocas certas.\n					</li>\n					<li>\n						8)     O imóvel da presente locação destina-se ao uso exclusivo como residência e domicilio do LOCATÁRIO, conforme cláusula 2, não sendo permitida a transferência, sublocação, cessão ou empréstimo no todo ou em parte, sem a prévia e expressa autorização do LOCADOR.\n					</li>\n					<li>\n						9)     Além do aluguel são de responsabilidade do LOCATÁRIO as despesas com consumo de luz, água, esgoto, seguro contra incêndio, imposto predial e todas as demais taxas ou impostos, tributos municipais e encargos da locação, que venham a incidir sobre o imóvel, inclusive taxa de condomínio, que deverão ser pagas diretamente pela mesma, o qual ficará obrigada a apresentar os comprovantes de quitação juntamente com o pagamento do aluguel.\n					</li>\n					<li>\n						10) O LOCATÁRIO declara neste ato tomar conhecimento da existência de regras estabelecidas na CONVENÇÃO DE CONDOMÍNIOS e compromete-se a respeitá-las e cumpri-las, juntamente com seus familiares e prepostos, sob pena de rescisão contratual.\n					</li>\n\n					<li>\n						11) Encerrada a locação a entrega das chaves só será processada mediante exibição ao LOCADOR, dos comprovantes de quitação das despesas e encargos da locação referidos nas cláusulas anteriores, inclusive corte final de luz.\n					</li>\n					<li>\n						12) Fica facultado ao LOCADOR ou ao seu representante legal vistoriar o imóvel sempre que julgar necessário.\n					</li>\n					<li>\n						13) O LOCATÁRIO se obriga, sob pena de cometer infração contratual, a comunicar por escrito ao LOCADOR, com antecipação mínima de 30 (trinta) dias, a sua intenção de devolver o imóvel antes do prazo aqui previsto.\n					</li>\n					<li>\n						14) O LOCATÁRIO assume o compromisso de solicitar ao LOCADOR uma vistoria 30 (trinta) dias antes de desocupar o imóvel para ser constatado o estado de conservação do mesmo.\n					</li>\n					<li>\n						15) Quaisquer modificações no imóvel locadas só poderão ser feitas com expressa autorização do LOCADOR. Aderem ao mesmo as benfeitorias sejam elas úteis, necessárias ou voluntárias independente de sua natureza, não cabendo direito de indenização, retenção, compensação ou reembolso.\n					</li>\n					<li>\n						16) Se no curso da locação vier a ocorrer incêndio ou danos no prédio que demandem obras que impeçam o seu uso normal por mais de 30 (trinta) dias, falência ou insolvência do LOCATÁRIO, bem como desapropriação do imóvel, ficará rescindida de pleno direito a relação locatícia, sem qualquer direito de indenização ou retenção do objeto do presente contrato.\n					</li>\n					<li>\n						17) O LOCATÁRIO autoriza ao LOCADOR desde já, a proceder a sua citação inicial, interpelação, intimação, notificação, ou qualquer outro ato de comunicação processual mediante comunicação por e-mail, whatsapp ou outro formato eletrônico, afora as demais formas previstas em lei.\n					</li>\n\n					<li>\n						18) Fica convencionado que a parte que infringir o presente contrato em qualquer dos seus termos, se sujeita ao pagamento em benefício da outra, da multa contratual correspondente a 1 (uma) vez o valor do aluguel vigente à época da infração, tantas vezes forem as infrações praticadas, sem prejuízo da resolução contratual e demais comunicações previstas neste instrumento.\n					</li>\n					<li>\n						19) Se o LOCATÁRIO vier a usar da faculdade que lhe confere o contido no artigo 4º da Lei n º 8.245/1991 e devolver o imóvel antes do vencimento do prazo ajustado, pagará a multa compensatória equivalente a 02 (duas) vezes o valor do aluguel vigente, reduzido proporcionalmente ao tempo do contrato já cumprido.\n					</li>\n					<li>\n						20) Salvo declaração escrita do LOCADOR, quaisquer tolerância ou concessões por ela feita não implicam em renúncia de direito ou em alteração contratual, não podendo ser invocada pelo LOCATÁRIO como procedente para se furtar ao cumprimento do contrato.\n					</li>\n					<li>\n						21) Permanecendo o LOCATÁRIO no imóvel após o prazo de desocupação voluntária nos casos de denúncia condicionada, pagará ele o aluguel pena que vier a ser arbitrado na notificação premonitória na forma de que dispõe o artigo 575 do Novo Código Civil Brasileiro, o mesmo ocorrendo no caso de mútuo acordo nos termos do artigo 9, inciso I da Lei n º 8.245/1991, quando a desocupação não se verificar na data convencionada.\n					</li>\n					<li>\n						22) No caso do imóvel ser posto à venda, o LOCATÁRIO declara que não possui interesse em sua aquisição, renunciando expressamente ao eventual direito de preferência e autoriza desde já, a visita de interessados, em horários previamente convencionados.\n					</li>\n					<li>\n						23) O LOCATÁRIO declara, para todos os fins e efeitos de direito, que recebe o imóvel locado em condições plenas de uso, em perfeito estado de conservação, higiene e limpeza, obrigando-se e comprometendo-se a devolvê-lo em iguais condições, independente de qualquer aviso ou notificação prévia, e qualquer que seja o motivo da devolução, sob pena de incorrer nas cominações previstas neste contrato ou estipuladas em lei, além da obrigação de indenizar por danos ou prejuízos decorrentes da inobservância desta obrigação, salvo as deteriorações decorrentes de uso normal do imóvel.\n					</li>\n					<li>\n						24) Assina também o presente contrato como FIADOR e PRINCIPAL PAGADOR, solidariamente com o LOCATÁRIO, por todas as obrigações e responsabilidades constantes deste acordo com disposições dos artigos 827 e seguintes do Novo Código Civil Brasileiro, inclusive aluguéis vencidos, danos ao imóvel e demais encargos decorrentes da locação, (NOME) (CPF) (IDENTIDADE) (ENDEREÇO), consoante o artigo 818 do Novo Código Civil Brasileiro, declarando expressamente, desistir da faculdade estabelecida nos artigos 835 e 838 e renunciando  ao benefício de ordem do artigo 827 do mesmo código, perdurando sua responsabilidade até a entrega das chaves, inclusive em caso de prorrogação.\n					</li>\n\n					<li>\n						25) Em caso de ausência, interdição, recuperação judicial, falência ou insolvência do fiador, declaradas judicialmente, suas obrigações se transferem aos seus herdeiros e/ou sucessores e o LOCATÁRIO se obriga, dentro de 30 (trinta) dias a dar substituto idôneo, a juízo do LOCADOR, ficando aquele em mora e sujeito à multa contratual e despejo, se não o fizer nesses dias de mera tolerância.\n					</li>\n\n					<li>\n						26) Elegem as partes o foro do domicílio do LOCADOR, para dirimir quaisquer dúvidas oriundas do presente contrato, renunciando a qualquer outro por mais privilegiado que seja.\n					</li>\n\n				</ul>\n			</div>\n\n\n			<div class=\"mt-5\">\n				E por estarem LOCADOR e LOCATÁRIO de pleno acordo com o disposto neste instrumento particular, assinam-no na presença das duas testemunhas abaixo, em ....... vias de igual teor e forma, destinando-se uma via para cada uma das partes.\n\n			</div>\n			Local e Data:\n\n			<div class=\"row mt-5\">\n				<div class=\"col-md-6 text-center\">\n					________________________________\n					<p>\n						Wesley Vila Seca Sanches</p>\n				</div>\n\n				<div class=\"col-md-6 text-center\">\n					________________________________\n					<p>\n						Camila Oliveira</p>\n				</div>\n\n			</div>\n\n		</div>\n	</body>\n\n	<script type=\"text/javascript\">\n		window.print();\n		window.addEventListener(\"afterprint\", function(event) { window.close(); });\n		window.onafterprint();\n	</script>\n</html>\n','2022-03-08','2023-04-01',5.00,800.00,250.00,50.00,NULL,1);
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
INSERT INTO `imoveis` VALUES (6,3,'66623-270','Passagem H-1',20,'Marambaia','PA','proximo a sn6',NULL,'Belém',1),(7,3,'68459-810','Travessa W-Nove',521,'COHAB','PA','Prox a Perimetral',NULL,'Tucuruí',1),(8,4,'66053-430','Alameda Maria José Nobre',10,'Reduto','PA','Prédio Abílio Velho AP 502',NULL,'Belém',1),(9,4,'66053-430','Alameda Maria José Nobre',20,'Reduto','PA','Prédio Abílio Velho AP 602',NULL,'Belém',1);
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
