<?php

/**
 * All Rights Reserved
 * @copyright Copyright (C) Michal Talar
 */

namespace App\Service;

class CityService
{
    /**
     * @return string[]
     */
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
            'Wrocław',
        ];
    }

    /**
     * @param string $searchCity
     *
     * @return array
     */
    public function searchForCity(string $searchCity): array
    {
        $results = [];
        foreach ($this->dataCities() as $city) {
            if (str_contains($city, $searchCity)) {
                $results[] = $city;
            }
        }
        return $results;
    }
}
