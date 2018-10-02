<?php
declare(strict_types=1);

namespace App\Controller;

use Broadway\ReadModel\Repository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ListOfFriendsForAUserController
{
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getFriends(Request $request, string $userId)
    {
        try {
            $readModel = $this->repository->find($userId);

            if (is_null($readModel)) {
                return new JsonResponse([
                    'No friends yet :('
                ], Response::HTTP_NOT_FOUND);
            }

            return new JsonResponse($readModel->serialize());
        } catch (Throwable $exception) {
            return new JsonResponse([
                'status' => 'error',
                'reason' => $exception->getMessage()
            ]);
        }
    }
}
