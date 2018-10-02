<?php
declare(strict_types=1);

namespace App\Tests\ConnectIn;

use App\ConnectIn\Command\AddFriend;
use App\ConnectIn\Event\FriendWasAdded;
use App\ConnectIn\Event\UserWasCreated;
use App\ConnectIn\User;
use App\ConnectIn\UserId;

class AddFriendTest extends UserCommandHandlerTest
{
    /**
     * @test
     */
    public function it_adds_a_friend()
    {
        $userId = new UserId('00000000-0000-0000-0000-000000000000');
        $friendId = new UserId('00000000-0000-0000-0000-000000000001');

        $user = new User($userId);
        $friend = new User($friendId);

        $this->scenario
            ->withAggregateId($userId->__toString())
            ->given([
                new UserWasCreated($user),
            ])
            ->when(new AddFriend($userId, $friend))
            ->then([
                new FriendWasAdded($user, $friend)
            ]);
    }
}
