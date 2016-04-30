<?php

namespace TravelDiary\InterfaceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MonitorControllerTest extends WebTestCase
{
    public function testOverview()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/monitor');
    }

}
