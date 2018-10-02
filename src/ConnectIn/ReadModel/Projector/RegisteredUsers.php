<?php
declare(strict_types=1);

namespace App\ConnectIn\ReadModel\Projector;

use Broadway\ReadModel\Projector;
use Broadway\ReadModel\Repository;
use App\ConnectIn\Event\UserWasCreated;
use App\ConnectIn\ReadModel\Repository\RegisteredUsers as RegisteredUsersRepository;

class RegisteredUsers extends Projector
{
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    protected function applyUserWasCreated(UserWasCreated $event)
    {
        $user = $event->getUser();

        $readModel = $this->getReadModel($user->getUserId()->__toString());

        $readModel->addUser($user);
        $this->repository->save($readModel);
    }

    private function getReadModel(string $userId)
    {
        $readModel = $this->repository->find($userId);

        if (null === $readModel) {
            $readModel = new RegisteredUsersRepository($userId);
        }

        return $readModel;
    }
}
