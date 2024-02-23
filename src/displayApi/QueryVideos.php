<?php

declare(strict_types=1);

namespace swuppio\ttWrapper\displayApi;

use swuppio\ttWrapper\contract\DisplayApiContract;
use swuppio\ttWrapper\contract\VideoContract;
use swuppio\ttWrapper\dto\QueryVideosDto;
use swuppio\ttWrapper\dto\VideoDto;
use swuppio\ttWrapper\HttpBuilder;

class QueryVideos
{
    /**
     * @var string The requested fields, choose from [VideoContract]
     */
    private string $fields = '';
    private array $videoIds = [];

    public function __construct(
        private readonly string $authToken,
        private ?HttpBuilder $httpBuilder = null,
    ) {
        $this->httpBuilder = $httpBuilder ?? new HttpBuilder();
    }

    /**
     * @var string[] $videoIds
     */
    public function setVideoIds(array $videoIds): self
    {
        $this->videoIds = $videoIds;

        return $this;
    }

    public function resetVideoIds(): self
    {
        $this->videoIds = [];

        return $this;
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

    /**
     * @return QueryVideosDto
     */
    public function get(): QueryVideosDto
    {
        if ($this->fields === '') {
            $this->setFields(VideoContract::Id->value);
        }

        $response = $this->httpBuilder
            ->setBearer($this->authToken)
            ->setHeaders([
                'Content-Type' => 'application/json',
            ])
            ->setQuery([
                'fields' => $this->fields,
            ])
            ->setJson([
                    'filters' => [
                        'video_ids' => $this->videoIds
                    ],
            ])
            ->post(DisplayApiContract::QueryVideos->value);

        return QueryVideosDto::fromArrayData($response['data']);
    }
}