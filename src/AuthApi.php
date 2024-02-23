<?php

declare(strict_types=1);

namespace swuppio\ttWrapper;

use swuppio\ttWrapper\contract\AuthApiContract;
use swuppio\ttWrapper\dto\AuthApiResponseDto;

class AuthApi
{
    private HttpBuilder $httpBuilder;

    public function __construct(
        private readonly string $clientKey,
        private readonly string $clientSecret,
    ) {
        $this->httpBuilder = new HttpBuilder();
    }

    public function getAuthPageLink(string $redirectUri, string $scope, string $state): string
    {
        $queryParams = [
            'client_key' => $this->clientKey,
            'response_type' => 'code',
            'redirect_uri' => $redirectUri,
            'scope' => $scope,
            'state' => $state,
        ];

        $queryString = http_build_query($queryParams);

        return AuthApiContract::AuthPageUri->value . "?{$queryString}";
    }

    public function fetchAccessToken(string $code, string $redirectUri): AuthApiResponseDto
    {
        $response = $this->httpBuilder->setHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Cache-Control' => 'no-cache',
        ])->setBody([
            'client_key' => $this->clientKey,
            'client_secret' => $this->clientSecret,
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $redirectUri,
        ])->post(AuthApiContract::AuthUri->value);

        return AuthApiResponseDto::fromArray($response);
    }

    public function refreshAccessToken($refreshToken): AuthApiResponseDto
    {
        $response = $this->httpBuilder->setHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Cache-Control' => 'no-cache',
        ])->setBody([
            'client_key' => $this->clientKey,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        ])->post(AuthApiContract::AuthUri->value);

        return AuthApiResponseDto::fromArray($response);
    }
}