<?php

namespace TravelDiary\InterfaceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TripControllerTest extends WebTestCase
{
    public function testOverview()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trips/{page}');
    }

    public function testForm()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip/create');
    }

    public function testProcess()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip/process/{id}');
    }

    public function testView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip/{id}');
    }

    public function testRemove()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip/remove/{id}');
    }

}
