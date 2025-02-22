<?php

/**
 * All Rights Reserved
 * @copyright Copyright (C) Michal Talar
 */

namespace App\Controller;

use App\Form\Type\SearchCityType;
use App\Model\SearchCity;
use App\Service\CityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CityController extends AbstractController
{
    #[Route('/', name: 'app_lucky_number', methods: ['GET', 'POST'])]
    public function search(Request $request, CityService $cityService): Response
    {
        $searchCity = new SearchCity();

        $form = $this->createForm(SearchCityType::class, $searchCity);

        $form->handleRequest($request);

        $cities = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $cities = $cityService->searchForCity($searchCity->getCity());
            $showResults = true;
        }

        return $this->render('city/search.html.twig', [
            'form' => $form,
            'cities' => $cities,
            'showResults' => $showResults ?? false,
        ]);
    }
}
