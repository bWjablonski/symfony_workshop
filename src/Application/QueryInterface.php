<?php

declare(strict_types=1);

namespace App\Application;


interface QueryInterface
{
    public function __invoke(MessageInterface $message): mixed;
}
