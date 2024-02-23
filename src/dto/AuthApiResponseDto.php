<?php

declare(strict_types=1);

namespace swuppio\ttWrapper\dto;

use DateTimeImmutable;

class AuthApiResponseDto
{
    public function __construct(
        public readonly string $accessToken,
        public readonly int $expiresIn,
        public readonly string $openId,
        public readonly int $refreshExpiresIn,
        public readonly string $refreshToken,
        public readonly string $scope,
        public readonly string $tokenType
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            accessToken: $data['access_token'],
            expiresIn: $data['expires_in'],
            openId: $data['open_id'],
            refreshExpiresIn: $data['refresh_expires_in'],
            refreshToken: $data['refresh_token'],
            scope: $data['scope'],
            tokenType: $data['token_type']
        );
    }

    public function getExpiresAt(): DateTimeImmutable
    {
        $timeStamp = time() + $this->expiresIn;

        return new DateTimeImmutable("@{$timeStamp}");
    }

    public function getRefreshExpiresAt(): DateTimeImmutable
    {
        $timeStamp = time() + $this->refreshExpiresIn;

        return new DateTimeImmutable("@{$timeStamp}");
    }
}