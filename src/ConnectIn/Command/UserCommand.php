<?php
declare(strict_types=1);

namespace App\ConnectIn\Command;

use App\ConnectIn\hasUser;
use App\ConnectIn\User;

abstract class UserCommand
{
    use hasUser;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
