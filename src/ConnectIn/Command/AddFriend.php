<?php
declare(strict_types=1);

namespace App\ConnectIn\Command;

use App\ConnectIn\Exception\NotAllowedToAddFriendException;
use App\ConnectIn\User;
use App\ConnectIn\UserId;

class AddFriend extends UserCommand
{
    /** @var User */
    private $friend;

    public function __construct(UserId $userId, User $friend)
    {
        parent::__construct(new User($userId));

        if ($this->getUser()->equals($friend)) {
            throw new NotAllowedToAddFriendException("Seriously!");
        }

        $this->friend = $friend;
    }

    public function getFriend(): User
    {
        return $this->friend;
    }
}
