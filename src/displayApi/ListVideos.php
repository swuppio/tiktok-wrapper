<?php

declare(strict_types=1);

namespace swuppio\ttWrapper\displayApi;

use swuppio\ttWrapper\contract\DisplayApiContract;
use swuppio\ttWrapper\contract\VideoContract;
use swuppio\ttWrapper\dto\ListVideosDto;
use swuppio\ttWrapper\dto\VideoDto;
use swuppio\ttWrapper\HttpBuilder;

class ListVideos
{
    private string $fields = '';
    private int $cursor;
    private int $maxCount = 10;

    public function __construct(
        private readonly string $authToken,
        private ?HttpBuilder $httpBuilder = null,
    ) {
        $this->httpBuilder = $httpBuilder ?? new HttpBuilder();
    }

    /**
     * @param string ...$fields The requested fields, choose from [VideoContract]
     */
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
     * @param int $cursor Cursor for pagination. If response.has_more is true, pass in the response.cursor to the next request will yield the results for the next page
     * Note: the cursor value is a UTC Unix timestamp in milli-seconds. You can pass in a customized timestamp to fetch the user's videos posted before the provided timestamp
     */
    public function setCursor(int $cursor): self
    {
        $this->cursor = $cursor;

        return $this;
    }

    /**
     * @var int $maxCount The maximum number of videos that will be returned from each page. Default is 10. Maximum is 20
     */
    public function setMaxCount(int $maxCount): self
    {
        $this->maxCount = $maxCount;

        return $this;
    }

    /**
     * @return VideoDto[]
     */
    public function get(): ListVideosDto
    {
        if ($this->fields === '') {
            $this->setFields(VideoContract::Id->value);
        }

        $json = [
            'max_count' => $this->maxCount,
        ];

        if (!empty($this->cursor)) {
            $json['cursor'] = $this->cursor;
        }

        $response = $this->httpBuilder
            ->setBearer($this->authToken)
            ->setHeaders([
                'Content-Type' => 'application/json',
            ])
            ->setQuery([
                'fields' => $this->fields,
            ])
            ->setJson($json)
            ->post(DisplayApiContract::ListVideos->value);

        return ListVideosDto::fromArrayData($response['data']);
    }
}