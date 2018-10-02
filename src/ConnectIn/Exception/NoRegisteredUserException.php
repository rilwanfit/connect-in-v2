<?php
declare(strict_types=1);

namespace App\ConnectIn\Exception;

use RuntimeException;

class NoRegisteredUserException extends RuntimeException
{
    protected $message = 'There is no registered users found.';
}
