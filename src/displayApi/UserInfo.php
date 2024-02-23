<?php

declare(strict_types=1);

namespace swuppio\ttWrapper\displayApi;

use swuppio\ttWrapper\contract\DisplayApiContract;
use swuppio\ttWrapper\contract\UserInfoContract;
use swuppio\ttWrapper\dto\UserInfoDto;
use swuppio\ttWrapper\HttpBuilder;

class UserInfo
{
    private string $fields = '';

    public function __construct(
        private readonly string $authToken,
        private ?HttpBuilder $httpBuilder = null,
    ) {
        $this->httpBuilder = $httpBuilder ?? new HttpBuilder();
    }

    public function setFields(string ...$fields): self
    {
        $this->fields .= implode(',', $fields);

        return $this;
    }

    public function resetFields(): self
    {
        $this->fields = '';

        return $this;
    }

    public function get(): UserInfoDto
    {
        if ($this->fields === '') {
            $this->setFields(UserInfoContract::OpenId->value);
        }

        $response = $this->httpBuilder
            ->setBearer($this->authToken)
            ->setQuery([
                'fields' => $this->fields,
            ])
            ->get(DisplayApiContract::UserInfo->value);

        return UserInfoDto::fromArrayData($response['data']);
    }
}