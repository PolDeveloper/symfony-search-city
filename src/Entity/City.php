<?php

namespace App\Entity;

class City
{
    private function dataCities(): array
    {
        return [
            'Kozy', // Is Kozy a city?
            'Bielsko-Biała',
            'Bielsk Podlaski',
            'Andrychów',
            'Warszawa',
            'Kołobrzeg',
            'Kraków',
            'Opole',
            'Wrocław'
        ];
    }

    public function searchForCity(string $searchCity): array
    {
        $results = [];
        foreach ($this->dataCities() as $city) {
            if (strpos($city, $searchCity) !== false) {
                $results[] = $city;
            }
        }
        return $results;
    }
}
