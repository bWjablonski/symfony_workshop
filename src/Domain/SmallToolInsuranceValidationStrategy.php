<?php

declare(strict_types=1);

namespace App\Domain;

use App\Entity\InsuranceTypeEnum;
use App\Entity\Tool;

class SmallToolInsuranceValidationStrategy implements ToolInsuranceValidationStrategy
{
    public function validate(Tool $tool): bool
    {
        // It's small tool, we don't care
        return true;
    }
}
