<?php

declare(strict_types=1);

namespace App\Domain;

use App\Entity\InsuranceTypeEnum;
use App\Entity\Tool;

class BigToolInsuranceValidationService implements ToolInsuranceValidationStrategy
{
    public const EXPECTED_REQUIRED_INSURANCE_COUNT = 1;

    public function validate(Tool $tool): bool
    {
        $OCCount = 0;
        foreach ($tool -> getInsurances() as $insurance) {
            $OCCount += $insurance -> getType() == InsuranceTypeEnum::OC;
        }

        return $OCCount >= self::EXPECTED_REQUIRED_INSURANCE_COUNT;
    }
}
