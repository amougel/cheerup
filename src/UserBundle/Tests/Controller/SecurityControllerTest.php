<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $baseUrl = $client->getKernel()->getContainer()->getParameter('hostname');

        // Base url is needed here. It actually depends on the format of the location attribute retrieved
        // from the reponses header
        $this->assertEquals(true, $client->getResponse()->isRedirect('http://'.$baseUrl.'/login'));
    }

    public function testLoginPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertContains('Connexion', $crawler->text());
        $this->assertContains('Pas encore inscrit ?', $crawler->text());
    }

    public function testLoginSubmit()
    {
        $client = $this->getLoggedInClient('user1@mail.com', 'user1');
        $baseUrl = $client->getKernel()->getContainer()->getParameter('hostname');

        $this->assertEquals(true, $client->getResponse()->isRedirect('http://'.$baseUrl.'/'));
    }

    public static function getLoggedInClient($username, $password)
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = $username;
        $form['_password'] = $password;

        $client->submit($form);

        return $client;
    }
}
