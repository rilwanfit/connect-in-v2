<?php
declare(strict_types=1);

namespace App\ConnectIn\Command;

use Broadway\CommandHandling\SimpleCommandHandler;
use App\ConnectIn\Repository\UserRepository;
use App\ConnectIn\UserAggregateRoot;

class UserCommandHandler extends SimpleCommandHandler
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handleCreateAUser(CreateAUser $command): void
    {
        $user = UserAggregateRoot::createAUser($command->getUser());

        $this->repository->save($user);
    }

    public function handleAddFriend(AddFriend $command): void
    {
        $user = $this->repository->load($command->getUser()->getUserId());

        $user->addFriend($command->getFriend());

        $this->repository->save($user);
    }
}
