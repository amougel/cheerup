<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client  = SecurityControllerTest::getLoggedInClient('user1@mail.com', 'user1');
        $client->request('GET', '/profile');
        $baseUrl = $client->getKernel()->getContainer()->getParameter('hostname');

        $this->assertEquals(true, $client->getResponse()->isRedirect('http://'.$baseUrl.'/profile/'));
        $client->followRedirect();

        $this->assertEquals(true, $client->getResponse()->isSuccessful());
    }
}
