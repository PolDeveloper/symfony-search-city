<?php

namespace App\Controller;

use App\Entity\SearchCity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Type\SearchCityType;
use App\Entity\City;

class CityController extends AbstractController
{
    public function search(Request $request): Response
    {
        $search = new SearchCity();

        $form = $this->createForm(SearchCityType::class, $search);

        $form->handleRequest($request);

        $showResults = false;
        $cities = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $city = $form->getData()->getCity();
            $cities = (new City)->searchForCity($city);
            $showResults = true;
        }

        return $this->renderForm('city/search.html.twig', [
            'form' => $form,
            'cities' => $cities,
            'showResults' => $showResults
        ]);
    }
}