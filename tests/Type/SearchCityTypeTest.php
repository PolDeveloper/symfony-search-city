<?php

namespace App\Tests\Type;

use App\Form\Type\SearchCityType;
use App\Model\SearchCity;
use Symfony\Component\Form\Test\TypeTestCase;

class SearchCityTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            "city" => "Test city",
            "street" => "",
            "postcode" => "",
            "Search" => "",
        ];
        $searchCity = new SearchCity();
        $form = $this->factory->create(SearchCityType::class, $searchCity);
        $form->submit($formData);
        $this->assertTrue($form->isValid());
        $this->assertSame('Test city', $form->all()['city']->getData());
    }

    public function testSubmitInvalidData()
    {
        $formData = [
            "city" => [123],
            "street" => "",
            "postcode" => "",
            "Search" => "",
        ];
        $searchCity = new SearchCity();
        $form = $this->factory->create(SearchCityType::class, $searchCity);
        $form->submit($formData);
        $this->assertFalse($form->isValid());
    }
}