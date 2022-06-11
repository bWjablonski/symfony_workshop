<?php

declare(strict_types=1);

namespace App\Domain;

use App\Entity\Tool;

interface ToolInsuranceValidationStrategy
{
    public function validate(Tool $tool): bool;
}
