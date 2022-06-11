<?php

declare(strict_types=1);

namespace App\Entity;

enum InsuranceTypeEnum: string {
    case OC = 'O';
    case Additional = 'A';
}
