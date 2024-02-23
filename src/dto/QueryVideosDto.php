<?php

declare(strict_types=1);

namespace swuppio\ttWrapper\dto;

class QueryVideosDto
{
    public function __construct(
        /**
         * @var VideoDto[]
         */
        public readonly ?array $videos,
    ) {}

    public static function fromArrayData(array $data): self
    {
        $videos = array_map(function ($videoData) {
            return VideoDto::fromArrayData($videoData);
        }, $data['videos']);

        return new self(
             videos: $videos,
        );
    }
}