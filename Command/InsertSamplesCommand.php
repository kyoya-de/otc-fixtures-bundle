<?php

namespace Otc\Bundle\FixturesBundle\Command;

use Otc\CoreBundle\Entity\KeyGroup;
use Otc\CoreBundle\Entity\Language;
use Otc\CoreBundle\Entity\LanguageKey;
use Otc\CoreBundle\Entity\Project;
use Otc\CoreBundle\Entity\Translation;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InsertSamplesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('otc:fixtures:insert')
            ->setDescription('Inserts oTranCe fixtures for development.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var \Doctrine\Bundle\DoctrineBundle\Registry $doctrine */
        $doctrine = $this->getContainer()->get('doctrine');
        /** @var \Doctrine\Common\Persistence\ObjectManager $manager */
        $manager = $doctrine->getManager();

        $this->importByEntities($manager);

        // $this->importByDump($doctrine);
    }

    /**
     * @param $doctrine
     */
    private function importByDump($doctrine)
    {
        $dump = <<<'EOMD'
-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: otc_dev
-- ------------------------------------------------------
-- Server version       5.5.41-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `KeyGroup`
--

DROP TABLE IF EXISTS `KeyGroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KeyGroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `search_project` (`project`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `KeyGroup`
--

LOCK TABLES `KeyGroup` WRITE;
/*!40000 ALTER TABLE `KeyGroup` DISABLE KEYS */;
INSERT INTO `KeyGroup` VALUES (2,1,'Group 1');
/*!40000 ALTER TABLE `KeyGroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Language`
--

DROP TABLE IF EXISTS `Language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `flag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `search_locale` (`locale`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Language`
--

LOCK TABLES `Language` WRITE;
/*!40000 ALTER TABLE `Language` DISABLE KEYS */;
INSERT INTO `Language` VALUES (1,1,'en_US','English',''),(2,1,'de_DE','Deutsch','');
/*!40000 ALTER TABLE `Language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LanguageKey`
--

DROP TABLE IF EXISTS `LanguageKey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LanguageKey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keyGroup` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `search_key` (`keyGroup`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LanguageKey`
--

LOCK TABLES `LanguageKey` WRITE;
/*!40000 ALTER TABLE `LanguageKey` DISABLE KEYS */;
INSERT INTO `LanguageKey` VALUES (3,'LANG_KEY_1',1);
/*!40000 ALTER TABLE `LanguageKey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Project`
--

DROP TABLE IF EXISTS `Project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fillUntranslated` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `search_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Project`
--

LOCK TABLES `Project` WRITE;
/*!40000 ALTER TABLE `Project` DISABLE KEYS */;
INSERT INTO `Project` VALUES (1,'TestProject','info@kyoya.de','http://otrance.org/','',1);
/*!40000 ALTER TABLE `Project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Translation`
--

DROP TABLE IF EXISTS `Translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Translation` (
  `language` int(11) NOT NULL,
  `languageKey` int(11) NOT NULL,
  `translation` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lastUpdate` datetime NOT NULL,
  PRIMARY KEY (`languageKey`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Translation`
--

LOCK TABLES `Translation` WRITE;
/*!40000 ALTER TABLE `Translation` DISABLE KEYS */;
INSERT INTO `Translation` VALUES (1,1,'Translated language key 1','2015-04-07 01:48:15'),(2,1,'Übersetzter Sprach-Key 1','2015-04-07 01:48:52');
/*!40000 ALTER TABLE `Translation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-06 23:49:22

EOMD;

        $doctrine->getConnection()->exec($dump);
    }

    /**
     * @param $manager
     */
    private function importByEntities($manager)
    {
        $languageEn = new Language();
        $languageEn->setName('English');
        $languageEn->setActive(true);
        $languageEn->setLocale('en_US');
        $manager->persist($languageEn);

        $languageDe = new Language();
        $languageDe->setName('Deutsch');
        $languageDe->setActive(true);
        $languageDe->setLocale('de_DE');
        $manager->persist($languageDe);
        $manager->flush();

        $project = new Project();
        $project->setName('TestProject');
        $project->setEmail('info@kyoya.de');
        $project->setUrl('https://github.com/kyoya-de/oTranCe');
        $project->setFillUntranslated(false);
        $project->setDefaultLanguage($languageEn);
        $manager->persist($project);
        $manager->flush();

        $keyGroup = new KeyGroup();
        $keyGroup->setName('Main Key Group');
        $keyGroup->setProject($project);
        $manager->persist($keyGroup);
        $manager->flush();

        $languageKey = new LanguageKey();
        $languageKey->setName('FIRST_KEY');
        $languageKey->setKeyGroup($keyGroup);
        $manager->persist($languageKey);
        $manager->flush();

        $translationEn = new Translation();
        $translationEn->setLanguage($languageEn);
        $translationEn->setLanguageKey($languageKey);
        $translationEn->setTranslation("First language key");
        $manager->persist($translationEn);
        $manager->flush();

        $translationDe = new Translation();
        $translationDe->setLanguage($languageDe);
        $translationDe->setLanguageKey($languageKey);
        $translationDe->setTranslation("First language key");
        $manager->persist($translationDe);
        $manager->flush();
    }
}
