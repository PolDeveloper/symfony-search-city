<?php

/**
 * All Rights Reserved
 * @copyright Copyright (C) Michal Talar
 */

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class RequiredPostcodeIfStreetIsProvidedValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof RequiredPostcodeIfStreetIsProvided) {
            throw new UnexpectedTypeException($constraint, RequiredPostcodeIfStreetIsProvided::class);
        }
        if (!empty($this->context->getObject()->getStreet()) && empty($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
