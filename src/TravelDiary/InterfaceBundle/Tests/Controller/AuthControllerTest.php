<?php

namespace TravelDiary\InterfaceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthControllerTest extends WebTestCase
{
    public function testRegister()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/auth/registration');
    }

    public function testLostpassword()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/auth/lost-password');
    }

}
