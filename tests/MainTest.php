<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class MainTest extends TestCase
{
    private $client;

    public function setUp(): void
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8080'
        ]);
    }

    public function testIndex()
    {
        $expected = 'Welcome to Slim!';
        $response = $this->client->get('/');
        $this->assertSame($expected, $response->getBody()->getContents());
    }
}
