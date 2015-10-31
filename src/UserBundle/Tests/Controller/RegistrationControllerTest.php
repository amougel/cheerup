<?php

namespace AppBundle\Tests\Controller;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegisterPage()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/register/');
        $this->assertTrue($client->getResponse()->isSuccessful());

        $container = $client->getContainer();
        $userManager        = $container->get('fos_user.user_manager');
        $user      = $userManager->findUserByUsername('usertest@mail.com');
        $this->deleteUserIfHeExists($userManager, $user);

        $form = $crawler->selectButton('_submit')->form();
        $form['fos_user_registration_form[email]'] = 'usertest@mail.com';
        $form['fos_user_registration_form[plainPassword][first]'] = 'usertestpw';
        $form['fos_user_registration_form[plainPassword][second]'] = 'usertestpw';
        $form['fos_user_registration_form[profileType]'] = 'NETWORK_VOLUNTEER';
        $form['fos_user_registration_form[firstname]'] = 'usertestfn';
        $form['fos_user_registration_form[lastname]'] = 'usertestln';

        $crawler = $client->submit($form);

        $this->assertEquals(true, $client->getResponse()->isRedirect('/register/check-email'));
        $this->deleteUserIfHeExists($userManager, $user);
    }

    /**
     * @param UserManager $userManager
     * @param UserInterface $user
     */
    private function deleteUserIfHeExists ($userManager, $user)
    {
        if ($user) {
            $userManager->deleteUser($user);
        }
    }
}
