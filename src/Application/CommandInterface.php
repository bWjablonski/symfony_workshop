<?php

declare(strict_types=1);

namespace App\Application;

interface CommandInterface
{
    public function __invoke(MessageInterface $message): void;
}
