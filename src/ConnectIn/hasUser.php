<?php
declare(strict_types=1);

namespace App\ConnectIn;

trait hasUser
{
    private $user;

    public function getUser(): User
    {
        return $this->user;
    }
}
