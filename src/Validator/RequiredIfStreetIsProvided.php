<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class RequiredIfStreetIsProvided extends Constraint
{
    public $message = 'The street is provided so please insert the postcode too.';
}