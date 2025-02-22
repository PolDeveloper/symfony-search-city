<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CityControllerTest extends WebTestCase
{
    public function testSearchControllerResponseOK(): void
    {
        $client = self::createClient();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Search City');
    }

    public function testSearchControllerResponse404(): void
    {
        $client = self::createClient();
        $client->request('GET', '/some-bad-url');
        $this->assertResponseStatusCodeSame(404);
    }
}