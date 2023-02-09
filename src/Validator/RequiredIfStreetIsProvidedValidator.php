<?php
namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class RequiredIfStreetIsProvidedValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof RequiredIfStreetIsProvided) {
            throw new UnexpectedTypeException($constraint, RequiredIfStreetIsProvided::class);
        }

        if (!empty($this->context->getObject()->getStreet()) && empty($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}