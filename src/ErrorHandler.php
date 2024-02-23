<?php

declare(strict_types=1);

namespace swuppio\ttWrapper;

use Exception;
use swuppio\ttWrapper\exception\AccessDeniedException;
use swuppio\ttWrapper\exception\AccessTokenInvalidException;
use swuppio\ttWrapper\exception\InternalErrorException;
use swuppio\ttWrapper\exception\InvalidClientException;
use swuppio\ttWrapper\exception\InvalidFileUploadException;
use swuppio\ttWrapper\exception\InvalidGrantException;
use swuppio\ttWrapper\exception\InvalidParamsException;
use swuppio\ttWrapper\exception\InvalidRequestException;
use swuppio\ttWrapper\exception\InvalidScopeException;
use swuppio\ttWrapper\exception\RateLimitExceededException;
use swuppio\ttWrapper\exception\ScopeNotAuthorizedException;
use swuppio\ttWrapper\exception\ScopePermissionMissedException;
use swuppio\ttWrapper\exception\ServerErrorException;
use swuppio\ttWrapper\exception\TemporarilyUnavailableException;
use swuppio\ttWrapper\exception\UnauthorizedClientException;
use swuppio\ttWrapper\exception\UnsupportedGrantTypeException;
use swuppio\ttWrapper\exception\UnsupportedResponseTypeException;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ErrorHandler
{
    public function __construct(
        private readonly ResponseInterface $response,
    ) {}

    private function hasError(): bool
    {
        $httpCode = $this->response->getStatusCode();

        if ($httpCode !== 200) {
            return true;
        }

        $data = $this->response->toArray(false);

        if (!empty($data['error']) && is_string($data['error'])) {
            return true;
        }

        return false;
    }

    private function getErrorData(): array
    {
        $data = $this->response->toArray(false);

        if (is_array($data['error'])) {
            return [
                $data['error']['code'],
                $data['error']['message'] ?? '',
            ];
        }

        if (is_string($data['error'])) {
            return [
                $data['error'],
                $data['error_description'] ?? '',
            ];
        }

        return [
            'unexpected',
            'Error cannot be parsed',
        ];
    }

    public static function check(ResponseInterface $response): void
    {
        $handler = new self($response);

        if (!$handler->hasError()) {
            return;
        }

        [$errorCode, $message] = $handler->getErrorData();

        match ($errorCode) {
            'server_error' => throw new ServerErrorException($message),
            'access_denied' => throw new AccessDeniedException($message),
            'invalid_grant' => throw new InvalidGrantException($message),
            'invalid_scope' => throw new InvalidScopeException($message),
            'invalid_client' => throw new InvalidClientException($message),
            'invalid_request' => throw new InvalidRequestException($message),
            'unauthorized_client' => throw new UnauthorizedClientException($message),
            'unsupported_grant_type' => throw new UnsupportedGrantTypeException($message),
            'temporarily_unavailable' => throw new TemporarilyUnavailableException($message),
            'unsupported_response_type' => throw new UnsupportedResponseTypeException($message),
            'access_token_invalid' => throw new AccessTokenInvalidException($message, $response->getStatusCode()),
            'internal_error' => throw new InternalErrorException($message, $response->getStatusCode()),
            'invalid_file_upload' => throw new InvalidFileUploadException($message, $response->getStatusCode()),
            'invalid_params' => throw new InvalidParamsException($message, $response->getStatusCode()),
            'rate_limit_exceeded' => throw new RateLimitExceededException($message, $response->getStatusCode()),
            'scope_not_authorized' => throw new ScopeNotAuthorizedException($message, $response->getStatusCode()),
            'scope_permission_missed' => throw new ScopePermissionMissedException($message, $response->getStatusCode()),
            default => throw new Exception($message ?: 'Unknown error occurred'),
        };
    }
}

$working_Sat = [
    '27.04.2024',
    '02.11.2024',
    '28.12.2024',
];