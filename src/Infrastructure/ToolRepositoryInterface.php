<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Entity\Tool;

interface ToolRepositoryInterface
{
    public function find($id, $lockMode = null, $lockVersion = null): ?Tool;
    public function add(Tool $entity, bool $flush = true): void;
    public function remove(Tool $entity, bool $flush = true): void;
}
