<?php

namespace TravelDiary\InterfaceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TripRecordControllerTest extends WebTestCase
{
    public function testView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip/{trip_id}/record/{record_id}');
    }

    public function testRemove()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip/{trip_id}/record/remove/{record_id}');
    }

    public function testForm()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip/{trip_id}/record/edit/{record_id}');
    }

    public function testProcess()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/trip/{trip_id}/record/{record_id}');
    }

}
