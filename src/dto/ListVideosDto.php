<?php

declare(strict_types=1);

namespace swuppio\ttWrapper\dto;

class ListVideosDto
{
    public function __construct(
        /**
         * @var VideoDto[] A list of video objects
         */
        public readonly array $videos,

        /**
         * @var int Cursor for pagination. If response.has_more is true, pass in the response.cursor to the next request will yield the results for the next page
         * Note: the cursor value is a UTC Unix timestamp in milli-seconds. You can pass in a customized timestamp to fetch the user's videos posted before the provided timestamp
         */
        public readonly int $cursor,

        /**
         * @var bool Whether there is more videos
         */
        public readonly bool $hasMore,
    ) {}

    public static function fromArrayData(array $data): self
    {
        $videos = array_map(function ($videoData) {
            return VideoDto::fromArrayData($videoData);
        }, $data['videos']);

        return new self(
            videos: $videos,
            cursor: $data['cursor'],
            hasMore: $data['has_more'],
        );
    }
}