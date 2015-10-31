<?php

namespace UserBundle\DataFixtures\ORM;

use AppBundle\Entity\Group;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;

class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $group1 = new Group();
        $group1->setOffshoot(true);
        $group1->setName('Première Antenne');
        $group1->setDescription('Voici la description de l\'antenne 1');

        $group2 = new Group();
        $group2->setOffshoot(true);
        $group2->setName('Deuxième Antenne');
        $group2->setDescription('Voici la description de l\'antenne 2');

        $this->addReference('offshoot', $group2);

        $group3 = new Group();
        $group3->setName('Premier Groupe');
        $group3->setDescription('Voici la description du groupe 1');

        $manager->persist($group1);
        $manager->persist($group2);
        $manager->persist($group3);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
