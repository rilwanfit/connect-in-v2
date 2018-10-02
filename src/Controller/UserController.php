<?php
declare(strict_types=1);

namespace App\Controller;

use Assert\Assertion as Assert;
use Broadway\CommandHandling\CommandBus;
use Broadway\ReadModel\Repository;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use App\ConnectIn\Command\AddFriend;
use App\ConnectIn\Command\CreateAUser;
use App\ConnectIn\Exception\NoRegisteredUserException;
use App\ConnectIn\Exception\ReadModelNotAvailableException;
use App\ConnectIn\User;
use App\ConnectIn\UserId;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

class UserController
{
    private $commandBus;
    private $uuidGenerator;

    /** @var Repository */
    private $userRepository;

    public function __construct(
        CommandBus $commandBus,
        UuidGeneratorInterface $uuidGenerator,
        Repository $userRepository
    ) {
        $this->commandBus    = $commandBus;
        $this->uuidGenerator = $uuidGenerator;
        $this->userRepository = $userRepository;
    }

    public function createAUser(Request $request): JsonResponse
    {
        try {
            $userId = new UserId($this->uuidGenerator->generate());
            $name = $request->get('name');

            Assert::notNull($name, 'name is required.');

            $command  = new CreateAUser(new User($userId, $name));

            $this->commandBus->dispatch($command);

            return new JsonResponse([
                'id' => (string) $userId
            ]);
        } catch (Throwable $exception) {
            return new JsonResponse([
                'status' => 'error',
                'reason' => $exception->getMessage()
            ]);
        }
    }

    public function getUsers(Request $request)
    {
        try {
            $readModel = $this->userRepository->findAll();
            if (is_null($readModel)) {
                throw new ReadModelNotAvailableException();
            }

            $registeredUsers = [];
            foreach ($readModel as $item) {
                $registeredUsers[] = $item->serialize()['registeredUsers'];
            }

            return new JsonResponse($registeredUsers);
        } catch (Throwable $exception) {
            return new JsonResponse([
                'status' => 'error',
                'reason' => $exception->getMessage()
            ]);
        }
    }

    public function addFriend(Request $request): JsonResponse
    {
        try {
            $userId = $request->get('userId');
            $friendId = $request->get('friendId');

            Assert::uuid($userId, 'Not allowed user ID');
            Assert::uuid($friendId, 'Not allowed friend ID');

            $friend = $this->userRepository->find($friendId);

            if (is_null($friend)) {
                throw new NoRegisteredUserException();
            }

            $name = $friend->serialize()['registeredUsers'][$friendId]['name'];

            $command  = new AddFriend(
                new UserId($userId),
                new User(new UserId($friendId), $name)
            );

            $this->commandBus->dispatch($command);

            return new JsonResponse([
                'status' => 'success',
            ]);
        } catch (Throwable $exception) {
            return new JsonResponse([
                'status' => 'error',
                'reason' => $exception->getMessage()
            ]);
        }
    }
}
