<?php

declare(strict_types=1);
namespace App\Application;


class ValidateToolInsuranceStatusMessage implements MessageInterface
{
    public function __construct(private int $toolId)
    {
    }

    public function getContent(): int
    {
        return $this->toolId;
    }
}
