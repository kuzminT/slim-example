<?php


namespace App\Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Exception\ClientException;

class GetCompaniesByIdTest extends TestCase
{
    private $client;

    public function setUp(): void
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8080'
        ]);
    }

    public function testCompanies1()
    {
        $response = $this->client->get('/companies/1');
        $body = $response->getBody()->getContents();

        $data = json_decode($body);
        $this->assertObjectHasAttribute('name', $data);
        $this->assertObjectHasAttribute('id', $data);
        $this->assertEquals(1, $data->id);
    }

    public function testCompanies2()
    {
        $response = $this->client->get('/companies/98');
        $body = $response->getBody()->getContents();

        $data = json_decode($body);
        $this->assertObjectHasAttribute('phone', $data);
        $this->assertObjectHasAttribute('id', $data);
        $this->assertEquals(98, $data->id);
    }

    public function testCompanies3()
    {
        $this->expectException(ClientException::class);
        $this->client->get('/companies/12341234');
    }
}