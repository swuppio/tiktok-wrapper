<?php

declare(strict_types=1);

namespace swuppio\ttWrapper\contract;

enum UserInfoContract: string
{
    /**
     * @var string The unique identification of the user in the current application. Open id for the client.
     */
    case OpenId = 'open_id';

    /**
     * @var string The unique identification of the user across different apps for the same developer.
     * For example, if a partner has X number of clients, it will get X number of open_id for the same TikTok user,
     * but one persistent union_id for the particular user.
     */
    case UnionId = 'union_id';

    /**
     * @var string User's username (This option is not in the documentation, but it works. However, be careful when using it)
     */
    case Username = 'username';

    /**
     * @var string User's profile image.
     */
    case AvatarUrl = 'avatar_url';

    /**
     * @var string User's profile image in 100x100 size.
     */
    case AvatarUrl100 = 'avatar_url_100';

    /**
     * @var string User's profile image with higher resolution.
     */
    case AvatarLargeUrl = 'avatar_large_url';

    /**
     * @var string User's profile name.
     */
    case DisplayName = 'display_name';

    /**
     * @var string User's bio description if there is a valid one.
     */
    case BioDescription = 'bio_description';

    /**
     * @var string The link to user's TikTok profile page.
     */
    case ProfileDeepLink = 'profile_deep_link';

    /**
     * @var string Whether TikTok has provided a verified badge to the account after confirming that it belongs to the user it represents.
     */
    case IsVerified = 'is_verified';

    /**
     * @var string User's followers count.
     */
    case FollowerCount = 'follower_count';

    /**
     * @var string The number of accounts that the user is following.
     */
    case FollowingCount = 'following_count';

    /**
     * @var string The total number of likes received by the user across all of their videos.
     */
    case LikesCount = 'likes_count';

    /**
     * @var string The total number of publicly posted videos by the user.
     */
    case VideoCount = 'video_count';
}
