<?php
declare(strict_types=1);

namespace App\ConnectIn;

interface ValueObject
{
    public function equals(ValueObject $object) : bool;
}
