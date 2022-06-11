<?php

declare(strict_types=1);

namespace App\Application;

interface MessageInterface
{
    public function getContent(): mixed;
}
