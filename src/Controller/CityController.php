<?php

namespace App\Controller;

use App\Entity\SearchCity;
use App\Service\CityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Type\SearchCityType;
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
        }

        return $this->render('city/search.html.twig', [
            'form' => $form,
            'cities' => $cities,
            'showResults' => count($cities) > 0,
        ]);
    }
}