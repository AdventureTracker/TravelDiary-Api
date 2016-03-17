<?php

namespace TravelDiary\ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StatusControllerTest extends WebTestCase
{
    public function testStatus()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/status');
    }

}
