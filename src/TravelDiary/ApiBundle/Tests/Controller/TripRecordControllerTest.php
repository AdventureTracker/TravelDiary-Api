<?php

namespace TravelDiary\ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TripRecordControllerTest extends WebTestCase
{
    public function testProcess()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip/{idTrip}/record');
    }

    public function testRemove()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip/{idTrip}/record/{idTripRecord}');
    }

    public function testDetail()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip/{idTrip}/record/{idTripRecord}');
    }

}
