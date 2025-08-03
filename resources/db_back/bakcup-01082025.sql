-- MySQL dump 10.13  Distrib 8.0.41, for Linux (x86_64)
--
-- Host: localhost    Database: Personnels
-- ------------------------------------------------------
-- Server version	8.0.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `absences`
--

DROP TABLE IF EXISTS `absences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `absences` (
  `id_abs` int NOT NULL AUTO_INCREMENT,
  `date_abs` date NOT NULL,
  `heure_abs` time NOT NULL,
  `statut` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `statut_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_nin` decimal(18,0) NOT NULL,
  `id_p` bigint NOT NULL,
  `id_sous_depart` int NOT NULL,
  `id_fichier` int NOT NULL,
  PRIMARY KEY (`id_abs`),
  UNIQUE KEY `absences_id_nin_unique` (`id_nin`),
  KEY `absences_id_sous_depart_foreign` (`id_sous_depart`),
  KEY `absences_id_p_foreign` (`id_p`),
  KEY `absences_id_fichier_foreign` (`id_fichier`),
  CONSTRAINT `absences_id_fichier_foreign` FOREIGN KEY (`id_fichier`) REFERENCES `fichiers` (`id_fichier`),
  CONSTRAINT `absences_id_nin_foreign` FOREIGN KEY (`id_nin`) REFERENCES `employes` (`id_nin`),
  CONSTRAINT `absences_id_p_foreign` FOREIGN KEY (`id_p`) REFERENCES `employes` (`id_p`),
  CONSTRAINT `absences_id_sous_depart_foreign` FOREIGN KEY (`id_sous_depart`) REFERENCES `sous_departements` (`id_sous_depart`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absences`
--

LOCK TABLES `absences` WRITE;
/*!40000 ALTER TABLE `absences` DISABLE KEYS */;
/*!40000 ALTER TABLE `absences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appartients`
--

DROP TABLE IF EXISTS `appartients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appartients` (
  `id_appar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Date_op` date NOT NULL,
  `id_niv` int NOT NULL,
  `id_nin` decimal(18,0) NOT NULL,
  `id_p` bigint NOT NULL,
  PRIMARY KEY (`id_appar`),
  UNIQUE KEY `appartients_id_nin_unique` (`id_nin`),
  KEY `appartients_id_niv_foreign` (`id_niv`),
  KEY `appartients_id_p_foreign` (`id_p`),
  CONSTRAINT `appartients_id_nin_foreign` FOREIGN KEY (`id_nin`) REFERENCES `employes` (`id_nin`),
  CONSTRAINT `appartients_id_niv_foreign` FOREIGN KEY (`id_niv`) REFERENCES `niveaux` (`id_niv`),
  CONSTRAINT `appartients_id_p_foreign` FOREIGN KEY (`id_p`) REFERENCES `employes` (`id_p`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appartients`
--

LOCK TABLES `appartients` WRITE;
/*!40000 ALTER TABLE `appartients` DISABLE KEYS */;
INSERT INTO `appartients` VALUES ('1','2023-07-11',1,1254953,123),('10/1685','2010-10-31',34,119591165001560006,781304004160),('116/512','2018-07-01',57,119940284017170004,941717001949),('15','2024-03-13',2,254896989,256),('15/35/91/253','1994-11-19',34,119700593006640002,700664003454),('2010/1075','2010-06-29',34,119870581018230008,871823004844),('2012/02','1986-06-30',60,119660542001980002,660198019135),('29155','2021-10-21',56,110000586005440008,544007564),('2988','2009-02-18',58,119780579015490003,781549004541),('4336/3','1990-01-01',51,119830252019950006,831995004138),('null','1990-01-01',51,109790646005040001,790504006155);
/*!40000 ALTER TABLE `appartients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bureaus`
--

DROP TABLE IF EXISTS `bureaus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bureaus` (
  `id_bureau` int NOT NULL AUTO_INCREMENT,
  `Num_bureau` int NOT NULL,
  PRIMARY KEY (`id_bureau`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bureaus`
--

LOCK TABLES `bureaus` WRITE;
/*!40000 ALTER TABLE `bureaus` DISABLE KEYS */;
INSERT INTO `bureaus` VALUES (5,203),(6,206);
/*!40000 ALTER TABLE `bureaus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conges`
--

DROP TABLE IF EXISTS `conges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conges` (
  `id_cong` int NOT NULL AUTO_INCREMENT,
  `date_debut_cong` date NOT NULL,
  `date_fin_cong` date NOT NULL,
  `situation` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nbr_jours` int NOT NULL,
  `situation_AR` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ref_cong` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_nin` decimal(18,0) NOT NULL,
  `id_sous_depart` int NOT NULL,
  `id_p` bigint NOT NULL,
  `id_fichier` int NOT NULL DEFAULT '1',
  `ref_cng` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_cong`),
  UNIQUE KEY `conges_id_nin_unique` (`id_nin`),
  KEY `conges_id_p_foreign` (`id_p`),
  KEY `conges_ref_cong_foreign` (`ref_cong`),
  KEY `conges_id_sous_depart_foreign` (`id_sous_depart`),
  KEY `conges_id_fichier_foreign` (`id_fichier`),
  CONSTRAINT `conges_id_fichier_foreign` FOREIGN KEY (`id_fichier`) REFERENCES `fichiers` (`id_fichier`),
  CONSTRAINT `conges_id_nin_foreign` FOREIGN KEY (`id_nin`) REFERENCES `employes` (`id_nin`),
  CONSTRAINT `conges_id_p_foreign` FOREIGN KEY (`id_p`) REFERENCES `employes` (`id_p`),
  CONSTRAINT `conges_id_sous_depart_foreign` FOREIGN KEY (`id_sous_depart`) REFERENCES `sous_departements` (`id_sous_depart`),
  CONSTRAINT `conges_ref_cong_foreign` FOREIGN KEY (`ref_cong`) REFERENCES `type_congs` (`ref_cong`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conges`
--

LOCK TABLES `conges` WRITE;
/*!40000 ALTER TABLE `conges` DISABLE KEYS */;
INSERT INTO `conges` VALUES (1,'2024-10-22','2024-10-30','algérie',10,'داخل الجزائر','RF001',1254953,15,123,2,NULL);
/*!40000 ALTER TABLE `conges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contients`
--

DROP TABLE IF EXISTS `contients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contients` (
  `id_contient` int NOT NULL AUTO_INCREMENT,
  `id_post` int NOT NULL,
  `id_postsup` int DEFAULT NULL,
  `id_fonction` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id_sous_depart` int NOT NULL,
  PRIMARY KEY (`id_contient`),
  KEY `contients_id_postsup_foreign` (`id_postsup`),
  KEY `contients_id_fonction_foreign` (`id_fonction`),
  KEY `contients_id_post_foreign` (`id_post`),
  KEY `contients_id_sous_depart_foreign` (`id_sous_depart`),
  CONSTRAINT `contients_id_fonction_foreign` FOREIGN KEY (`id_fonction`) REFERENCES `fonctions` (`id_fonction`),
  CONSTRAINT `contients_id_postsup_foreign` FOREIGN KEY (`id_postsup`) REFERENCES `post_sups` (`id_postsup`),
  CONSTRAINT `contients_id_sous_depart_foreign` FOREIGN KEY (`id_sous_depart`) REFERENCES `sous_departements` (`id_sous_depart`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contients`
--

LOCK TABLES `contients` WRITE;
/*!40000 ALTER TABLE `contients` DISABLE KEYS */;
INSERT INTO `contients` VALUES (2,20,NULL,NULL,10),(3,20,NULL,NULL,15),(10,2,NULL,NULL,10),(50,2,NULL,NULL,15),(54,22,NULL,NULL,10),(55,21,NULL,NULL,10),(56,35,NULL,NULL,19),(57,20,NULL,NULL,18),(58,44,NULL,NULL,16),(59,28,NULL,NULL,16),(60,50,NULL,NULL,15);
/*!40000 ALTER TABLE `contients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departements`
--

DROP TABLE IF EXISTS `departements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departements` (
  `id_depart` int NOT NULL AUTO_INCREMENT,
  `Nom_depart` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Descriptif_depart` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nom_depart_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Descriptif_depart_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_depart`),
  UNIQUE KEY `departements_nom_depart_unique` (`Nom_depart`),
  UNIQUE KEY `departements_descriptif_depart_unique` (`Descriptif_depart`),
  UNIQUE KEY `departements_nom_depart_ar_unique` (`Nom_depart_ar`),
  UNIQUE KEY `departements_descriptif_depart_ar_unique` (`Descriptif_depart_ar`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departements`
--

LOCK TABLES `departements` WRITE;
/*!40000 ALTER TABLE `departements` DISABLE KEYS */;
INSERT INTO `departements` VALUES (1,'Développement et de l\'Investissement','Dev','التطوير','م.ف.ت'),(2,'Administration et des Moyens','Administration et des Moyens','الإدارة والوسائل ','الإدارة والوسائل'),(3,'La Coopération et de la Formation','La Coopération et de la Formation','التعاون  والتكوين ','التعاون  والتكوين'),(4,'La Communication Institutionnelle','La Communication Institutionnelle','الاتصال المؤسساتي','الاتصال المؤسساتي'),(5,'Affaires Juridiques, de la Documentation et des Archives','Affaires Juridiques, de la Documentation et des Archives','الشؤون  القانونية  والتوثيق  والأرشيف','الشؤون  القانونية  والتوثيق  والأرشيف'),(6,'Médias','Médias',' وسائل  الإعلام',' وسائل  الإعلام');
/*!40000 ALTER TABLE `departements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dossiers`
--

DROP TABLE IF EXISTS `dossiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dossiers` (
  `ref_Dossier` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'IN',
  PRIMARY KEY (`ref_Dossier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dossiers`
--

LOCK TABLES `dossiers` WRITE;
/*!40000 ALTER TABLE `dossiers` DISABLE KEYS */;
INSERT INTO `dossiers` VALUES ('Em_109790646005040001','IN'),('Em_119700593006640002','IN'),('Em_119830252019950006','IN'),('Em_119870581018230008','IN'),('Em_119940284017170004','IN');
/*!40000 ALTER TABLE `dossiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employes`
--

DROP TABLE IF EXISTS `employes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employes` (
  `id_emp` int NOT NULL AUTO_INCREMENT,
  `id_nin` decimal(18,0) NOT NULL,
  `id_p` bigint NOT NULL,
  `NSS` bigint NOT NULL,
  `Nom_emp` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Prenom_emp` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nom_ar_emp` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Prenom_ar_emp` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Date_nais` date NOT NULL,
  `Lieu_nais` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Lieu_nais_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `adress_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom_pere` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom_mere` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nom_mere` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom_pere_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom_mere_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nom_mere_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Date_nais_pere` date NOT NULL,
  `Date_nais_mere` date NOT NULL,
  `situation_familliale` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `situation_familliale_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nbr_enfants` int NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email_pro` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `Phone_num` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_emp`),
  UNIQUE KEY `employes_id_nin_unique` (`id_nin`),
  UNIQUE KEY `employes_id_p_unique` (`id_p`),
  UNIQUE KEY `employes_nss_unique` (`NSS`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employes`
--

LOCK TABLES `employes` WRITE;
/*!40000 ALTER TABLE `employes` DISABLE KEYS */;
INSERT INTO `employes` VALUES (1,1254953,123,18505482,'mohamed','mohamed','محمد','محمد','2000-01-11','alger','الجزائر','alger','الجزائر','moh','fff','be','محمد','ف','ب','1975-08-31','1978-01-21','Célibataire','أعزب/عزباء',0,'Homme','fagmail.com','s@gmail.com','0124367555'),(2,254896989,256,25686984,'yacine','yacine','ياسين','ياسين','2024-07-01','alger','الجزائر','alger','الجزائر','moh','fff','be','محمد','ف','ب','1975-08-31','1978-01-21','Marié(e)','(ة)متزوج',0,'Homme','fgmail.com','ss@gmail.com','01573645525'),(3,109790646005040001,790504006155,790504006154,'ALANE','Abdelkader','عبد القادر','علان','1979-04-19','DJELFA','الجلفة','BP 347 AIN OUSSARA, DJELFA','مكتب بريد 347 عين وسارة-الجلفة','Mohamed','Khadija','Khatouf','محمد','خديجة','خطوف','1990-06-02','1999-06-02','Marié(e)','متزوج(ة)',0,'Homme',NULL,NULL,'NaN'),(4,119591165001560006,781304004160,781304004159,'AICHOUN','LOUBNA','لبنى','عيشون','1978-12-12','ALGER','الجزائر','n 05 CITE ISTANBUL, BORDJ-ELKIFFAN, ALGER','رقم 05حي اسطنبول، برج الكيفان، الجزائر','AHMED','LWARD','REZIG','أحمد','الورد','رزيق','1990-06-02','1999-06-02','Marié(e)','متزوج(ة)',0,'Femme',NULL,NULL,'NaN'),(5,119870581018230008,871823004844,871823004843,'menni','MOHAMED','محمد','مني','1987-05-19','alger','الجزائر','cite 1432 logmt beni abdi bt 46 n02 khracia alger','حي 1432 مسكن بني عبدي عمارة 46 رقم 02 خرايسية-الجزائر','ahmed','aicha','guettai','Ahmed','عائشة','قطاي','1990-06-02','1999-06-02','Célibataire','أعزب/عزباء',0,'Homme',NULL,NULL,'NaN'),(6,109460887028730002,770174017342,770174017341,'BOUCELLOUA','FADILA','فضيلة','بوصلوعة','1977-03-19','bouira','البويرة','cite 109 logmt bt 12 n05 heraoua-alger','حي 109 مسكن عمارة 12 رقم 05 هراوة-الجزائر','Rabie','حيدر','Fatma','null','فاطمة','Hider','1990-06-02','1999-06-02','Marié(e)','متزوج(ة)',0,'Femme',NULL,NULL,'NaN'),(7,119780586013040003,646026888260,646026888259,'BAHAMID','YACINE','ياسين','باحميد','1964-07-05','alger','الجزائر','66cite fernane hanafi bt 01H k kouba-alger','66 حي فرنان حنافي عمارة 01 ح القبة-الجزائر','Mohamed','Khedouja','Benaddache','null','خدوجة','بن عداش','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Homme',NULL,NULL,NULL),(8,119760580000790005,793256000845,793256000844,'SAIDI','Mohamed','محمد','سعيدي','1979-08-02','alger','الجزائر','cite 3 caves rue n28 lot 11 el harrach','حي 03 دهاليز شارع رقم 28  قطعة 11 الحراش-الجزائر','Gataf','Mira','Laribi','قطاف','ميرة','قطاف','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Homme',NULL,NULL,NULL),(9,119770554051100008,720106002469,720106002468,'Khobizi','Mohamed','محمد','خبيزي','1972-04-03','alger','الجزائر','cite bentelha n07 beraki-Alger','حي بن طلحة رقم 07 براقي-الجزائر','Ali','Dahbia','Khobizi','علي','ذهبية','خبيزي','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Homme',NULL,NULL,NULL),(10,119911017009620006,910962007935,910962007934,'BENREKTA','FATIMA ZAHRA','فاطمة الزهراء','بن رقطة','1991-04-30','m\'sila','المسيلة','cite el merdja 02 n61 beraki-Alger','حي المرجة 02 رقم 61 براقي-الجزائر','Ahmed','Aiychouche','Benrekta','أحمد','عيشوش','بن رقطة','1990-01-01','1990-01-01','Célibataire','أعزب/عزباء',0,'Homme',NULL,NULL,NULL),(11,109970958005910009,970591009528,970591009527,'KERRICHE','ABOUBAKRE','أبو بكر','كريش','1997-09-08','medea','المدية','173cite mono birkhadem-Alger','173 حي السلام مونو بئر خادم-الجزائر','Ahmed','Fatiha','Djmeai','أحمد','فتيحة','جمعي','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Homme',NULL,NULL,NULL),(12,109940064011530001,941153006149,941153006148,'GHOZLANE','MOHAMED RIADH','محمد رياض','غزلان','1994-05-07','Laghouat','HgY.H%','CITE AIN ALLAH N 7 DELY BRAHIM-ALGER','حي عين الله عمارة 217 رقم 7 دالي براهيم-الجزائر','Abdelkader','mebarka','kouidri','عبد القادر','مباركة','قويدري','1990-01-01','1990-01-01','Célibataire','أعزب/عزباء',0,'Homme',NULL,NULL,NULL),(13,119700593006640002,700664003454,700664003453,'kana','malika','مليكة','كانة','1970-03-26','alger','الجزائر','05djenane sfari bt 593 birkhadem-Alger','05 جنان سفاري عمارة 593 بئر خادم-الجزائر','AMAR','TASSADIT','KANA','null','تسعديت','كانة','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Femme',NULL,NULL,NULL),(14,119840392022230004,842223004155,842223004154,'BOUTELDJI','AMINA','أمينة','بوثلجي','1984-12-15','Bouira','البويرة','cite 100 logmt soursour el ghozlane-Bouira','حي 100 مسكن سور الغزلان-البويرة','Mohamed','mebarka','Reouibi','محمد','مباركة','رويبي','1990-01-01','1990-01-01','Célibataire','أعزب/عزباء',0,'Femme',NULL,NULL,NULL),(15,109810549000980008,810098021251,810098021250,'KHERADOUCHE','MAPALIA','مبالية','خرادوش','1981-01-20','TIZI-OUZOU','تيزي وزو','n 05 CITE ISTANBUL, BORDJ-ELKIFFAN, ALGER','صوامع-تيزي وزو','LOUNES','LKAB Chabha','KHERADOUCHE','الوناس','كاب شابحة','خرادوش','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Homme',NULL,NULL,NULL),(16,109710583000820006,751815001054,751815001053,'MENGHOUR','Djamel','جمال','منغور','1975-05-22','alger','الجزائر','cite belle vue bt 02 D n05 kouba-Alger','حي المنظر الجميل عمارة 02 د رقم 05 القبة-الجزائر','null','Halima','Garmouti','null','حليمة','قرموطي','1990-01-01','1990-01-01','null','null',0,'Homme',NULL,NULL,NULL),(17,119830580039900001,833990002539,833990002538,'BENSASSI','HABIBA','حبيبة','بن ساسي','1983-05-28','alger','الجزائر','cite 108 bt d08 n02 ain naadja-alger','حي 108 عمارة د08 رقم 02 عين النعجة-الجزائر','Abdelwahab','Rebiha','Chabah','عبد الوهاب','ربيحة','شابح','1990-01-01','1990-01-01','Célibataire','أعزب/عزباء',0,'Femme',NULL,NULL,NULL),(18,119830252019950006,831995004138,831995004137,'BENADEL','HALIMA','حليمة','بن عدل','1983-12-12','biskra','بسكرة','cite 1046 logmt douara-Alger','حي 1046 مسكن دويرة-الجزائر','Djemouaii','zahra','Ben Mejadelle','جموعي','الزهرة','بن مجدل','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Femme',NULL,NULL,NULL),(19,110000586005440008,544007564,544007563,'BOUZEKRI','HANANE','حنان','بوزكري','2000-07-08','Alger','الجزائر','Cite sidi idriss bourdj el kifan-alger','حي سيدي ادريس برج الكيفان-الجزائر','Mohamed','Rokia','Nezzar','محمد','رقية','نزار','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Femme',NULL,NULL,NULL),(20,119940284017170004,941717001949,941717001948,'SIDI YEKHLEF','AYOUB','أيوب','سيدي يخلف','1994-03-28','BLIDA','البليدة','null','حي دريوش رقم 50 بوعرفة، البليدة','RABEH','FATMA ZOHRA','ELHOUARI','رابح','فاطمة الزهراء','الهواري','1990-01-01','1990-01-01','Célibataire','أعزب/عزباء',0,'Homme',NULL,NULL,NULL),(21,119780579015490003,781549004541,781549004540,'Chouikhi','Rahima','رحيمة','شويخي','1978-04-19','Alger','الجزائر','null','حي الياس دريش ع 03 رقم 12 المدنية-الجزائر','Sayah','zahra','Serbah','السايح','الزهرة','سرباح','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Femme',NULL,NULL,NULL),(22,109730554036090001,733609000854,733609000853,'Bellatreche','Rafik Ahmed','رفيق أحمد','بلطرش','1973-08-31','alger','الجزائر','null','59قطعة الرمال الحمراء الأبيار-الجزائر','Belkhalfa','Malika','Ben elhadj','بلخلفة','مليكة','بن الحاج جلول','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Homme',NULL,NULL,NULL),(23,119760563004340000,760434015847,760434015846,'BEDDA ZEKRI','ANISSA','أنيسة','بدة زكري','1976-10-20','ALGER','الجزائر','null','حي لاكنكورد عمارة أ رقم 06 بئر مراد رايس، الجزائر','BACHIR','FATMA','SEMAMA','بشير','فاطمة','صمامة','1990-01-01','1990-01-01','Célibataire','أعزب/عزباء',0,'Femme',NULL,NULL,NULL),(24,119660542001980002,660198019135,660198019134,'OUADAH','ZAHIA','زهية','واضح','1966-03-20','tizi ouzou','تيزي وزو','null','حي العناصر عمارة 809 رقم 02 القبة-الجزائر','Mohamed Sghir','khadidja','Rahmaoui','محمد الصغير','خديجة','رحماوي','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Femme',NULL,NULL,NULL),(25,119760581007120006,760712000267,760712000266,'ALILI','Nabila','نبيلة','عليلي','1976-10-20','ALGER','الجزائر','null','حي 488 مسكن عمارة 27 رقم 08، باش جراح، الجزائر','ABDELKADER','FATIHA','ZERROUKI','عبد القادر','فتيحة','زروقي','1990-01-01','1990-01-01','Célibataire','أعزب/عزباء',0,'Femme',NULL,NULL,NULL),(26,109810580035800002,813580003347,813580003346,'Alili','Gharib','غريب','عليلي','1981-06-16','ALGER','الجزائر','null','حي 488 مسكن عمارة 27 رقم 08، باش جراح، الجزائر','ABDELKADER','FATIHA','ZERROUKI','عبد القادر','فتيحة','زروقي','1990-01-01','1990-01-01','Célibataire','أعزب/عزباء',0,'null',NULL,NULL,NULL),(27,119880596017960006,881796004035,881796004034,'Debbache','Souhila','سهيلة','دباش','1988-09-24','alger','الجزائر','null','16 شارع الإخوة مهدي السويدانية-الجزائر','Mohamed','El alya','Asla','محمد','العالية','عسلة','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Femme',NULL,NULL,NULL),(28,109780569010190006,781019009344,781019009343,'ZAKARI','AROUA','عروة','زكاري','1978-10-06','ALGER','الجزائر','null','10 شارع فيفيان الأبيار','MOHAMED','NAIMA','BOUCHAMA','محمد','نعيمة','بوشامة','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Homme',NULL,NULL,NULL),(29,119690579006730002,690673006737,690673006736,'ATMANI','SABRINA','صبرينة','عثماني','1969-02-15','ALGER','الجزائر','null','حي المنزه، عمارة أ رقم 1 سيدي عبد الله، زرالدة، الجزائر','MOHAMED','FATIMA','HMIDI','محمد','فطيمة','حميدي','1990-01-01','1990-01-01','Veuf(ve)','ارمل(ة)',0,'Femme',NULL,NULL,NULL),(30,119730569004170006,731417001561,731417001560,'BELACEL','RABEAA','ربيعة','بلعسل','1973-03-26','ALGER','الجزائر','null','5 شارع نورماندي الحمادية، بوزريعة، الجزائر','MOHAMED','BAYA','DJAMIL','محمد','باية','جميل','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Femme',NULL,NULL,NULL),(31,119780554053970000,785397000832,785397000831,'BELKHEIR','SOUMIA','سمية','بلخير','1978-12-03','ALGER','الجزائر','null','رقم 9أ حي بن غازي، براقي، الجزائر','MOHAMED','MOKHTARI','MESSAOUDA','أحمد','مسعودة','مختاري','1990-01-01','1990-01-01','Célibataire','أعزب/عزباء',0,'Femme',NULL,NULL,NULL),(32,119800555019130007,801913003458,801913003457,'BELKHELFA','BELKHELFA','وداد','بلخلفة','1980-12-15','ALGER','الجزائر','null','2 سعيد حماني، محمد بلوزداد، الجزائر','TAIEB','ZOUBIDA','BELKHELFA','طيب','زبيدة','بلخلفة','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Femme',NULL,NULL,NULL),(33,119820581045990004,824599000537,824599000536,'BELKHIR','CHAHEIRA','شهيرة','بلخير','1982-10-10','ALGER','الجزائر','null','تعاونية النصر، قطعة رقم 8، الصفصافة، جسر قسنطينة، الجزائر','KAMEL','GHALIA','TOUNSI','كمال','غالية','تونسي','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Femme',NULL,NULL,NULL),(34,119860557006760009,860676006733,860676006732,'BELKHODJA','FERIEL SIHEM','فريال سهام','بلخوجة','1986-07-29','ALGER','الجزائر','null','25 شارع سماعيل بن حرتي المدنية الجزائر','TAIEB','DJAMILA','DHRIFI','لخضر','جميلة','ظريفي','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Femme',NULL,NULL,NULL);
/*!40000 ALTER TABLE `employes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id_feedback` int NOT NULL AUTO_INCREMENT,
  `type_feedback` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Descriptif_feedback` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type_feedback_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Descriptif_feedback_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_nin` decimal(18,0) NOT NULL,
  `id_p` bigint NOT NULL,
  `id_post` int NOT NULL,
  PRIMARY KEY (`id_feedback`),
  UNIQUE KEY `feedback_id_nin_unique` (`id_nin`),
  KEY `feedback_id_p_foreign` (`id_p`),
  KEY `feedback_id_post_foreign` (`id_post`),
  CONSTRAINT `feedback_id_nin_foreign` FOREIGN KEY (`id_nin`) REFERENCES `employes` (`id_nin`),
  CONSTRAINT `feedback_id_p_foreign` FOREIGN KEY (`id_p`) REFERENCES `employes` (`id_p`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fichiers`
--

DROP TABLE IF EXISTS `fichiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fichiers` (
  `id_fichier` int NOT NULL AUTO_INCREMENT,
  `nom_fichier` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `hash_fichier` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `taille_fichier` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type_fichier` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_cree_fichier` date NOT NULL,
  PRIMARY KEY (`id_fichier`),
  UNIQUE KEY `fichiers_hash_fichier_unique` (`hash_fichier`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fichiers`
--

LOCK TABLES `fichiers` WRITE;
/*!40000 ALTER TABLE `fichiers` DISABLE KEYS */;
INSERT INTO `fichiers` VALUES (2,'fff','fff','20','img','2024-01-11'),(3,'ggg','ggggg','20','img','2024-08-11'),(4,'aichoun.pdf','auOnqKl427lLzmkPg2T7MSJMR0R3CP1vKaBZps9Z.pdf','656.86 KB','pdf','2025-07-29'),(5,'aichoun.pdf','ehTO8D7R60DPrWYJtjxu9UG9joOOM6YfUamx2hNR.pdf','656.86 KB','pdf','2025-07-29'),(6,'aichoun.pdf','tor8zMGKc2ddsZxdbtzjN0cscVMJCPNOqCsf4BZn.pdf','656.86 KB','pdf','2025-07-29'),(7,'aichoun.pdf','N9MCgb3AnDCwjsMeLSX6Hqa8J8Q7kFFH5ovEpNYt.pdf','656.86 KB','pdf','2025-07-29'),(8,'شهادة نجاح ليسانس علوم إقتصادية.pdf','DnGvEy1R6Cz11GLORW0sHf4l8ta9MtJFDnMUNhLp.pdf','357.52 KB','pdf','2025-07-31'),(9,'مقرر تتعيين.pdf','WgJQeloMqdnTS0pCF8Rmmi9ltNikujdavLsiAL7T.pdf','488.71 KB','pdf','2025-07-31'),(10,'شهادة الكفاءة المهنية.pdf','QH5X9I7ed2NFl8duwX7TiuZA9ZvTr8sUyYHRZkBl.pdf','628.53 KB','pdf','2025-07-31'),(11,'شهادة ماستر.pdf','sM5morgVSsqhpmFtrkCknlHQ84vCamV8Y0IDt8HG.pdf','813.86 KB','pdf','2025-07-31'),(12,'شهادة ماستر.pdf','95Lcxxr0IcnL6AMH1cjFPyLISj87xT2wc8wFXTGi.pdf','896.07 KB','pdf','2025-07-31'),(13,'شهادة ماستر.pdf','1efHOwVu4ghKPeIz4NqktshIRpMKt0qCM3we9z7h.pdf','813.86 KB','pdf','2025-07-31');
/*!40000 ALTER TABLE `fichiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filieres`
--

DROP TABLE IF EXISTS `filieres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filieres` (
  `id_filiere` int NOT NULL AUTO_INCREMENT,
  `Nom_filiere` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nom_filiere_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_filiere`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filieres`
--

LOCK TABLES `filieres` WRITE;
/*!40000 ALTER TABLE `filieres` DISABLE KEYS */;
INSERT INTO `filieres` VALUES (1,'informatique','الاعلام الالي'),(2,'statistique','الاحصاء'),(3,'Administration générale','الإدارة العامة'),(4,'Administration générale','الإدارة العامة'),(5,'Administration générale','الإدارة العامة'),(6,'Administration générale','الإدارة العامة'),(7,'Administration général','الإدارة العامة'),(8,'Administration générale','الإدارة العامة'),(9,'Administration générale','الإدارة العامة'),(10,'Administration générale','الإدارة العامة'),(11,'Administration générale','الإدارة العامة'),(12,'Administration générale','الإدارة العامة'),(13,'Administration générale','الإدارة العامة'),(14,'Administration générale','الإدارة العامة'),(15,'Administration générale','الإدارة العامة'),(16,'Administration générale','الإدارة العامة'),(17,'Administration générale','الإدارة العامة'),(18,'Traduction - interprétariat','الترجمة - الترجمة الفورية'),(19,'Traduction - interprétariat','الترجمة - الترجمة الفورية'),(20,'Traduction - interprétariat','الترجمة - الترجمة الفورية'),(21,'informatique','الإعلام الآلي'),(22,'informatique','الإعلام الآلي'),(23,'informatique','الإعلام الآلي'),(24,'informatique','الإعلام الآلي'),(25,'informatique','الإعلام الآلي'),(26,'informatique','الإعلام الآلي'),(27,'informatique','الإعلام الآلي'),(28,'informatique','الإعلام الآلي'),(29,'statistiques','الإحصائيات'),(30,'statistiques','الإحصائيات'),(31,'statistiques','الإحصائيات'),(32,'statistiques','الإحصائيات'),(33,'statistiques','الإحصائيات'),(34,'statistiques','الإحصائيات'),(35,'statistiques','الإحصائيات'),(36,'statistiques','الإحصائيات'),(37,'Documentation et archives','الوثائق والمحفوظات'),(38,'Documentation et archives','الوثائق والمحفوظات'),(39,'Documentation et archives','الوثائق والمحفوظات'),(40,'Documentation et archives','الوثائق والمحفوظات'),(41,'Documentation et archives','الوثائق والمحفوظات'),(42,'Documentation et archives','الوثائق والمحفوظات'),(43,'Laboratoire et maintenance','المخبر والصيانة والصيانة'),(44,'Laboratoire et maintenance','المخبر والصيانة والصيانة'),(45,'Laboratoire et maintenance','المخبر والصيانة والصيانة'),(46,'Laboratoire et maintenance','المخبر والصيانة والصيانة'),(47,'Laboratoire et maintenance','المخبر والصيانة والصيانة'),(48,'Laboratoire et maintenance','المخبر والصيانة والصيانة'),(49,'Laboratoire et maintenance','المخبر والصيانة والصيانة'),(50,'Laboratoire et maintenance','المخبر والصيانة والصيانة'),(51,'Laboratoire et maintenance','المخبر والصيانة والصيانة'),(52,'Corps des analystes de l\'économie','المحللين الاقتصاديين'),(53,'Corps des analystes de l\'économie','المحللين الاقتصاديين'),(54,'Corps des analystes de l\'économie','المحللين الاقتصاديين'),(55,'Administration générale','الإدارة العامة'),(56,'Administration générale','الإدارة العامة'),(57,'Traduction-interprétariat','الترجمة -الترجمة الفورية'),(58,'Informatique','الإعلام الآلي'),(59,'Informatique','الإعلام الآلي'),(60,'Statistiques','الإحصائيات'),(61,'Statistiques','الإحصائيات'),(62,'Documentation et archives','الوثائق والمحفوظات'),(63,'Documentation et archives','الوثائق والمحفوظات'),(64,'Laboratoire et maintenance','المخبر والصيان والصيانة'),(65,'Laboratoire et maintenance','المخبر والصيان والصيانة');
/*!40000 ALTER TABLE `filieres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fonctions`
--

DROP TABLE IF EXISTS `fonctions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fonctions` (
  `id_fonction` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nom_fonction` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nom_fonction_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Moyenne` double NOT NULL,
  PRIMARY KEY (`id_fonction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fonctions`
--

LOCK TABLES `fonctions` WRITE;
/*!40000 ALTER TABLE `fonctions` DISABLE KEYS */;
INSERT INTO `fonctions` (`id_fonction`, `Nom_fonction`, `Nom_fonction_ar`, `Moyenne`) VALUES
('0h-cbt', 'Chef Cabinet', 'رئيس الديوان ', 1900),
('1h-sg', 'Secrétaire général', 'أمين عام', 1900),
('2h-insp', 'Inspecteur général', 'مفتش عام ', 1900),
('3bm', 'Directeur', 'مدير', 1628),
('b3m-1', 'Sous-directeur', 'مدير فرعي', 1528),
('ces-07', 'Chargé d\'études et de synthèses', 'مكلف بالدراسات والتلخيص', 1800),
('insp-b1', 'Inspecteur', 'مفتش', 1800),
('res-b12', 'Chargé d\'études et de synthèses, chef du cabinet ministériel de sécurité intérieure de l\'établissement', 'مكلف بالدراسات والتلخيص، مسؤول المكتب الوزاري للأمن الداخلي في المؤسسة ', 1800),
('res-b14', 'Responsable des études au Cabinet ministériel de la sécurité intérieure de la Fondation', 'رئيس دراسات بالمكتب الوزاري للأمن الداخلي في المؤسسة ', 1800),
('res-b15', 'Responsable des études au Cabinet ministériel de la sécurité intérieure de la Fondation', 'رئيس دراسات بالمكتب الوزاري للأمن الداخلي في المؤسسة ', 1800),
('res1-B2', 'Directeur des études', 'مدير دراسات', 1800);
/*!40000 ALTER TABLE `fonctions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generes`
--

DROP TABLE IF EXISTS `generes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `generes` (
  `id_genr` int NOT NULL AUTO_INCREMENT,
  `date_creation` date NOT NULL,
  `ref_Dossier` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_nin` decimal(18,0) NOT NULL,
  `id_p` bigint NOT NULL,
  PRIMARY KEY (`id_genr`),
  UNIQUE KEY `generes_ref_dossier_unique` (`ref_Dossier`),
  UNIQUE KEY `generes_id_nin_unique` (`id_nin`),
  KEY `generes_id_p_foreign` (`id_p`),
  CONSTRAINT `generes_id_nin_foreign` FOREIGN KEY (`id_nin`) REFERENCES `employes` (`id_nin`),
  CONSTRAINT `generes_id_p_foreign` FOREIGN KEY (`id_p`) REFERENCES `employes` (`id_p`),
  CONSTRAINT `generes_ref_dossier_foreign` FOREIGN KEY (`ref_Dossier`) REFERENCES `dossiers` (`ref_Dossier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generes`
--

LOCK TABLES `generes` WRITE;
/*!40000 ALTER TABLE `generes` DISABLE KEYS */;
/*!40000 ALTER TABLE `generes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb3_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logins`
--

DROP TABLE IF EXISTS `logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logins` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `date_login` datetime NOT NULL,
  `date_logout` datetime DEFAULT NULL,
  `id_nin` decimal(18,0) NOT NULL,
  `id_p` bigint NOT NULL,
  `id` int NOT NULL,
  PRIMARY KEY (`id_log`),
  KEY `logins_id_nin_foreign` (`id_nin`),
  KEY `logins_id_p_foreign` (`id_p`),
  KEY `logins_id_foreign` (`id`),
  CONSTRAINT `logins_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  CONSTRAINT `logins_id_nin_foreign` FOREIGN KEY (`id_nin`) REFERENCES `employes` (`id_nin`),
  CONSTRAINT `logins_id_p_foreign` FOREIGN KEY (`id_p`) REFERENCES `employes` (`id_p`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logins`
--

LOCK TABLES `logins` WRITE;
/*!40000 ALTER TABLE `logins` DISABLE KEYS */;
INSERT INTO `logins` VALUES (1,'2025-07-29 10:01:02','2025-07-29 13:13:29',1254953,123,1),(2,'2025-07-29 10:01:15','2025-07-31 14:02:26',1254953,123,1),(3,'2025-07-29 10:02:30','2025-08-01 11:26:47',1254953,123,1),(4,'2025-07-29 10:16:39',NULL,1254953,123,1),(5,'2025-07-29 10:16:43',NULL,1254953,123,1),(6,'2025-07-29 10:38:33',NULL,1254953,123,1),(7,'2025-07-29 13:13:08',NULL,1254953,123,1),(8,'2025-07-29 13:13:55',NULL,1254953,123,1),(9,'2025-07-29 13:38:33',NULL,1254953,123,1),(10,'2025-07-29 13:48:07',NULL,1254953,123,1),(11,'2025-07-30 07:21:04',NULL,1254953,123,1),(12,'2025-07-30 08:01:49',NULL,1254953,123,1),(13,'2025-07-30 08:06:10',NULL,1254953,123,1),(14,'2025-07-30 08:07:15',NULL,1254953,123,1),(15,'2025-07-30 08:18:39',NULL,1254953,123,1),(16,'2025-07-30 08:48:48',NULL,1254953,123,1),(17,'2025-07-30 12:59:19',NULL,1254953,123,1),(18,'2025-07-30 14:21:22',NULL,1254953,123,1),(19,'2025-07-30 14:26:01',NULL,1254953,123,1),(20,'2025-07-30 15:04:56',NULL,1254953,123,1),(21,'2025-07-31 07:05:40',NULL,1254953,123,1),(22,'2025-07-31 07:09:40',NULL,1254953,123,1),(23,'2025-07-31 08:21:01',NULL,1254953,123,1),(24,'2025-07-31 08:49:49',NULL,1254953,123,1),(25,'2025-07-31 08:53:42',NULL,1254953,123,1),(26,'2025-07-31 14:06:04',NULL,1254953,123,1),(27,'2025-07-31 14:21:46',NULL,1254953,123,1),(28,'2025-07-31 14:29:22',NULL,1254953,123,1),(29,'2025-08-01 08:43:20',NULL,1254953,123,1);
/*!40000 ALTER TABLE `logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `action` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_nin` decimal(18,0) NOT NULL,
  `id` int NOT NULL,
  `adresse_mac` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_action` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`),
  KEY `logs_id_nin_foreign` (`id_nin`),
  KEY `logs_id_foreign` (`id`),
  CONSTRAINT `logs_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  CONSTRAINT `logs_id_nin_foreign` FOREIGN KEY (`id_nin`) REFERENCES `employes` (`id_nin`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'Ajouter Infos Personnelles Employé',109790646005040001,1,'notfound','2025-07-29 09:30:28'),(6,'Ajouter Infos Personnelles Employé',119591165001560006,1,'notfound','2025-07-29 10:09:41'),(7,'Ajouter Infos Personnelles Employé',119870581018230008,1,'notfound','2025-07-29 10:13:42'),(8,'Ajouter Infos Personnelles Employé',109460887028730002,1,'notfound','2025-07-29 11:21:51'),(9,'Ajouter Niveau Education Employé',109790646005040001,1,'notfound','2025-07-29 11:29:12'),(10,'Ajouter Niveau Education Employé',119870581018230008,1,'notfound','2025-07-29 11:29:41'),(11,'Ajouter Infos Personnelles Employé',119780586013040003,1,'notfound','2025-07-29 11:48:55'),(12,'Générer La Décision Employé',254896989,1,'0A-00-27-00-00-12','2025-07-30 06:41:36'),(13,'Ajouter Infos Personnelles Employé',119760580000790005,1,'notfound','2025-07-30 09:46:25'),(14,'Ajouter Infos Personnelles Employé',119770554051100008,1,'notfound','2025-07-31 07:40:51'),(15,'Ajouter Infos Personnelles Employé',119911017009620006,1,'notfound','2025-07-31 07:56:34'),(16,'Ajouter Infos Personnelles Employé',109970958005910009,1,'notfound','2025-07-31 08:02:50'),(17,'Ajouter Infos Personnelles Employé',109940064011530001,1,'notfound','2025-07-31 08:10:09'),(18,'Ajouter Infos Personnelles Employé',119700593006640002,1,'notfound','2025-07-31 08:29:02'),(19,'Ajouter Un fichier a Em_119700593006640002/sous_Dossier :Niveaux Avec Nomشهادة نجاح ليسانس علوم إقتصادية.pdf',119700593006640002,1,'notfound','2025-07-31 08:35:02'),(20,'Ajouter Niveau Education Employé',119700593006640002,1,'notfound','2025-07-31 08:35:08'),(21,'Ajouter Infos Personnelles Employé',119840392022230004,1,'notfound','2025-07-31 09:53:17'),(22,'Ajouter Infos Personnelles Employé',109810549000980008,1,'notfound','2025-07-31 10:03:15'),(23,'Ajouter Infos Personnelles Employé',109710583000820006,1,'notfound','2025-07-31 10:06:38'),(24,'Ajouter Infos Personnelles Employé',119830580039900001,1,'notfound','2025-07-31 10:12:00'),(25,'Ajouter Infos Personnelles Employé',119830252019950006,1,'notfound','2025-07-31 11:43:55'),(26,'Ajouter Niveau Education Employé',119830252019950006,1,'notfound','2025-07-31 11:44:45'),(27,'Ajouter Un fichier a Em_119830252019950006/sous_Dossier :Admin Avec Nomمقرر تتعيين.pdf',119830252019950006,1,'notfound','2025-07-31 11:50:43'),(28,'Ajouter Niveau Education Employé',119591165001560006,1,'notfound','2025-07-31 12:10:44'),(29,'Générer La Décision Employé',119591165001560006,1,'notfound','2025-07-31 12:32:56'),(30,'Ajouter Un fichier a Em_119870581018230008/sous_Dossier :Niveaux Avec Nomشهادة الكفاءة المهنية.pdf',119870581018230008,1,'notfound','2025-07-31 12:37:13'),(31,'Générer La Décision Employé',119870581018230008,1,'notfound','2025-07-31 12:39:20'),(32,'Ajouter Un fichier a Em_109790646005040001/sous_Dossier :Niveaux Avec Nomشهادة ماستر.pdf',109790646005040001,1,'notfound','2025-07-31 12:44:28'),(33,'Ajouter Infos Personnelles Employé',110000586005440008,1,'notfound','2025-07-31 13:44:25'),(34,'Ajouter Infos Personnelles Employé',119940284017170004,1,'notfound','2025-07-31 13:48:12'),(35,'Ajouter Niveau Education Employé',110000586005440008,1,'notfound','2025-07-31 13:48:35'),(36,'Générer La Décision Employé',110000586005440008,1,'notfound','2025-07-31 13:50:21'),(37,'Ajouter Un fichier a Em_119940284017170004/sous_Dossier :Niveaux Avec Nomشهادة ماستر.pdf',119940284017170004,1,'notfound','2025-07-31 13:57:30'),(38,'Ajouter Niveau Education Employé',119940284017170004,1,'notfound','2025-07-31 13:57:34'),(39,'Ajouter Infos Personnelles Employé',119780579015490003,1,'notfound','2025-07-31 13:58:10'),(40,'Générer La Décision Employé',119940284017170004,1,'notfound','2025-07-31 14:00:06'),(41,'Ajouter Niveau Education Employé',119780579015490003,1,'notfound','2025-07-31 14:01:16'),(42,'Générer La Décision Employé',119780579015490003,1,'notfound','2025-07-31 14:05:35'),(43,'Ajouter Infos Personnelles Employé',109730554036090001,1,'notfound','2025-07-31 14:14:37'),(44,'Ajouter Infos Personnelles Employé',119760563004340000,1,'notfound','2025-07-31 14:21:23'),(45,'Ajouter Infos Personnelles Employé',119660542001980002,1,'notfound','2025-07-31 14:24:52'),(46,'Ajouter Niveau Education Employé',119660542001980002,1,'notfound','2025-07-31 14:28:49'),(47,'Ajouter Infos Personnelles Employé',119760581007120006,1,'notfound','2025-07-31 14:32:10'),(48,'Générer La Décision Employé',119660542001980002,1,'notfound','2025-07-31 14:33:59'),(49,'Ajouter Infos Personnelles Employé',109810580035800002,1,'notfound','2025-07-31 14:37:16'),(50,'Ajouter Un fichier a Em_109790646005040001/sous_Dossier :Niveaux Avec Nomشهادة ماستر.pdf',109790646005040001,1,'notfound','2025-07-31 14:39:43'),(51,'Stocker Un fichier Num 13',109790646005040001,1,'notfound','2025-07-31 14:39:43'),(52,'Ajouter Infos Personnelles Employé',119880596017960006,1,'notfound','2025-07-31 14:42:18'),(53,'Générer La Décision Employé',109790646005040001,1,'notfound','2025-07-31 14:43:45'),(54,'Ajouter Infos Personnelles Employé',109780569010190006,1,'notfound','2025-08-01 07:51:55'),(55,'Ajouter Infos Personnelles Employé',119690579006730002,1,'notfound','2025-08-01 07:56:45'),(56,'Ajouter Infos Personnelles Employé',119730569004170006,1,'notfound','2025-08-01 08:07:51'),(57,'Ajouter Infos Personnelles Employé',119780554053970000,1,'notfound','2025-08-01 08:15:42'),(58,'Ajouter Infos Personnelles Employé',119800555019130007,1,'notfound','2025-08-01 08:23:47'),(59,'Ajouter Infos Personnelles Employé',119820581045990004,1,'notfound','2025-08-01 08:28:34'),(60,'Ajouter Infos Personnelles Employé',119860557006760009,1,'notfound','2025-08-01 08:42:59');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_employes_table',1),(2,'0001_01_01_000001_create_users_table',1),(3,'0001_01_01_000002_create_cache_table',1),(4,'0001_01_01_000003_create_jobs_table',1),(5,'2024_05_19_101206_add_two_factor_columns_to_users_table',1),(6,'2024_05_26_130236_ad_new_attribut1_in_users_table',1),(7,'2024_06_30_103846_create_departements_table',1),(8,'2024_06_30_103847_create_sous_departements_table',1),(9,'2024_06_30_103848_create_bureaus_table',1),(10,'2024_06_30_103849_create_travails_table',1),(11,'2024_06_30_104016_create_logins_table',1),(12,'2024_06_30_104039_create_type_congs_table',1),(13,'2024_06_30_104129_create_fichiers_table',1),(14,'2024_06_30_104139_create_conges_table',1),(15,'2024_06_30_104222_create_absences_table',1),(16,'2024_06_30_104234_create_filieres_table',1),(17,'2024_06_30_104235_create_secteurs_table',1),(18,'2024_06_30_104236_create_posts_table',1),(19,'2024_06_30_105408_create_feedback_table',1),(20,'2024_06_30_111408_create_fonctions_table',1),(21,'2024_06_30_111409_create_post_sups_table',1),(22,'2024_06_30_111410_create_contients_table',1),(23,'2024_06_30_111711_create_occupes_table',1),(24,'2024_06_30_111725_create_niveaux_table',1),(25,'2024_06_30_111726_create_appartients_table',1),(26,'2024_06_30_111802_create_dossiers_table',1),(27,'2024_06_30_111803_create_generes_table',1),(28,'2024_07_21_212630_create_logs_table',1),(29,'2024_07_21_212642_create_stocke_table',1),(30,'2024_09_04_091619_create_promotions_table',1),(31,'2024_09_04_091620_create_promotion_affectes_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `niveaux`
--

DROP TABLE IF EXISTS `niveaux`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `niveaux` (
  `id_niv` int NOT NULL AUTO_INCREMENT,
  `Nom_niv` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Specialite` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Descriptif_niv` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nom_niv_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Specialite_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `moyenne_niv` int DEFAULT NULL,
  `major_niv` int DEFAULT NULL,
  `date_major` date DEFAULT NULL,
  `Descriptif_niv_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_post` int DEFAULT NULL,
  PRIMARY KEY (`id_niv`),
  KEY `niveaux_id_post_foreign` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `niveaux`
--

LOCK TABLES `niveaux` WRITE;
/*!40000 ALTER TABLE `niveaux` DISABLE KEYS */;
INSERT INTO `niveaux` VALUES (1,'Master 2','Génie Logiciel','','ماستر 2','الهندسة البرمجية',NULL,NULL,NULL,'',NULL),(2,'Master 2','Systèmes d’Information','','ماستر 2','نظم المعلومات',NULL,NULL,NULL,'',NULL),(3,'Master 2','Réseaux et Systèmes','','ماستر 2','الشبكات والأنظمة',NULL,NULL,NULL,'',NULL),(4,'Master 2','Sécurité Informatique','','ماستر 2','أمن المعلومات',NULL,NULL,NULL,'',NULL),(5,'Master 2','Science des Données','','ماستر 2','علم البيانات',NULL,NULL,NULL,'',NULL),(6,'Master 2','Intelligence Artificielle','','ماستر 2','الذكاء الاصطناعي',NULL,NULL,NULL,'',NULL),(7,'Master 2','Économie Internationale','','ماستر 2','الاقتصاد الدولي',NULL,NULL,NULL,'',NULL),(8,'Master 2','Économie du Développement','','ماستر 2','اقتصاد التنمية',NULL,NULL,NULL,'',NULL),(9,'Master 2','Sciences Commerciales','','ماستر 2','العلوم التجارية',NULL,NULL,NULL,'',NULL),(10,'Master 2','Marketing','','ماستر 2','التسويق',NULL,NULL,NULL,'',NULL),(11,'Master 2','Commerce International','','ماستر 2','التجارة الدولية',NULL,NULL,NULL,'',NULL),(12,'Master 2','Comptabilité','','ماستر 2','المحاسبة',NULL,NULL,NULL,'',NULL),(13,'Master 2','Audit et Contrôle','','ماستر 2','التدقيق والرقابة',NULL,NULL,NULL,'',NULL),(14,'Master 2','Banque et Assurance','','ماستر 2','البنوك والتأمين',NULL,NULL,NULL,'',NULL),(15,'Master 2','Gestion','','ماستر 2','التسيير',NULL,NULL,NULL,'',NULL),(16,'Master 2','Gestion des Ressources Humaines','','ماستر 2','تسيير الموارد البشرية',NULL,NULL,NULL,'',NULL),(17,'Master 2','Droit Public','','ماستر 2','القانون العام',NULL,NULL,NULL,'',NULL),(18,'Master 2','Droit Privé','','ماستر 2','القانون الخاص',NULL,NULL,NULL,'',NULL),(19,'Master 2','Droit Pénal','','ماستر 2','القانون الجنائي',NULL,NULL,NULL,'',NULL),(20,'Master 2','Droit Administratif','','ماستر 2','القانون الإداري',NULL,NULL,NULL,'',NULL),(21,'Master 2','Droit des Affaires','','ماستر 2','قانون الأعمال',NULL,NULL,NULL,'',NULL),(22,'Master 2','Droit Constitutionnel','','ماستر 2','القانون الدستوري',NULL,NULL,NULL,'',NULL),(23,'Master 2','Relations Internationales','','ماستر 2','العلاقات الدولية',NULL,NULL,NULL,'',NULL),(24,'Master 2','Psychologie Clinique','','ماستر 2','علم النفس السريري',NULL,NULL,NULL,'',NULL),(25,'Master 2','Psychologie Sociale','','ماستر 2','علم النفس الاجتماعي',NULL,NULL,NULL,'',NULL),(26,'Master 2','Neuropsychologie','','ماستر 2','علم النفس العصبي',NULL,NULL,NULL,'',NULL),(27,'Master 2','Sociologie Générale','','ماستر 2','علم الاجتماع العام',NULL,NULL,NULL,'',NULL),(28,'Master 2','Sociologie du Travail','','ماستر 2','علم اجتماع العمل',NULL,NULL,NULL,'',NULL),(29,'Master 2','Sociologie de l’Éducation','','ماستر 2','علم اجتماع التربية',NULL,NULL,NULL,'',NULL),(30,'Master 2','Histoire Contemporaine','','ماستر 2','التاريخ المعاصر',NULL,NULL,NULL,'',NULL),(31,'Master 2','Anthropologie','','ماستر 2','الأنثروبولوجيا',NULL,NULL,NULL,'',NULL),(32,'Master 2','Philosophie','','ماستر 2','الفلسفة',NULL,NULL,NULL,'',NULL),(33,'Master 2','Sciences de l\'Éducation','','ماستر 2','علوم التربية',NULL,NULL,NULL,'',NULL),(34,'Licence','Langue et Littérature Arabe','','ليسانس','اللغة والأدب العربي',NULL,NULL,NULL,'',NULL),(35,'Licence','Linguistique Arabe','','ليسانس','اللسانيات العربية',NULL,NULL,NULL,'',NULL),(36,'Licence','Langue et Littérature Française','','ليسانس','اللغة والأدب الفرنسي',NULL,NULL,NULL,'',NULL),(37,'Licence','Linguistique Française','','ليسانس','اللسانيات الفرنسية',NULL,NULL,NULL,'',NULL),(38,'Licence','FLE (Français Langue Étrangère)','','ليسانس','الفرنسية كلغة أجنبية (FLE)',NULL,NULL,NULL,'',NULL),(39,'Licence','Langue et Littérature Anglaise','','ليسانس','اللغة والأدب الإنجليزي',NULL,NULL,NULL,'',NULL),(40,'Licence','Linguistique Anglaise','','ليسانس','اللسانيات الإنجليزية',NULL,NULL,NULL,'',NULL),(41,'Licence','Traduction','','ليسانس','الترجمة',NULL,NULL,NULL,'',NULL),(42,'Licence','Langue Espagnole','','ليسانس','اللغة الإسبانية',NULL,NULL,NULL,'',NULL),(43,'Licence','Langue Allemande','','ليسانس','اللغة الألمانية',NULL,NULL,NULL,'',NULL),(44,'BTS / TS','Maintenance Industrielle','','تقني سام','الصيانة الصناعية',NULL,NULL,NULL,'',NULL),(45,'BTS / TS','Réseaux Informatiques','','تقني سام','الشبكات المعلوماتية',NULL,NULL,NULL,'',NULL),(46,'BTS / TS','Topographie','','تقني سام','الطبوغرافيا',NULL,NULL,NULL,'',NULL),(47,'BTS / TS','Électromécanique','','تقني سام','الإلكتروميكانيك',NULL,NULL,NULL,'',NULL),(48,'BTS / TS','Froid et Climatisation','','تقني سام','التبريد والتكييف',NULL,NULL,NULL,'',NULL),(49,'BTS / TS','Sécurité et Hygiène Industrielle','','تقني سام','السلامة والنظافة الصناعية',NULL,NULL,NULL,'',NULL),(50,'BTS / TS','Dessin de Bâtiment','','تقني سام','رسم البناء',NULL,NULL,NULL,'',NULL),(51,'null','null','','null','null',NULL,NULL,NULL,'',NULL),(52,'licence','/','','الليسانس','/',NULL,NULL,NULL,'',NULL),(53,'licence','علوم إقتصادية','','الليسانس','التسيير',NULL,NULL,NULL,'',NULL),(54,'null','null','','null','null',NULL,NULL,NULL,'',NULL),(55,'licence','comptablite','','ليسانس','محاسبة',NULL,NULL,NULL,'',NULL),(56,'technicien supérieur','gestion des stokes et logestiques','','تقني سام','تسيير المخزونات واللوجيستيك',NULL,NULL,NULL,'',NULL),(57,'MASTER','SYSTEMES INFORMATIQUES ET RESEAUX','','ماستر','أنظمة الإعلام الآلي والشبكات',NULL,NULL,NULL,'',NULL),(58,'تقني','exploitant en informatique','','technicien','المستغل في الإعلام الآلي',NULL,NULL,NULL,'',NULL),(59,'null','null','','null','null',NULL,NULL,NULL,'',NULL),(60,'Baccalauréat','Lettres','','شهادة بكالوريا','أداب',NULL,NULL,NULL,'',NULL);
/*!40000 ALTER TABLE `niveaux` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occupes`
--

DROP TABLE IF EXISTS `occupes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `occupes` (
  `id_occup` int NOT NULL AUTO_INCREMENT,
  `date_recrutement` date NOT NULL,
  `echellant` double NOT NULL,
  `id_nin` decimal(18,0) NOT NULL,
  `id_p` bigint NOT NULL,
  `id_post` int NOT NULL,
  `ref_PV` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `visa_CF` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date_CF` date DEFAULT NULL,
  `type_CTR` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ref_Decision` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'New',
  `ref_base` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_postsup` int DEFAULT NULL,
  `id_fonction` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_occup`),
  KEY `occupes_id_p_foreign` (`id_p`),
  KEY `occupes_id_postsup_foreign` (`id_postsup`),
  KEY `occupes_id_fonction_foreign` (`id_fonction`),
  KEY `occupes_id_nin_unique` (`id_nin`) USING BTREE,
  CONSTRAINT `occupes_id_fonction_foreign` FOREIGN KEY (`id_fonction`) REFERENCES `fonctions` (`id_fonction`),
  CONSTRAINT `occupes_id_nin_foreign` FOREIGN KEY (`id_nin`) REFERENCES `employes` (`id_nin`),
  CONSTRAINT `occupes_id_p_foreign` FOREIGN KEY (`id_p`) REFERENCES `employes` (`id_p`),
  CONSTRAINT `occupes_id_postsup_foreign` FOREIGN KEY (`id_postsup`) REFERENCES `post_sups` (`id_postsup`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupes`
--

LOCK TABLES `occupes` WRITE;
/*!40000 ALTER TABLE `occupes` DISABLE KEYS */;
INSERT INTO `occupes` VALUES (4,'2024-07-03',13,254896989,256,20,'1N','1N','2024-07-03','CDI','New','1N',NULL,NULL),(10,'2024-04-14',13,1254953,123,2,'2N','1N5','2024-05-03','CDI','New','2N',NULL,NULL),(33,'2022-08-01',0,119591165001560006,781304004160,22,'1019',NULL,NULL,NULL,'New','1019',NULL,NULL),(34,'2024-02-19',0,119870581018230008,871823004844,21,'100',NULL,NULL,NULL,'New','100',NULL,NULL),(35,'2024-02-18',0,110000586005440008,544007564,35,'201',NULL,NULL,NULL,'New','201',NULL,NULL),(36,'2024-02-18',0,119940284017170004,941717001949,20,'186',NULL,NULL,NULL,'New','186',NULL,NULL),(37,'2024-07-09',0,119780579015490003,781549004541,44,'527',NULL,NULL,NULL,'New','527',NULL,NULL),(38,'2021-02-01',0,119660542001980002,660198019135,28,'107',NULL,NULL,NULL,'New','107',NULL,NULL),(39,'2022-06-21',0,109790646005040001,790504006155,50,'360',NULL,NULL,NULL,'New','360',NULL,NULL);
/*!40000 ALTER TABLE `occupes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_sups`
--

DROP TABLE IF EXISTS `post_sups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_sups` (
  `id_postsup` int NOT NULL AUTO_INCREMENT,
  `Nom_postsup` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nom_postsup_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Niveau_sup` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `point_indsup` int NOT NULL,
  PRIMARY KEY (`id_postsup`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_sups`
--

LOCK TABLES `post_sups` WRITE;
/*!40000 ALTER TABLE `post_sups` DISABLE KEYS */;
INSERT INTO `post_sups` (`id_postsup`, `Nom_postsup`, `Nom_postsup_ar`, `Niveau_sup`, `point_indsup`) VALUES
(1, 'chargé Reseaux', 'مسؤول الشبكات', '8', 250),
(3, 'Chef du bureau', 'رئيس مكتب ', '8', 250),
(4, 'Chargé d\'études et de projet à l\'administration centrale', 'مكلف بالدراسات وبمشروع في الإدارة المركزية ', '8', 250),
(5, 'Attaché au Cabinet dans l\'Administration centrale', 'ملحق بالديوان في الإدارة المركزية', '8', 250),
(6, 'Assistant au Cabinet', 'مساعد بالديوان ', '4', 125),
(7, 'Agent d\'accueil et d\'orientation', 'مكلف بالإستقبال والتوجيه', '4', 125),
(8, 'Responsable des programmes de traduction et d\'interprétation', 'مكلف ببرامج الترجمة والترجمة الفورية ', '8', 250),
(9, 'Chargé des programmes statistiques', 'المكلف بالبرامج الإحصائية ', '8', 250),
(10, 'Chargé d\'études', 'مكلف بالدراسات ', '8', 250),
(11, 'Chef de parc', 'رئيس حظيرة', '3', 100),
(12, 'Chef díatelier', 'رئيس ورشة ', '3', 100),
(13, 'Chef magasinier', 'رئيس مخزن ', '3', 100),
(14, 'Responsable du service intèrieur', 'مسؤول المصلحة الداخلية ', '3', 100);

/*!40000 ALTER TABLE `post_sups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `Nom_post` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Grade_post` int NOT NULL,
  `Nom_post_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_secteur` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `posts_id_secteur_foreign` (`id_secteur`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (67,'Adjoint technique',7,'معاون تقني',49),(66,'Technicien supérieur',10,'تقني سام',48),(21,'Administrateur',12,'متصرف',3),(22,'Administrateur principal',14,'متصرف  رئيسي',4),(23,'Administrateur conseiller',16,'متصرف مستشار',5),(24,'Attaché d\'administration',9,'ملحق الإدارة',6),(25,'Attaché principal d\'administration',10,'ملحق رئيسي للإدارة',7),(26,'Agent de bureau',5,'عون مكتب',8),(27,'Agent d\'administration',7,'عون إدارة',9),(28,'Agent principal d\'administration',8,'عون إدارة رئيسي',10),(29,'Agent de saisie',5,'عون حفظ البيانات',11),(30,'Secrétaire',6,'كاتب',12),(31,'Secrétaire  de direction',8,'كاتب مديرية',13),(32,'Secrétaire  principal de direction',10,'كاتب مديرية رئيسي',14),(33,'Aide-comptable administratif',5,'مساعد محاسب إداري',15),(34,'Comptable administratif',8,'محاسب إداري',16),(35,'Comptable administratif principal',10,'محاسب إداري رئيسي',17),(36,'Traducteur-interprète',12,'المترجم - الترجمان',18),(37,'Traducteur-interprète principal',14,'المترجم - الترجمان الرئيسي',19),(38,'Traducteur-interprète en chef',16,'رئيس المترجمين- التراجمة',20),(39,'Ingénieur d\'application',11,'المهندسون التطبيقيون',21),(20,'Ingénieur d\'Etat',13,'مهندسو الدولة',22),(41,'Ingénieur principal',14,'المهندسون الرئيسيون',23),(42,'Ingénieur  en chef',16,'رئيس المهندسين',24),(2,'Technicien',8,'تقني',25),(44,'Technicien supérieur',10,'تقني سام',26),(45,'Adjoint technique',7,'معاون تقني',27),(46,'Agent technique',5,'عون تقني',28),(47,'Ingénieur d\'application',11,'المهندسون التطبيقيون',29),(48,'Ingénieur d\'Etat',13,'مهندسو الدولة',30),(49,'Ingénieur principal',14,'المهندسون الرئيسيون',31),(50,'Ingénieur  en chef',16,'رئيس المهندسين',32),(51,'Technicien',8,'تقني',33),(52,'Technicien supérieur',10,'تقني سام',34),(53,'Adjoint technique',7,'معاون تقني',35),(54,'Agent technique',5,'عون تقني',36),(55,'Documentaliste-archiviste',12,'وثائقي أمين محفوظات',37),(56,'Documentaliste-archiviste principal',14,'وثائقي أمين محفوظات رئيسي',38),(57,'Documentaliste-archiviste  en chef',16,'رئيس الوثائقيين أمناء المحفوظات',39),(58,'Documentaliste-archiviste  en chef',16,'رئيس الوثائقيين أمناء المحفوظات',40),(59,'Assistant documentaliste-archiviste',10,'مساعد وثائقي أمين محفوظات',41),(60,'Agent technique en documentation et archives',7,'عون تقني في الوثائق والمحفوظات',42),(61,'Ingénieur d\'application',11,'مهندس تطبيقي',43),(62,'Ingénieur d\'Etat',13,'مهندس دولة',44),(63,'Ingénieur principal',14,'مهندس رئيسي',45),(64,'Ingénieur  en chef',16,'رئيس المهندسين',46),(65,'Technicien',8,'تقني',47),(68,'Agent technique',5,'عون تقني',50),(69,'Agent de laboratoire',4,'عون مخبر',51),(70,'Analyste de l\'économie',12,'محلل اقتصادي',52),(71,'Analyste principal',14,'محلل رئيسي',53),(72,'Analyste en chef',16,'رئيس المحللين',54),(73,'administrateur analyste',13,'متصرف محلل',55),(74,'Assistant administrateur',11,'مساعد متصرف',56),(75,'Traducteur-interprète spécialisé',13,'المترجم-الترجمان المتخصص',57),(76,'Assistant ingénieur de niveau 1',11,'مساعد مهندس مستوى 1',58),(77,'Assistant ingénieur de niveau 2',12,'مساعد مهندس مستوى 2',59),(78,'Assistant ingénieur de niveau 1',11,'مساعد مهندس مستوى 1',60),(79,'Assistant ingénieur de niveau 2',12,'مساعد مهندس مستوى2',61),(80,'Documentaliste-archiviste analyste',13,'وثــــائــــقـي أمـــين مـــــحــــفــــوظــــات محلل',62),(81,'Assistant documentaliste-archiviste principal',11,'مــــــــســـــــــاعـــــــــد وثــــــــائـــــــــقـي أمـــــــين محفوظات رئيسي',63),(82,'Assistant ingénieur de niveau 1',11,'مساعد مهندس مستوى 1',64),(83,'Assistant ingénieur de niveau 2',12,'مساعد مهندس مستوى 2',65);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotion_affectes`
--

DROP TABLE IF EXISTS `promotion_affectes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promotion_affectes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotion_affectes`
--

LOCK TABLES `promotion_affectes` WRITE;
/*!40000 ALTER TABLE `promotion_affectes` DISABLE KEYS */;
/*!40000 ALTER TABLE `promotion_affectes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promotions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotions`
--

LOCK TABLES `promotions` WRITE;
/*!40000 ALTER TABLE `promotions` DISABLE KEYS */;
/*!40000 ALTER TABLE `promotions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secteurs`
--

DROP TABLE IF EXISTS `secteurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `secteurs` (
  `id_secteur` int NOT NULL AUTO_INCREMENT,
  `Nom_secteur` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nom_secteur_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_filiere` int NOT NULL,
  PRIMARY KEY (`id_secteur`),
  KEY `secteurs_id_filiere_foreign` (`id_filiere`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secteurs`
--

LOCK TABLES `secteurs` WRITE;
/*!40000 ALTER TABLE `secteurs` DISABLE KEYS */;
INSERT INTO `secteurs` VALUES (1,'ingénierie','سلك المهندسين',1),(2,'téchnicien','سلك التقنيون',1),(3,'Administrateurs','المتصرفون',3),(4,'Administrateurs','المتصرفون',4),(5,'Administrateurs','المتصرفون',5),(6,'Attachés d\'administration','ملحقو الإدارة',6),(7,'Attachés d\'administration','ملحقو الإدارة',7),(8,'Agents d\'administration','أعوان الإدارة',8),(9,'Agents d\'administration','أعوان الإدارة',9),(10,'Agents d\'administration','أعوان الإدارة',10),(11,'Secrétaires','الكتاب',11),(12,'Secrétaires','الكتاب',12),(13,'Secrétaires','الكتاب',13),(14,'Secrétaires','الكتاب',14),(15,'Comptables administratifs','المحاسبون الإداريون',15),(16,'Comptables administratifs','المحاسبون الإداريون',16),(17,'Comptables administratifs','المحاسبون الإداريون',17),(18,'Traducteurs interprètes','المترجمون - التراجمة',18),(19,'Traducteurs interprètes','المترجمون - التراجمة',19),(20,'Traducteurs interprètes','المترجمون - التراجمة',20),(21,'Ingénieurs','المهندسون',21),(22,'Ingénieurs','المهندسون',22),(23,'Ingénieurs','المهندسون',23),(24,'Ingénieurs','المهندسون',24),(25,'Techniciens','التقنيون',25),(26,'Techniciens','التقنيون',26),(27,'Adjoints techniques','المعاونون التقنيون',27),(28,'Agents techniques','الأعوان التقنيون',28),(29,'Ingénieurs','المهندسون',29),(30,'Ingénieurs','المهندسون',30),(31,'Ingénieurs','المهندسون',31),(32,'Ingénieurs','المهندسون',32),(33,'Techniciens','التقنيون',33),(34,'Techniciens','التقنيون',34),(35,'Adjoints techniques','المعاونون التقنيون',35),(36,'Agents techniques','الأعوان التقنيون',36),(37,'Documentalistes- archivistes','الوثائقيون أمناء المحفوظات',37),(38,'Documentalistes- archivistes','الوثائقيون أمناء المحفوظات',38),(39,'Documentalistes- archivistes','الوثائقيون أمناء المحفوظات',39),(40,'Documentalistes- archivistes','الوثائقيون أمناء المحفوظات',40),(41,'Assistants documentalistes archivistes','مـــســــاعـــدو الـــوثــــائـــقـــيــــين أمـــنـــاء المحفوظات',41),(42,'Agents techniques en documentation et archives','الأعـوان الـتـقـنـيـون في الـوثـائق والمحفوظات',42),(43,'Ingénieurs','المهندسون',43),(44,'Ingénieurs','المهندسون',44),(45,'Ingénieurs','المهندسون',45),(46,'Ingénieurs','المهندسون',46),(47,'Techniciens','التقنيون',47),(48,'Techniciens','التقنيون',48),(49,'Adjoints techniques','المعاونون التقنيون',49),(50,'Agents techniques','الأعوان التقنيون',50),(51,'Agents de laboratoire','أعوان المخبر',51),(52,'Analystes de l\'économie','المحللون الاقتصاديون',52),(53,'Analystes de l\'économie','المحللون الاقتصاديون',53),(54,'Analystes de l\'économie','المحللون الاقتصاديون',54),(55,'Administrateurs','المتصرفون',55),(56,'Assistants administrateurs','مساعدو المتصرفين',56),(57,'Traducteurs-interprètes','المترجمون - التراجمة',57),(58,'Assistants ingénieurs','مساعدو المهندسين',58),(59,'Assistants ingénieurs','مساعدو المهندسين',59),(60,'Assistants ingénieurs','مساعدو المهندسين',60),(61,'Assistants ingénieurs','مساعدو المهندسين',61),(62,'Documentalistes-archivistes','الوثائقيون أمناء المحفوظات',62),(63,'Assistants documentalistes-archivistes','مساعدو الوثائقيين أمناء المحفوظات',63),(64,'Assistants ingénieurs','مساعدو المهندسين',64),(65,'Assistants ingénieurs','مساعدو المهندسين',65);
/*!40000 ALTER TABLE `secteurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb3_unicode_ci,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('wCaT5KfxTJv7uCol19af3HuKwn2GPrKhs9v2Gl3W',NULL,'192.168.6.130','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZldkRndCTVBsQmpLcW1NUFQxalc1ZVVvZ2dGOWhoVFBxa2hJVHhVWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xOTIuMTY4LjYuMjQzL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJsb2NhbGUiO3M6MjoiYXIiO30=',1754047607);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sous_departements`
--

DROP TABLE IF EXISTS `sous_departements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sous_departements` (
  `id_sous_depart` int NOT NULL AUTO_INCREMENT,
  `id_depart` int NOT NULL,
  `Nom_sous_depart` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Descriptif_sous_depart` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nom_sous_depart_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Descriptif_sous_depart_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_sous_depart`),
  UNIQUE KEY `sous_departements_nom_sous_depart_unique` (`Nom_sous_depart`),
  UNIQUE KEY `sous_departements_descriptif_sous_depart_unique` (`Descriptif_sous_depart`),
  UNIQUE KEY `sous_departements_nom_sous_depart_ar_unique` (`Nom_sous_depart_ar`),
  UNIQUE KEY `sous_departements_descriptif_sous_depart_ar_unique` (`Descriptif_sous_depart_ar`),
  KEY `sous_departements_id_depart_foreign` (`id_depart`),
  CONSTRAINT `sous_departements_id_depart_foreign` FOREIGN KEY (`id_depart`) REFERENCES `departements` (`id_depart`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sous_departements`
--

LOCK TABLES `sous_departements` WRITE;
/*!40000 ALTER TABLE `sous_departements` DISABLE KEYS */;
INSERT INTO `sous_departements` VALUES (10,2,'des personnels','SDP','المستخدمين','م.ف.م'),(15,1,'dev','dev','تطوير','تطوير'),(16,2,'moyens généraux','SDMG','الوسائل العامة','م.ف.و.ع'),(18,1,'DEVELOPPEMENT TECHNOLOGIQUE','SDT','للتطوير التكنولوجي','م.ف.ت.ت'),(19,2,'budget, de la comptabilité et des marchés publics','SDBCMP','الميزانية، المحاسبة والصفقات العمومية','م.ف.م.م.ص.ع'),(20,1,'DES INVESTISSEMENTS','SDI','الإستثمارات','م.ف.إ'),(21,3,'COOPERATION','SDC','للتعاون','م.ف.ت ع'),(22,3,'FORMATION','SDF','للتكوين','م.ف.تك'),(23,5,'REGLEMENTATION','SDR','للتنظيم','م.ف.تنظ'),(24,4,'coordination des actions de communication','SDAC','تـــنــســيق أعــمــال  الاتــصــال','م.ف.ت.أ.إ'),(25,4,'la veille, de l\'évaluation et de l\'analyse','SDVEA','الرصد والتقييم والتحليل','م.ف.ر.ت.ت'),(26,4,'communication extérieure','SDCE','الاتصال الخارجي','م.ف.ا.خ'),(27,5,'ETUDES JURIDIQUES ET DU CONTENTIEUX','SDEJC','للدراسات القانونية والمنازعات','م.ف.د.ق.م'),(28,6,'la presse écrite','SDPE','الصحافة المكتوبة','م.ف.ص.م'),(29,5,'DE DOCUMENTATION ET DES ARCHIVE','SDDA','للتوثيق والأرشيف','م.ف.ت.أ'),(30,6,'l\'audiovisuel','SDA','السمعي البصري','م.ف.ص.ب'),(31,6,'Des activités de publicité et de conseil en communication','SDAPCC','لنشاطات الإشهار والإستشارة في الاتصال','م.ف.ن.ا.ا.ا');
/*!40000 ALTER TABLE `sous_departements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocke`
--

DROP TABLE IF EXISTS `stocke`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stocke` (
  `id_stocke` int NOT NULL AUTO_INCREMENT,
  `date_insertion` date NOT NULL,
  `ref_Dossier` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `sous_d` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_fichier` int NOT NULL,
  `id` int NOT NULL,
  `mac` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_stocke`),
  KEY `stocke_id_foreign` (`id`),
  KEY `stocke_id_fichier_foreign` (`id_fichier`),
  KEY `stocke_ref_dossier_foreign` (`ref_Dossier`),
  CONSTRAINT `stocke_id_fichier_foreign` FOREIGN KEY (`id_fichier`) REFERENCES `fichiers` (`id_fichier`),
  CONSTRAINT `stocke_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  CONSTRAINT `stocke_ref_dossier_foreign` FOREIGN KEY (`ref_Dossier`) REFERENCES `dossiers` (`ref_Dossier`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocke`
--

LOCK TABLES `stocke` WRITE;
/*!40000 ALTER TABLE `stocke` DISABLE KEYS */;
INSERT INTO `stocke` VALUES (1,'2025-07-31','Em_109790646005040001','Niveaux',13,1,'notfound');
/*!40000 ALTER TABLE `stocke` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travails`
--

DROP TABLE IF EXISTS `travails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travails` (
  `id_travail` int NOT NULL AUTO_INCREMENT,
  `date_installation` date NOT NULL,
  `date_chang` date NOT NULL,
  `notation` double NOT NULL,
  `id_nin` decimal(18,0) NOT NULL,
  `id_sous_depart` int NOT NULL,
  `id_p` bigint NOT NULL,
  `id_bureau` int NOT NULL,
  PRIMARY KEY (`id_travail`),
  KEY `travails_id_sous_depart_foreign` (`id_sous_depart`),
  KEY `travails_id_p_foreign` (`id_p`),
  KEY `travails_id_bureau_foreign` (`id_bureau`),
  KEY `travails_id_nin_unique` (`id_nin`) USING BTREE,
  CONSTRAINT `travails_id_bureau_foreign` FOREIGN KEY (`id_bureau`) REFERENCES `bureaus` (`id_bureau`),
  CONSTRAINT `travails_id_nin_foreign` FOREIGN KEY (`id_nin`) REFERENCES `employes` (`id_nin`),
  CONSTRAINT `travails_id_p_foreign` FOREIGN KEY (`id_p`) REFERENCES `employes` (`id_p`),
  CONSTRAINT `travails_id_sous_depart_foreign` FOREIGN KEY (`id_sous_depart`) REFERENCES `sous_departements` (`id_sous_depart`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travails`
--

LOCK TABLES `travails` WRITE;
/*!40000 ALTER TABLE `travails` DISABLE KEYS */;
INSERT INTO `travails` VALUES (14,'2023-07-01','2024-07-01',17,254896989,10,256,5),(20,'2024-04-14','2024-04-14',20,1254953,15,123,5),(22,'2022-08-01','2025-07-31',0,119591165001560006,10,781304004160,5),(23,'2024-02-19','2025-07-31',0,119870581018230008,10,871823004844,5),(24,'2024-02-18','2025-07-31',0,110000586005440008,19,544007564,5),(25,'2024-02-18','2025-07-31',0,119940284017170004,18,941717001949,5),(26,'2024-07-09','2025-07-31',0,119780579015490003,16,781549004541,5),(27,'2021-02-01','2025-07-31',0,119660542001980002,16,660198019135,5),(28,'2022-06-21','2025-07-31',0,109790646005040001,15,790504006155,5);
/*!40000 ALTER TABLE `travails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_congs`
--

DROP TABLE IF EXISTS `type_congs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_congs` (
  `ref_cong` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `titre_cong` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Descriptif` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `titre_cong_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Descriptif_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`ref_cong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_congs`
--

LOCK TABLES `type_congs` WRITE;
/*!40000 ALTER TABLE `type_congs` DISABLE KEYS */;
INSERT INTO `type_congs` VALUES ('RF001','Annuel','congé annuel','عطلة سنوية','عطلة سنوية'),('RF002','Maladie','congé maladie','عطلة مرضية','عطلة مرضية'),('RF003','matérnité','congé matérnité','عطلة الامومة','عطلة الامومة'),('RF004','Sans solde ','congé sans solde','عطلة بدون دفع','عطلة بدون دفع');
/*!40000 ALTER TABLE `type_congs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_nin` decimal(18,0) NOT NULL,
  `id_p` bigint NOT NULL,
  `username` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb3_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password_changed_at` timestamp NULL DEFAULT NULL,
  `password_created_at` timestamp NULL DEFAULT NULL,
  `nv_password` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `nbr_login` int NOT NULL,
  `is_verified` int NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `activation_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_id_nin_unique` (`id_nin`),
  UNIQUE KEY `users_id_p_unique` (`id_p`),
  UNIQUE KEY `users_username_unique` (`username`),
  CONSTRAINT `users_id_nin_foreign` FOREIGN KEY (`id_nin`) REFERENCES `employes` (`id_nin`),
  CONSTRAINT `users_id_p_foreign` FOREIGN KEY (`id_p`) REFERENCES `employes` (`id_p`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ing',1254953,123,'ing','$2y$12$QMNdYb8dQXCgpdWM9NF4OebBiHPAyKplRHoDqJFmqQnSXd9cCg1SW',NULL,NULL,NULL,NULL,'2025-07-29 09:01:12',NULL,'$2y$12$9FlpNMNszEwHwh.Lp0eXG.Utro0Xnfy943G2RaUvjlNzxyWs0bg2O',1,0,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-01 20:30:50
