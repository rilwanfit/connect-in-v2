<?php
declare(strict_types=1);

namespace App\Tests\ConnectIn;

use Broadway\CommandHandling\Testing\CommandHandlerScenarioTestCase;
use Broadway\CommandHandling\CommandHandler;
use Broadway\EventHandling\EventBus;
use Broadway\EventStore\EventStore;
use App\ConnectIn\Command\UserCommandHandler;
use App\ConnectIn\Repository\UserRepository;

abstract class UserCommandHandlerTest extends CommandHandlerScenarioTestCase
{
    protected function createCommandHandler(EventStore $eventStore, EventBus $eventBus): CommandHandler
    {
        return new UserCommandHandler(
            new UserRepository($eventStore, $eventBus)
        );
    }
}
