<?php

declare(strict_types=1);

namespace swuppio\ttWrapper\dto;

class VideoDto
{
    public function __construct(
        public readonly ?string $id,
        public readonly ?int $createTime,
        public readonly ?string $coverImageUrl,
        public readonly ?string $shareUrl,
        public readonly ?string $videoDescription,
        public readonly ?int $duration,
        public readonly ?int $height,
        public readonly ?int $width,
        public readonly ?string $title,
        public readonly ?string $embedHtml,
        public readonly ?string $embedLink,
        public readonly ?int $likeCount,
        public readonly ?int $commentCount,
        public readonly ?int $shareCount,
        public readonly ?int $viewCount
    ) {}

    public static function fromArrayData(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            createTime: $data['create_time'] ?? null,
            coverImageUrl: $data['cover_image_url'] ?? null,
            shareUrl: $data['share_url'] ?? null,
            videoDescription: $data['video_description'] ?? null,
            duration: $data['duration'] ?? null,
            height: $data['height'] ?? null,
            width: $data['width'] ?? null,
            title: $data['title'] ?? null,
            embedHtml: $data['embed_html'] ?? null,
            embedLink: $data['embed_link'] ?? null,
            likeCount: $data['like_count'] ?? null,
            commentCount: $data['comment_count'] ?? null,
            shareCount: $data['share_count'] ?? null,
            viewCount: $data['view_count'] ?? null
        );
    }
}