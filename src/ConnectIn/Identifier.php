<?php
declare(strict_types=1);

namespace App\ConnectIn;

interface Identifier
{
    public function __toString(): string;
}
