<?php
namespace App\Tests\Service;

use App\Service\CityService;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class CityServiceTest extends TestCase
{
    public static function getProperCityProvider(): \Generator
    {
        $cities = [
            'Kozy', // kozy is almost a city
            'Bielsko-Biała',
            'Bielsk Podlaski',
            'Andrychów',
            'Warszawa',
            'Kołobrzeg',
            'Kraków',
            'Opole',
            'Wrocław'
        ];
        foreach ($cities as $city) {
            yield [$city];
        }
    }

    public static function getImproperCityProvider(): \Generator
    {
        $villages = [
            'Rzyki',
            'Targanice',
            'Bolęcina',
        ];

        foreach ($villages as $village) {
            yield [$village];
        }
    }

    #[DataProvider('getProperCityProvider')]
    public function testSearchForCityValid(string $city): void
    {
        $cityService = new CityService();
        $result = $cityService->searchForCity($city);
        $this->assertNotEmpty($result);
    }

    #[DataProvider('getImproperCityProvider')]
    public function testSearchForCityInvalid(string $village): void
    {
        $cityService = new CityService();
        $result = $cityService->searchForCity($village);
        $this->assertEmpty($result);
    }
}