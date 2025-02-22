<?php

/**
 * All Rights Reserved
 * @copyright Copyright (C) Michal Talar
 */

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class RequiredIfStreetIsProvided extends Constraint
{
    public string $message = 'The street is provided so please insert the postcode too.';
}
