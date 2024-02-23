<?php

declare(strict_types=1);

namespace swuppio\ttWrapper;

class TikTokWrapper
{
    public function getAuthApi(string $clientKey, string $clientSecret, ?HttpBuilder $httpBuilder = null): AuthApi
    {
        return new AuthApi($clientKey, $clientSecret, $httpBuilder);
    }

    public function getDisplayApi(string $authToken, ?HttpBuilder $httpBuilder = null): DisplayApi
    {
        return new DisplayApi($authToken, $httpBuilder);
    }
}