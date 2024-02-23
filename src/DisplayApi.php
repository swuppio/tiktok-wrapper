<?php

declare(strict_types=1);

namespace swuppio\ttWrapper;

use swuppio\ttWrapper\displayApi\ListVideos;
use swuppio\ttWrapper\displayApi\QueryVideos;
use swuppio\ttWrapper\displayApi\UserInfo;

class DisplayApi
{
    public function __construct(
        private readonly string $authToken,
        private ?HttpBuilder $httpBuilder = null,
    ) {}

    public function getUserInfo(): UserInfo
    {
        return new UserInfo($this->authToken, $this->httpBuilder);
    }

    public function getQueryVideos(): QueryVideos
    {
        return new QueryVideos($this->authToken, $this->httpBuilder);
    }

    public function getListVideos(): ListVideos
    {
        return new ListVideos($this->authToken, $this->httpBuilder);
    }
}