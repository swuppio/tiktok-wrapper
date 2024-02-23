<?php

declare(strict_types=1);

namespace swuppio\ttWrapper\exception;

use Exception;

class AccessDeniedException extends Exception
{
    protected $message = 'The resource owner or authorization server denied the request';
}