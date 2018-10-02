<?php
declare(strict_types=1);

namespace App\ConnectIn\Event;

use App\ConnectIn\User;
use App\ConnectIn\UserId;

class UserWasCreated extends UserEvent
{
    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new self(new User(
            new UserId($data['userId']),
            $data['name']
        ));
    }
}
