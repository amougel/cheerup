<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use UserBundle\Entity\Group;
use UserBundle\Entity\SecurityGroup;
use UserBundle\Entity\User;

class InitDbCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:init:db')
            ->setDescription('Initialize database with required data')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entityManager = $this->getContainer()->get('doctrine')->getManager();

        $adminUserList = $entityManager->getRepository('UserBundle:User')->findByEmail('admin');
        $adminUser = array_pop($adminUserList);
        if ($adminUser)
            $entityManager->remove($adminUser);

        $adminSecurityGroupList = $entityManager->getRepository('UserBundle:SecurityGroup')->findByName('admin');
        $adminSecurityGroup = array_pop($adminSecurityGroupList);
        if ($adminSecurityGroup)
            $entityManager->remove($adminSecurityGroup);

        $entityManager->flush();
        $output->writeln('Existing entities removed');

        $adminSecurityGroup = new SecurityGroup('admin');
        $adminSecurityGroup->addRole('ROLE_ADMIN');
        $adminUser = new User();
        $adminUser->setEnabled(true);
        $adminUser->setUsername('admin');
        $adminUser->setEmail('admin');
        $adminUser->setPlainPassword('admin');
        $adminUser->setFirstname('admin');
        $adminUser->setLastname('admin');
        $adminUser->setValidated(true);
        $adminUser->setProfileType(User::NETWORK_VOLUNTEER);
        $adminUser->addSecurityGroup($adminSecurityGroup);

        $entityManager->persist($adminSecurityGroup);
        $entityManager->persist($adminUser);
        $entityManager->flush();

        $output->writeln('Database successfully initialized');
    }
}
