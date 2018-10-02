<?php
declare(strict_types=1);

namespace App\ConnectIn\Event;

use Broadway\Serializer\Serializable;
use App\ConnectIn\hasUser;
use App\ConnectIn\User;

abstract class UserEvent implements Serializable
{
    use hasUser;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function serialize(): array
    {
        return [
            'userId' => (string) $this->user->getUserId(),
            'name' => (string) $this->user->getName(),
            'source' => null,
        ];
    }
}
