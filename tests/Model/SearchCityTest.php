<?php

namespace App\Tests\Model;

use App\Model\SearchCity;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SearchCityTest extends KernelTestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        $this->validator = self::getContainer()->get(ValidatorInterface::class);
    }

    public function testValidSearchCity(): void
    {
        $entity = new SearchCity();
        $entity->setCity('Test City');
        $entity->setStreet('Test street');
        $entity->setPostcode('12-123');
        $violations = $this->validator->validate($entity);
        $this->assertCount(0, $violations);
    }

    public function testInvalidCitySearchCity(): void
    {
        $entity = new SearchCity();
        $entity->setCity('t');
        $violations = $this->validator->validate($entity);
        $this->assertCount(1, $violations);
        $violationMessages = (string) $violations;
        $this->assertStringContainsString('This value is too short. It should have 3 characters or more', $violationMessages);
    }

    public function testInvalidStreetSearchCity(): void
    {
        $entity = new SearchCity();
        $entity->setCity('test City');
        $entity->setStreet('test street');
        $violations = $this->validator->validate($entity);
        $this->assertCount(1, $violations);
        $violationMessages = (string) $violations;
        $this->assertStringContainsString('The street is provided so please insert the postcode', $violationMessages);
    }
}