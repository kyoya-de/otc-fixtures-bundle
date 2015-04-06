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

        $languageEn = new Language();
        $languageEn->setName("English");
        $languageEn->setLocale("en_US");
        $languageEn->setActive(true);
        $languageEn->setId(1);
        $manager->persist($languageEn);

        $languageDe = new Language();
        $languageDe->setName("Deutsch");
        $languageDe->setLocale("de_DE");
        $languageDe->setActive(true);
        $languageDe->setId(2);
        $manager->persist($languageDe);

        $project = new Project();
        $project->setId(1);
        $project->setName("TestProject");
        $project->setEmail("info@kyoya.de");
        $project->setFillUntranslated(true);
        $project->setUrl("http://otrance.org/");
        $project->setDefaultLanguage($languageEn);
        $manager->persist($project);

        $keyGroup = new KeyGroup();
        $keyGroup->setId(1);
        $keyGroup->setName("Group 1");
        $keyGroup->setProject($project);
        $manager->persist($keyGroup);

        $languageKey = new LanguageKey();
        $languageKey->setId(1);
        $languageKey->setName("LANG_KEY_1");
        $languageKey->setKeyGroup($keyGroup);
        $manager->persist($languageKey);

        $translationEn = new Translation();
        $translationEn->setLanguage($languageEn);
        $translationEn->setLanguageKey($languageKey);
        $translationEn->setTranslation("Translated language key 1");
        $manager->persist($translationEn);

        $translationDe = new Translation();
        $translationDe->setLanguage($languageDe);
        $translationDe->setLanguageKey($languageKey);
        $translationDe->setTranslation("Translated language key 1");
        $manager->persist($translationDe);
    }
}
