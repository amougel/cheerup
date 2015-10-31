<?php

namespace UserBundle\DataFixtures\ORM;

use AppBundle\Entity\Aggregate;
use AppBundle\Entity\Group;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $rawUsers = [
            'user1'   => 'user1',
            'Bob'     => 'Dylan',
            'Marcel'  => 'Pagnol',
            'George'  => 'Lucas',
            'Mourad'  => 'Kashi',
            'OuiOui'  => 'EtSaVoitureJauneEtRouge',
            'LaPoule' => 'AuxOeufsDOr',
            'Johnny'  => 'Vacances',
        ];

        foreach ($rawUsers as $firstname => $lastname) {
            $manager->persist($this->createUser($firstname, $lastname));
        }

        $offshoot = $this->getReference('offshoot');
        $manager->persist($this->createUser('Julien', 'Vallini', $offshoot));

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }

    /**
     * @param string $firstname
     * @param string $lastname
     * @param Group  $offshoot
     *
     * @return User
     */
    private function createUser($firstname, $lastname, $offshoot = null)
    {
        $user = new User();
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setPlainPassword($firstname);
        $user->setEmail($firstname.'@mail.com');
        $user->setEnabled(true);

        if ($offshoot) {
            $user->setProfileType(User::FORMER_MEMBER);
            $user->setOffshootOfOrigin($offshoot);
        } else {
            $user->setProfileType(User::NETWORK_VOLUNTEER);
        }

        return $user;
    }
}
