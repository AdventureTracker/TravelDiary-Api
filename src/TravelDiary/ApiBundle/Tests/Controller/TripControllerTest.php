<?php

namespace TravelDiary\ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TripControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip');
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip/{trip_id}');
    }

    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trips');
    }

    public function testGet()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip/{trip_id}');
    }

    public function testRemove()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip/{trip_id}');
    }

}
