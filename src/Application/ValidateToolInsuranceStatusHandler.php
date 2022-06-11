<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\ToolInsuranceValidationService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ValidateToolInsuranceStatusHandler implements QueryInterface
{
    public function __construct(private ToolInsuranceValidationService $toolInsuranceValidationService)
    {
    }

    public function __invoke(MessageInterface $message): bool
    {
        return $this->toolInsuranceValidationService->validate($message -> getContent());
    }
}
