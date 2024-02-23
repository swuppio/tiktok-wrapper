<?php

declare(strict_types=1);

namespace swuppio\ttWrapper\dto;

class UserInfoDto
{
    public function __construct(
        public readonly ?string $openId,
        public readonly ?string $unionId,
        public readonly ?string $username,
        public readonly ?string $avatarUrl,
        public readonly ?string $avatarUrl100,
        public readonly ?string $avatarLargeUrl,
        public readonly ?string $displayName,
        public readonly ?string $bioDescription,
        public readonly ?string $profileDeepLink,
        public readonly ?bool $isVerified,
        public readonly ?int $followerCount,
        public readonly ?int $followingCount,
        public readonly ?int $likesCount,
        public readonly ?int $videoCount,
    ) {}

    public static function fromArrayData(array $data): self
    {
        $user = $data['user'];

        return new self(
            openId: $user['open_id'] ?? null,
            unionId: $user['union_id'] ?? null,
            username: $user['username'] ?? null,
            avatarUrl: $user['avatar_url'] ?? null,
            avatarUrl100: $user['avatar_url_100'] ?? null,
            avatarLargeUrl: $user['avatar_large_url'] ?? null,
            displayName: $user['display_name'] ?? null,
            bioDescription: $user['bio_description'] ?? null,
            profileDeepLink: $user['profile_deep_link'] ?? null,
            isVerified: $user['is_verified'] ?? null,
            followerCount: $user['follower_count'] ?? null,
            followingCount: $user['following_count'] ?? null,
            likesCount: $user['likes_count'] ?? null,
            videoCount: $user['video_count'] ?? null,
        );
    }
}