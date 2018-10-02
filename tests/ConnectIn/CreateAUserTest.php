<?php
declare(strict_types=1);

namespace App\Tests\ConnectIn;

use App\ConnectIn\Command\CreateAUser;
use App\ConnectIn\Event\UserWasCreated;
use App\ConnectIn\ReadModel\Repository\RegisteredUsers;
use App\ConnectIn\User;
use App\ConnectIn\UserId;
use Broadway\ReadModel\ElasticSearch\ElasticSearchRepository;
use Broadway\ReadModel\ElasticSearch\ElasticSearchRepositoryFactory;
use Broadway\Serializer\Serializer;
use Elasticsearch\ClientBuilder;
use GuzzleHttp\Ring\Client\CurlHandler;

class CreateAUserTest extends UserCommandHandlerTest
{
    /**
     * @test
     */
    public function it_create_a_user()
    {
        $userId = new UserId('00000000-0000-0000-0000-000000000000');
        $user = new User($userId);

        $this->scenario
            ->given([])
            ->when(new CreateAUser($user))
            ->then([
                new UserWasCreated($user)
            ]);
    }


    /**
     * @test
     */
    public function testtt()
    {

    }
}
