<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\BigToolInsuranceValidationService;
use App\Domain\SmallToolInsuranceValidationStrategy;
use App\Infrastructure\ToolRepositoryInterface;

class ToolInsuranceValidationService
{
    public const BIG_TOOL_NAME_DETERMINANT_STRING = 'big';

    public function __construct(private ToolRepositoryInterface $toolRepository)
    {
    }

    public function validate(int $toolId): bool
    {
        // here we can implement more sophisticated logic
        // in original code that was calling third party API
        // check if insurance amount is sufficient and other staff
        $tool = $this->toolRepository -> find($toolId);

        if (str_contains($tool -> getName(), self::BIG_TOOL_NAME_DETERMINANT_STRING)) {
            $strategy = new BigToolInsuranceValidationService();
        } else {
            $strategy = new SmallToolInsuranceValidationStrategy();
        }

        return $strategy -> validate($tool);
    }
}
