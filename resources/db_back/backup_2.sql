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
INSERT INTO `appartients` VALUES ('1','2023-07-11',1,1254953,123),('15','2024-03-13',2,254896989,256),('2010/1075','2010-06-29',34,119870581018230008,871823004844),('null','1990-01-01',51,109790646005040001,790504006155);
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
  CONSTRAINT `contients_id_post_foreign` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id_post`),
  CONSTRAINT `contients_id_postsup_foreign` FOREIGN KEY (`id_postsup`) REFERENCES `post_sups` (`id_postsup`),
  CONSTRAINT `contients_id_sous_depart_foreign` FOREIGN KEY (`id_sous_depart`) REFERENCES `sous_departements` (`id_sous_depart`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contients`
--

LOCK TABLES `contients` WRITE;
/*!40000 ALTER TABLE `contients` DISABLE KEYS */;
INSERT INTO `contients` VALUES (2,20,NULL,NULL,10),(3,20,NULL,NULL,15),(10,2,NULL,NULL,10),(50,2,NULL,NULL,15);
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
INSERT INTO `departements` VALUES (1,'Développement et de l\'Investissement','Développement et de l\'Investissement','  التطوير و الاستثمار','  التطوير و الاستثمار'),(2,'Administration et des Moyens','Administration et des Moyens','الإدارة والوسائل ','الإدارة والوسائل'),(3,'La Coopération et de la Formation','La Coopération et de la Formation','التعاون  والتكوين ','التعاون  والتكوين'),(4,'La Communication Institutionnelle','La Communication Institutionnelle','الاتصال المؤسساتي','الاتصال المؤسساتي'),(5,'Affaires Juridiques, de la Documentation et des Archives','Affaires Juridiques, de la Documentation et des Archives','الشؤون  القانونية  والتوثيق  والأرشيف','الشؤون  القانونية  والتوثيق  والأرشيف'),(6,'Médias','Médias',' وسائل  الإعلام',' وسائل  الإعلام');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employes`
--

LOCK TABLES `employes` WRITE;
/*!40000 ALTER TABLE `employes` DISABLE KEYS */;
INSERT INTO `employes` VALUES (1,1254953,123,18505482,'mohamed','mohamed','محمد','محمد','2000-01-11','alger','الجزائر','alger','الجزائر','moh','fff','be','محمد','ف','ب','1975-08-31','1978-01-21','Célibataire','أعزب/عزباء',0,'Homme','fagmail.com','s@gmail.com','0124367555'),(2,254896989,256,25686984,'yacine','yacine','ياسين','ياسين','2024-07-01','alger','الجزائر','alger','الجزائر','moh','fff','be','محمد','ف','ب','1975-08-31','1978-01-21','Marié(e)','(ة)متزوج',0,'Homme','fgmail.com','ss@gmail.com','01573645525'),(3,109790646005040001,790504006155,790504006154,'ALANE','Abdelkader','عبد القادر','علان','1979-04-19','DJELFA','الجلفة','BP 347 AIN OUSSARA, DJELFA','مكتب بريد 347 عين وسارة-الجلفة','Mohamed','Khadija','Khatouf','محمد','خديجة','خطوف','1990-06-02','1999-06-02','Marié(e)','متزوج(ة)',0,'Homme',NULL,NULL,'NaN'),(4,119591165001560006,781304004160,781304004159,'AICHOUN','LOUBNA','لبنى','عيشون','1978-12-12','ALGER','الجزائر','n 05 CITE ISTANBUL, BORDJ-ELKIFFAN, ALGER','رقم 05حي اسطنبول، برج الكيفان، الجزائر','AHMED','LWARD','REZIG','أحمد','الورد','رزيق','1990-06-02','1999-06-02','Marié(e)','متزوج(ة)',0,'Femme',NULL,NULL,'NaN'),(5,119870581018230008,871823004844,871823004843,'menni','MOHAMED','محمد','مني','1987-05-19','alger','الجزائر','cite 1432 logmt beni abdi bt 46 n02 khracia alger','حي 1432 مسكن بني عبدي عمارة 46 رقم 02 خرايسية-الجزائر','ahmed','aicha','guettai','Ahmed','عائشة','قطاي','1990-06-02','1999-06-02','Célibataire','أعزب/عزباء',0,'Homme',NULL,NULL,'NaN'),(6,109460887028730002,770174017342,770174017341,'BOUCELLOUA','FADILA','فضيلة','بوصلوعة','1977-03-19','bouira','البويرة','cite 109 logmt bt 12 n05 heraoua-alger','حي 109 مسكن عمارة 12 رقم 05 هراوة-الجزائر','Rabie','حيدر','Fatma','null','فاطمة','Hider','1990-06-02','1999-06-02','Marié(e)','متزوج(ة)',0,'Femme',NULL,NULL,'NaN'),(7,119780586013040003,646026888260,646026888259,'BAHAMID','YACINE','ياسين','باحميد','1964-07-05','alger','الجزائر','66cite fernane hanafi bt 01H k kouba-alger','66 حي فرنان حنافي عمارة 01 ح القبة-الجزائر','Mohamed','Khedouja','Benaddache','null','خدوجة','بن عداش','1990-01-01','1990-01-01','Marié(e)','متزوج(ة)',0,'Homme',NULL,NULL,NULL);
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
  CONSTRAINT `feedback_id_p_foreign` FOREIGN KEY (`id_p`) REFERENCES `employes` (`id_p`),
  CONSTRAINT `feedback_id_post_foreign` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id_post`)
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fichiers`
--

LOCK TABLES `fichiers` WRITE;
/*!40000 ALTER TABLE `fichiers` DISABLE KEYS */;
INSERT INTO `fichiers` VALUES (2,'fff','fff','20','img','2024-01-11'),(3,'ggg','ggggg','20','img','2024-08-11'),(4,'aichoun.pdf','auOnqKl427lLzmkPg2T7MSJMR0R3CP1vKaBZps9Z.pdf','656.86 KB','pdf','2025-07-29'),(5,'aichoun.pdf','ehTO8D7R60DPrWYJtjxu9UG9joOOM6YfUamx2hNR.pdf','656.86 KB','pdf','2025-07-29'),(6,'aichoun.pdf','tor8zMGKc2ddsZxdbtzjN0cscVMJCPNOqCsf4BZn.pdf','656.86 KB','pdf','2025-07-29'),(7,'aichoun.pdf','N9MCgb3AnDCwjsMeLSX6Hqa8J8Q7kFFH5ovEpNYt.pdf','656.86 KB','pdf','2025-07-29');
/*!40000 ALTER TABLE `fichiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Structure de la table `filieres`
--

DROP TABLE IF EXISTS `filieres`;
CREATE TABLE IF NOT EXISTS `filieres` (
  `id_filiere` int NOT NULL AUTO_INCREMENT,
  `Nom_filiere` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nom_filiere_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_filiere`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `filieres`
--

INSERT INTO `filieres` (`id_filiere`, `Nom_filiere`, `Nom_filiere_ar`) VALUES

(3, 'Administration générale', 'الإدارة العامة'),
(4, 'Administration générale', 'الإدارة العامة'),
(5, 'Administration générale', 'الإدارة العامة'),
(6, 'Administration générale', 'الإدارة العامة'),
(7, 'Administration général', 'الإدارة العامة'),
(8, 'Administration générale', 'الإدارة العامة'),
(9, 'Administration générale', 'الإدارة العامة'),
(10, 'Administration générale', 'الإدارة العامة'),
(11, 'Administration générale', 'الإدارة العامة'),
(12, 'Administration générale', 'الإدارة العامة'),
(13, 'Administration générale', 'الإدارة العامة'),
(14, 'Administration générale', 'الإدارة العامة'),
(15, 'Administration générale', 'الإدارة العامة'),
(16, 'Administration générale', 'الإدارة العامة'),
(17, 'Administration générale', 'الإدارة العامة'),
(18, 'Traduction - interprétariat', 'الترجمة - الترجمة الفورية'),
(19, 'Traduction - interprétariat', 'الترجمة - الترجمة الفورية'),
(20, 'Traduction - interprétariat', 'الترجمة - الترجمة الفورية'),
(21, 'informatique', 'الإعلام الآلي'),
(22, 'informatique', 'الإعلام الآلي'),
(23, 'informatique', 'الإعلام الآلي'),
(24, 'informatique', 'الإعلام الآلي'),
(25, 'informatique', 'الإعلام الآلي'),
(26, 'informatique', 'الإعلام الآلي'),
(27, 'informatique', 'الإعلام الآلي'),
(28, 'informatique', 'الإعلام الآلي'),
(29, 'statistiques', 'الإحصائيات'),
(30, 'statistiques', 'الإحصائيات'),
(31, 'statistiques', 'الإحصائيات'),
(32, 'statistiques', 'الإحصائيات'),
(33, 'statistiques', 'الإحصائيات'),
(34, 'statistiques', 'الإحصائيات'),
(35, 'statistiques', 'الإحصائيات'),
(36, 'statistiques', 'الإحصائيات'),
(37, 'Documentation et archives', 'الوثائق والمحفوظات'),
(38, 'Documentation et archives', 'الوثائق والمحفوظات'),
(39, 'Documentation et archives', 'الوثائق والمحفوظات'),
(40, 'Documentation et archives', 'الوثائق والمحفوظات'),
(41, 'Documentation et archives', 'الوثائق والمحفوظات'),
(42, 'Documentation et archives', 'الوثائق والمحفوظات'),
(43, 'Laboratoire et maintenance', 'المخبر والصيانة والصيانة'),
(44, 'Laboratoire et maintenance', 'المخبر والصيانة والصيانة'),
(45, 'Laboratoire et maintenance', 'المخبر والصيانة والصيانة'),
(46, 'Laboratoire et maintenance', 'المخبر والصيانة والصيانة'),
(47, 'Laboratoire et maintenance', 'المخبر والصيانة والصيانة'),
(48, 'Laboratoire et maintenance', 'المخبر والصيانة والصيانة'),
(49, 'Laboratoire et maintenance', 'المخبر والصيانة والصيانة'),
(50, 'Laboratoire et maintenance', 'المخبر والصيانة والصيانة'),
(51, 'Laboratoire et maintenance', 'المخبر والصيانة والصيانة'),
(52, 'Corps des analystes de l\'économie', 'المحللين الاقتصاديين'),
(53, 'Corps des analystes de l\'économie', 'المحللين الاقتصاديين'),
(54, 'Corps des analystes de l\'économie', 'المحللين الاقتصاديين'),
(55, 'Administration générale', 'الإدارة العامة'),
(56, 'Administration générale', 'الإدارة العامة'),
(57, 'Traduction-interprétariat', 'الترجمة -الترجمة الفورية'),
(58, 'Informatique', 'الإعلام الآلي'),
(59, 'Informatique', 'الإعلام الآلي'),
(60, 'Statistiques', 'الإحصائيات'),
(61, 'Statistiques', 'الإحصائيات'),
(62, 'Documentation et archives', 'الوثائق والمحفوظات'),
(63, 'Documentation et archives', 'الوثائق والمحفوظات'),
(64, 'Laboratoire et maintenance', 'المخبر والصيان والصيانة'),
(65, 'Laboratoire et maintenance', 'المخبر والصيان والصيانة'),
(66, 'informatique', 'الاعلام الالي'),
(67, 'statistique', 'الاحصاء');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
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
INSERT INTO `fonctions` VALUES ('3bm','Directeur','مدير',1628),('b3m-1','Sous-directeur','مدير فرعي',1528);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logins`
--

LOCK TABLES `logins` WRITE;
/*!40000 ALTER TABLE `logins` DISABLE KEYS */;
INSERT INTO `logins` VALUES (1,'2025-07-29 10:01:02','2025-07-29 13:13:29',1254953,123,1),(2,'2025-07-29 10:01:15',NULL,1254953,123,1),(3,'2025-07-29 10:02:30',NULL,1254953,123,1),(4,'2025-07-29 10:16:39',NULL,1254953,123,1),(5,'2025-07-29 10:16:43',NULL,1254953,123,1),(6,'2025-07-29 10:38:33',NULL,1254953,123,1),(7,'2025-07-29 13:13:08',NULL,1254953,123,1),(8,'2025-07-29 13:13:55',NULL,1254953,123,1),(9,'2025-07-29 13:38:33',NULL,1254953,123,1),(10,'2025-07-29 13:48:07',NULL,1254953,123,1);
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
  `date_action` timestamp NOT NULL,
  PRIMARY KEY (`id_log`),
  KEY `logs_id_nin_foreign` (`id_nin`),
  KEY `logs_id_foreign` (`id`),
  CONSTRAINT `logs_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  CONSTRAINT `logs_id_nin_foreign` FOREIGN KEY (`id_nin`) REFERENCES `employes` (`id_nin`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'Ajouter Infos Personnelles Employé',109790646005040001,1,'notfound','2025-07-29 09:30:28'),(6,'Ajouter Infos Personnelles Employé',119591165001560006,1,'notfound','2025-07-29 10:09:41'),(7,'Ajouter Infos Personnelles Employé',119870581018230008,1,'notfound','2025-07-29 10:13:42'),(8,'Ajouter Infos Personnelles Employé',109460887028730002,1,'notfound','2025-07-29 11:21:51'),(9,'Ajouter Niveau Education Employé',109790646005040001,1,'notfound','2025-07-29 11:29:12'),(10,'Ajouter Niveau Education Employé',119870581018230008,1,'notfound','2025-07-29 11:29:41'),(11,'Ajouter Infos Personnelles Employé',119780586013040003,1,'notfound','2025-07-29 11:48:55');
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
  KEY `niveaux_id_post_foreign` (`id_post`),
  CONSTRAINT `niveaux_id_post_foreign` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `niveaux`
--

LOCK TABLES `niveaux` WRITE;
/*!40000 ALTER TABLE `niveaux` DISABLE KEYS */;
INSERT INTO `niveaux` VALUES (1,'Master 2','Génie Logiciel','','ماستر 2','الهندسة البرمجية',NULL,NULL,NULL,'',NULL),(2,'Master 2','Systèmes d’Information','','ماستر 2','نظم المعلومات',NULL,NULL,NULL,'',NULL),(3,'Master 2','Réseaux et Systèmes','','ماستر 2','الشبكات والأنظمة',NULL,NULL,NULL,'',NULL),(4,'Master 2','Sécurité Informatique','','ماستر 2','أمن المعلومات',NULL,NULL,NULL,'',NULL),(5,'Master 2','Science des Données','','ماستر 2','علم البيانات',NULL,NULL,NULL,'',NULL),(6,'Master 2','Intelligence Artificielle','','ماستر 2','الذكاء الاصطناعي',NULL,NULL,NULL,'',NULL),(7,'Master 2','Économie Internationale','','ماستر 2','الاقتصاد الدولي',NULL,NULL,NULL,'',NULL),(8,'Master 2','Économie du Développement','','ماستر 2','اقتصاد التنمية',NULL,NULL,NULL,'',NULL),(9,'Master 2','Sciences Commerciales','','ماستر 2','العلوم التجارية',NULL,NULL,NULL,'',NULL),(10,'Master 2','Marketing','','ماستر 2','التسويق',NULL,NULL,NULL,'',NULL),(11,'Master 2','Commerce International','','ماستر 2','التجارة الدولية',NULL,NULL,NULL,'',NULL),(12,'Master 2','Comptabilité','','ماستر 2','المحاسبة',NULL,NULL,NULL,'',NULL),(13,'Master 2','Audit et Contrôle','','ماستر 2','التدقيق والرقابة',NULL,NULL,NULL,'',NULL),(14,'Master 2','Banque et Assurance','','ماستر 2','البنوك والتأمين',NULL,NULL,NULL,'',NULL),(15,'Master 2','Gestion','','ماستر 2','التسيير',NULL,NULL,NULL,'',NULL),(16,'Master 2','Gestion des Ressources Humaines','','ماستر 2','تسيير الموارد البشرية',NULL,NULL,NULL,'',NULL),(17,'Master 2','Droit Public','','ماستر 2','القانون العام',NULL,NULL,NULL,'',NULL),(18,'Master 2','Droit Privé','','ماستر 2','القانون الخاص',NULL,NULL,NULL,'',NULL),(19,'Master 2','Droit Pénal','','ماستر 2','القانون الجنائي',NULL,NULL,NULL,'',NULL),(20,'Master 2','Droit Administratif','','ماستر 2','القانون الإداري',NULL,NULL,NULL,'',NULL),(21,'Master 2','Droit des Affaires','','ماستر 2','قانون الأعمال',NULL,NULL,NULL,'',NULL),(22,'Master 2','Droit Constitutionnel','','ماستر 2','القانون الدستوري',NULL,NULL,NULL,'',NULL),(23,'Master 2','Relations Internationales','','ماستر 2','العلاقات الدولية',NULL,NULL,NULL,'',NULL),(24,'Master 2','Psychologie Clinique','','ماستر 2','علم النفس السريري',NULL,NULL,NULL,'',NULL),(25,'Master 2','Psychologie Sociale','','ماستر 2','علم النفس الاجتماعي',NULL,NULL,NULL,'',NULL),(26,'Master 2','Neuropsychologie','','ماستر 2','علم النفس العصبي',NULL,NULL,NULL,'',NULL),(27,'Master 2','Sociologie Générale','','ماستر 2','علم الاجتماع العام',NULL,NULL,NULL,'',NULL),(28,'Master 2','Sociologie du Travail','','ماستر 2','علم اجتماع العمل',NULL,NULL,NULL,'',NULL),(29,'Master 2','Sociologie de l’Éducation','','ماستر 2','علم اجتماع التربية',NULL,NULL,NULL,'',NULL),(30,'Master 2','Histoire Contemporaine','','ماستر 2','التاريخ المعاصر',NULL,NULL,NULL,'',NULL),(31,'Master 2','Anthropologie','','ماستر 2','الأنثروبولوجيا',NULL,NULL,NULL,'',NULL),(32,'Master 2','Philosophie','','ماستر 2','الفلسفة',NULL,NULL,NULL,'',NULL),(33,'Master 2','Sciences de l\'Éducation','','ماستر 2','علوم التربية',NULL,NULL,NULL,'',NULL),(34,'Licence','Langue et Littérature Arabe','','ليسانس','اللغة والأدب العربي',NULL,NULL,NULL,'',NULL),(35,'Licence','Linguistique Arabe','','ليسانس','اللسانيات العربية',NULL,NULL,NULL,'',NULL),(36,'Licence','Langue et Littérature Française','','ليسانس','اللغة والأدب الفرنسي',NULL,NULL,NULL,'',NULL),(37,'Licence','Linguistique Française','','ليسانس','اللسانيات الفرنسية',NULL,NULL,NULL,'',NULL),(38,'Licence','FLE (Français Langue Étrangère)','','ليسانس','الفرنسية كلغة أجنبية (FLE)',NULL,NULL,NULL,'',NULL),(39,'Licence','Langue et Littérature Anglaise','','ليسانس','اللغة والأدب الإنجليزي',NULL,NULL,NULL,'',NULL),(40,'Licence','Linguistique Anglaise','','ليسانس','اللسانيات الإنجليزية',NULL,NULL,NULL,'',NULL),(41,'Licence','Traduction','','ليسانس','الترجمة',NULL,NULL,NULL,'',NULL),(42,'Licence','Langue Espagnole','','ليسانس','اللغة الإسبانية',NULL,NULL,NULL,'',NULL),(43,'Licence','Langue Allemande','','ليسانس','اللغة الألمانية',NULL,NULL,NULL,'',NULL),(44,'BTS / TS','Maintenance Industrielle','','تقني سام','الصيانة الصناعية',NULL,NULL,NULL,'',NULL),(45,'BTS / TS','Réseaux Informatiques','','تقني سام','الشبكات المعلوماتية',NULL,NULL,NULL,'',NULL),(46,'BTS / TS','Topographie','','تقني سام','الطبوغرافيا',NULL,NULL,NULL,'',NULL),(47,'BTS / TS','Électromécanique','','تقني سام','الإلكتروميكانيك',NULL,NULL,NULL,'',NULL),(48,'BTS / TS','Froid et Climatisation','','تقني سام','التبريد والتكييف',NULL,NULL,NULL,'',NULL),(49,'BTS / TS','Sécurité et Hygiène Industrielle','','تقني سام','السلامة والنظافة الصناعية',NULL,NULL,NULL,'',NULL),(50,'BTS / TS','Dessin de Bâtiment','','تقني سام','رسم البناء',NULL,NULL,NULL,'',NULL),(51,'null','null','','null','null',NULL,NULL,NULL,'',NULL),(52,'licence','/','','الليسانس','/',NULL,NULL,NULL,'',NULL);
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
  UNIQUE KEY `occupes_id_nin_unique` (`id_nin`),
  KEY `occupes_id_p_foreign` (`id_p`),
  KEY `occupes_id_post_foreign` (`id_post`),
  KEY `occupes_id_postsup_foreign` (`id_postsup`),
  KEY `occupes_id_fonction_foreign` (`id_fonction`),
  CONSTRAINT `occupes_id_fonction_foreign` FOREIGN KEY (`id_fonction`) REFERENCES `fonctions` (`id_fonction`),
  CONSTRAINT `occupes_id_nin_foreign` FOREIGN KEY (`id_nin`) REFERENCES `employes` (`id_nin`),
  CONSTRAINT `occupes_id_p_foreign` FOREIGN KEY (`id_p`) REFERENCES `employes` (`id_p`),
  CONSTRAINT `occupes_id_post_foreign` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id_post`),
  CONSTRAINT `occupes_id_postsup_foreign` FOREIGN KEY (`id_postsup`) REFERENCES `post_sups` (`id_postsup`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupes`
--

LOCK TABLES `occupes` WRITE;
/*!40000 ALTER TABLE `occupes` DISABLE KEYS */;
INSERT INTO `occupes` VALUES (4,'2024-07-03',13,254896989,256,20,'1N','1N','2024-07-03','CDI','New','1N',NULL,NULL),(10,'2024-04-14',13,1254953,123,2,'2N','1N5','2024-05-03','CDI','New','2N',NULL,NULL);
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
INSERT INTO `post_sups` VALUES (1,'chargé Reseaux','مكلف بالشبكات','1',140),(2,'chargé Systeme information','مكلف بانظمة المعلوماتية','3',214);
/*!40000 ALTER TABLE `post_sups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `Nom_post` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Grade_post` int NOT NULL,
  `Nom_post_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_secteur` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `posts_id_secteur_foreign` (`id_secteur`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` ( `Nom_post`, `Grade_post`, `Nom_post_ar`, `id_secteur`) VALUES
( 'Adjoint technique', 7, 'معاون تقني', 49),
( 'Technicien supérieur', 10, 'تقني سام', 48),
('Administrateur', 12, 'متصرف', 3),
('Administrateur principal', 14, 'متصرف  رئيسي', 4),
('Administrateur conseiller', 16, 'متصرف مستشار', 5),
('Attaché d\'administration', 9, 'ملحق الإدارة', 6),
('Attaché principal d\'administration', 10, 'ملحق رئيسي للإدارة', 7),
('Agent de bureau', 5, 'عون مكتب', 8),
('Agent d\'administration', 7, 'عون إدارة', 9),
('Agent principal d\'administration', 8, 'عون إدارة رئيسي', 10),
('Agent de saisie', 5, 'عون حفظ البيانات', 11),
('Secrétaire', 6, 'كاتب', 12),
('Secrétaire  de direction', 8, 'كاتب مديرية', 13),
('Secrétaire  principal de direction', 10, 'كاتب مديرية رئيسي', 14),
('Aide-comptable administratif', 5, 'مساعد محاسب إداري', 15),
('Comptable administratif', 8, 'محاسب إداري', 16),
('Comptable administratif principal', 10, 'محاسب إداري رئيسي', 17),
('Traducteur-interprète', 12, 'المترجم - الترجمان', 18),
('Traducteur-interprète principal', 14, 'المترجم - الترجمان الرئيسي', 19),
('Traducteur-interprète en chef', 16, 'رئيس المترجمين- التراجمة', 20),
('Ingénieur d\'application', 11, 'المهندسون التطبيقيون', 21),
('Ingénieur d\'Etat', 13, 'مهندسو الدولة', 22),
('Ingénieur principal', 14, 'المهندسون الرئيسيون', 23),
('Ingénieur  en chef', 16, 'رئيس المهندسين', 24),
( 'Technicien', 8, 'تقني', 25),
( 'Technicien supérieur', 10, 'تقني سام', 26),
( 'Adjoint technique', 7, 'معاون تقني', 27),
( 'Agent technique', 5, 'عون تقني', 28),
( 'Ingénieur d\'application', 11, 'المهندسون التطبيقيون', 29),
( 'Ingénieur d\'Etat', 13, 'مهندسو الدولة', 30),
( 'Ingénieur principal', 14, 'المهندسون الرئيسيون', 31),
( 'Ingénieur  en chef', 16, 'رئيس المهندسين', 32),
( 'Technicien', 8, 'تقني', 33),
( 'Technicien supérieur', 10, 'تقني سام', 34),
( 'Adjoint technique', 7, 'معاون تقني', 35),
( 'Agent technique', 5, 'عون تقني', 36),
( 'Documentaliste-archiviste', 12, 'وثائقي أمين محفوظات', 37),
( 'Documentaliste-archiviste principal', 14, 'وثائقي أمين محفوظات رئيسي', 38),
( 'Documentaliste-archiviste  en chef', 16, 'رئيس الوثائقيين أمناء المحفوظات', 39),
('Documentaliste-archiviste  en chef', 16, 'رئيس الوثائقيين أمناء المحفوظات', 40),
( 'Assistant documentaliste-archiviste', 10, 'مساعد وثائقي أمين محفوظات', 41),
( 'Agent technique en documentation et archives', 7, 'عون تقني في الوثائق والمحفوظات', 42),
( 'Ingénieur d\'application', 11, 'مهندس تطبيقي', 43),
( 'Ingénieur d\'Etat', 13, 'مهندس دولة', 44),
( 'Ingénieur principal', 14, 'مهندس رئيسي', 45),
( 'Ingénieur  en chef', 16, 'رئيس المهندسين', 46),
( 'Technicien', 8, 'تقني', 47),
( 'Agent technique', 5, 'عون تقني', 50),
( 'Agent de laboratoire', 4, 'عون مخبر', 51),
( 'Analyste de l\'économie', 12, 'محلل اقتصادي', 52),
( 'Analyste principal', 14, 'محلل رئيسي', 53),
( 'Analyste en chef', 16, 'رئيس المحللين', 54),
( 'administrateur analyste', 13, 'متصرف محلل', 55),
( 'Assistant administrateur', 11, 'مساعد متصرف', 56),
( 'Traducteur-interprète spécialisé', 13, 'المترجم-الترجمان المتخصص', 57),
( 'Assistant ingénieur de niveau 1', 11, 'مساعد مهندس مستوى 1', 58),
( 'Assistant ingénieur de niveau 2', 12, 'مساعد مهندس مستوى 2', 59),
( 'Assistant ingénieur de niveau 1', 11, 'مساعد مهندس مستوى 1', 60),
( 'Assistant ingénieur de niveau 2', 12, 'مساعد مهندس مستوى2', 61),
('Documentaliste-archiviste analyste', 13, 'وثــــائــــقـي أمـــين مـــــحــــفــــوظــــات محلل', 62),
( 'Assistant documentaliste-archiviste principal', 11, 'مــــــــســـــــــاعـــــــــد وثــــــــائـــــــــقـي أمـــــــين محفوظات رئيسي', 63),
( 'Assistant ingénieur de niveau 1', 11, 'مساعد مهندس مستوى 1', 64),
( 'Assistant ingénieur de niveau 2', 12, 'مساعد مهندس مستوى 2', 65);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


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
  KEY `secteurs_id_filiere_foreign` (`id_filiere`),
  CONSTRAINT `secteurs_id_filiere_foreign` FOREIGN KEY (`id_filiere`) REFERENCES `filieres` (`id_filiere`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Structure de la table `secteurs`
--

DROP TABLE IF EXISTS `secteurs`;
CREATE TABLE IF NOT EXISTS `secteurs` (
  `id_secteur` int NOT NULL AUTO_INCREMENT,
  `Nom_secteur` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nom_secteur_ar` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_filiere` int NOT NULL,
  PRIMARY KEY (`id_secteur`),
  KEY `secteurs_id_filiere_foreign` (`id_filiere`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `secteurs`
--

INSERT INTO `secteurs` (`id_secteur`, `Nom_secteur`, `Nom_secteur_ar`, `id_filiere`) VALUES
(1, 'ingénierie', 'سلك المهندسين', 1),
(2, 'téchnicien', 'سلك التقنيون', 1),
(3, 'Administrateurs', 'المتصرفون', 3),
(4, 'Administrateurs', 'المتصرفون', 4),
(5, 'Administrateurs', 'المتصرفون', 5),
(6, 'Attachés d\'administration', 'ملحقو الإدارة', 6),
(7, 'Attachés d\'administration', 'ملحقو الإدارة', 7),
(8, 'Agents d\'administration', 'أعوان الإدارة', 8),
(9, 'Agents d\'administration', 'أعوان الإدارة', 9),
(10, 'Agents d\'administration', 'أعوان الإدارة', 10),
(11, 'Secrétaires', 'الكتاب', 11),
(12, 'Secrétaires', 'الكتاب', 12),
(13, 'Secrétaires', 'الكتاب', 13),
(14, 'Secrétaires', 'الكتاب', 14),
(15, 'Comptables administratifs', 'المحاسبون الإداريون', 15),
(16, 'Comptables administratifs', 'المحاسبون الإداريون', 16),
(17, 'Comptables administratifs', 'المحاسبون الإداريون', 17),
(18, 'Traducteurs interprètes', 'المترجمون - التراجمة', 18),
(19, 'Traducteurs interprètes', 'المترجمون - التراجمة', 19),
(20, 'Traducteurs interprètes', 'المترجمون - التراجمة', 20),
(21, 'Ingénieurs', 'المهندسون', 21),
(22, 'Ingénieurs', 'المهندسون', 22),
(23, 'Ingénieurs', 'المهندسون', 23),
(24, 'Ingénieurs', 'المهندسون', 24),
(25, 'Techniciens', 'التقنيون', 25),
(26, 'Techniciens', 'التقنيون', 26),
(27, 'Adjoints techniques', 'المعاونون التقنيون', 27),
(28, 'Agents techniques', 'الأعوان التقنيون', 28),
(29, 'Ingénieurs', 'المهندسون', 29),
(30, 'Ingénieurs', 'المهندسون', 30),
(31, 'Ingénieurs', 'المهندسون', 31),
(32, 'Ingénieurs', 'المهندسون', 32),
(33, 'Techniciens', 'التقنيون', 33),
(34, 'Techniciens', 'التقنيون', 34),
(35, 'Adjoints techniques', 'المعاونون التقنيون', 35),
(36, 'Agents techniques', 'الأعوان التقنيون', 36),
(37, 'Documentalistes- archivistes', 'الوثائقيون أمناء المحفوظات', 37),
(38, 'Documentalistes- archivistes', 'الوثائقيون أمناء المحفوظات', 38),
(39, 'Documentalistes- archivistes', 'الوثائقيون أمناء المحفوظات', 39),
(40, 'Documentalistes- archivistes', 'الوثائقيون أمناء المحفوظات', 40),
(41, 'Assistants documentalistes archivistes', 'مـــســــاعـــدو الـــوثــــائـــقـــيــــين أمـــنـــاء المحفوظات', 41),
(42, 'Agents techniques en documentation et archives', 'الأعـوان الـتـقـنـيـون في الـوثـائق والمحفوظات', 42),
(43, 'Ingénieurs', 'المهندسون', 43),
(44, 'Ingénieurs', 'المهندسون', 44),
(45, 'Ingénieurs', 'المهندسون', 45),
(46, 'Ingénieurs', 'المهندسون', 46),
(47, 'Techniciens', 'التقنيون', 47),
(48, 'Techniciens', 'التقنيون', 48),
(49, 'Adjoints techniques', 'المعاونون التقنيون', 49),
(50, 'Agents techniques', 'الأعوان التقنيون', 50),
(51, 'Agents de laboratoire', 'أعوان المخبر', 51),
(52, 'Analystes de l\'économie', 'المحللون الاقتصاديون', 52),
(53, 'Analystes de l\'économie', 'المحللون الاقتصاديون', 53),
(54, 'Analystes de l\'économie', 'المحللون الاقتصاديون', 54),
(55, 'Administrateurs', 'المتصرفون', 55),
(56, 'Assistants administrateurs', 'مساعدو المتصرفين', 56),
(57, 'Traducteurs-interprètes', 'المترجمون - التراجمة', 57),
(58, 'Assistants ingénieurs', 'مساعدو المهندسين', 58),
(59, 'Assistants ingénieurs', 'مساعدو المهندسين', 59),
(60, 'Assistants ingénieurs', 'مساعدو المهندسين', 60),
(61, 'Assistants ingénieurs', 'مساعدو المهندسين', 61),
(62, 'Documentalistes-archivistes', 'الوثائقيون أمناء المحفوظات', 62),
(63, 'Assistants documentalistes-archivistes', 'مساعدو الوثائقيين أمناء المحفوظات', 63),
(64, 'Assistants ingénieurs', 'مساعدو المهندسين', 64),
(65, 'Assistants ingénieurs', 'مساعدو المهندسين', 65);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


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
INSERT INTO `sessions` VALUES ('1bXEBrbs8bmxFWz6UPC7feaRdG8XqtlxcLK0bQyL',NULL,'192.168.6.51','Mozilla/5.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHpPaHd5dDZTVlh2VFFPNE1TbTlHNUptdDB2MVpZSU5IazREU0FFOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly8xOTIuMTY4LjYuMjQzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1753789603),('dokhHCLPOi97xutbhw1yWUc8YehWrIKYuAgspEXP',1,'192.168.6.143','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWWcyak12M1kxNGpZcHl5dmNDYVVMZGx4cUdYaDZMczNsdlllbVNDMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTg6Imh0dHA6Ly8xOTIuMTY4LjYuMjQzL0VtcGxveWUvSXNUcmF2YWlsbC8xMTk3ODA1ODYwMTMwNDAwMDMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NjoibG9jYWxlIjtzOjI6ImFyIjt9',1753793337),('E0c3hGeLyIUR3x953w3lOjShMjjKSq56RLisfJYX',NULL,'192.168.6.51','','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMG51amhKNHFSU0xacHNUZkh3VzBxMlZKTTJwVzFuTGt1MllXeUc2cyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly8xOTIuMTY4LjYuMjQzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1753789643),('mpqWJKTEsX9JzkWWLFwC6BVCeGJS274YaQXQXsbn',1,'192.168.6.24','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRFRRTkQyOEpybm5WV25OM3JYVkFoRmVucGpvUkFmVEFPS1NhS2IzViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xOTIuMTY4LjYuMjQzL2V4cG9ydFBkZiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1753794843),('OJaoxONO0cRqyk4yT0ROJL5CwNyiWgIjOVwwoQIR',1,'192.168.6.130','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoib0I4bXc3THM4eTBiRHVzNUQwazJhZGYxTXZ1NzJVV2dDOGxVU0VYSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xOTIuMTY4LjYuMjQzL2FkZF9wb3N0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo2OiJsb2NhbGUiO3M6MjoiYXIiO30=',1753793002),('YrDGtzhwgT7YkulhrgauOERK5nliIRm0ebBCJQQl',NULL,'192.168.6.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTWVUSW8yU3VOcUNaWjl3VXpuSTE1b1Nma1NwQ1k3cG0zeDhBYWgwaCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMDoiaHR0cDovLzE5Mi4xNjguNi4yNDMvYWRkX3Bvc3RlIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xOTIuMTY4LjYuMjQzL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1753795637),('YUzG7yqGl8WJOj6bxaS33X9jltoq65SZMF9r9W3i',1,'192.168.6.57','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUGlLSmJrODJZYnJsM1Bod1cxc3NkTEc0M2lNSlk1Rms1U3pFS2I3WiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xOTIuMTY4LjYuMjQzL0VtcGxveWUvSXNFZHVjYXQvMTI1NDk1MyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1753796917),('yVvcdFV726wbN5TPkCdEDFuWC9mw1GzeyShpF53c',1,'192.168.6.58','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQUVIdFlhSFo5azA2RXpwemxTemRGSHhjSTh2c0VZZ2trVjFYWE5YYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xOTIuMTY4LjYuMjQzL0VtcGxveWUvSXNFZHVjYXQvMTI1NDk1MyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1753797383);
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sous_departements`
--

LOCK TABLES `sous_departements` WRITE;
/*!40000 ALTER TABLE `sous_departements` DISABLE KEYS */;
INSERT INTO `sous_departements` VALUES (10,2,'prsonnl','psnll','المستخدمين','المستخدمين'),(15,1,'dev','dev','تطوير','تطوير');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocke`
--

LOCK TABLES `stocke` WRITE;
/*!40000 ALTER TABLE `stocke` DISABLE KEYS */;
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
  UNIQUE KEY `travails_id_nin_unique` (`id_nin`),
  KEY `travails_id_sous_depart_foreign` (`id_sous_depart`),
  KEY `travails_id_p_foreign` (`id_p`),
  KEY `travails_id_bureau_foreign` (`id_bureau`),
  CONSTRAINT `travails_id_bureau_foreign` FOREIGN KEY (`id_bureau`) REFERENCES `bureaus` (`id_bureau`),
  CONSTRAINT `travails_id_nin_foreign` FOREIGN KEY (`id_nin`) REFERENCES `employes` (`id_nin`),
  CONSTRAINT `travails_id_p_foreign` FOREIGN KEY (`id_p`) REFERENCES `employes` (`id_p`),
  CONSTRAINT `travails_id_sous_depart_foreign` FOREIGN KEY (`id_sous_depart`) REFERENCES `sous_departements` (`id_sous_depart`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travails`
--

LOCK TABLES `travails` WRITE;
/*!40000 ALTER TABLE `travails` DISABLE KEYS */;
INSERT INTO `travails` VALUES (14,'2023-07-01','2024-07-01',17,254896989,10,256,5),(20,'2024-04-14','2024-04-14',20,1254953,15,123,5);
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

-- Dump completed on 2025-07-29 15:43:42
