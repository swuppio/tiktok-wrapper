<?php

declare(strict_types=1);

namespace swuppio\ttWrapper\contract;

enum VideoContract: string
{
    /**
     * @var string Unique identifier for the TikTok video. Also called "item_id".
     */
    case Id = 'id';

    /**
     * @var string UTC Unix epoch (in seconds) of when the TikTok video was posted.
     */
    case CreateTime = 'create_time';

    /**
     * @var string A CDN link for the video's cover image. The image is static. Due to our trust and safety policies, the link has a TTL of 6 hours.
     */
    case CoverImageUrl = 'cover_image_url';

    /**
     * @var string A shareable link for this TikTok video. Note that the website behaves differently on Mobile and Desktop devices.
     */
    case ShareUrl = 'share_url';

    /**
     * @var string The description that the creator has set for the TikTok video. Max length: 150.
     */
    case VideoDescription = 'video_description';

    /**
     * @var string The duration of the TikTok video in seconds.
     */
    case Duration = 'duration';

    /**
     * @var string The height of the TikTok video.
     */
    case Height = 'height';

    /**
     * @var string The width of the TikTok video.
     */
    case Width = 'width';

    /**
     * @var string The video title. Max length: 150.
     */
    case Title = 'title';

    /**
     * @var string HTML code for embedded video.
     */
    case EmbedHtml = 'embed_html';

    /**
     * @var string Video embed link of tiktok.com.
     */
    case EmbedLink = 'embed_link';

    /**
     * @var string Number of likes for the video.
     */
    case LikeCount = 'like_count';

    /**
     * @var string Number of comments on the video.
     */
    case CommentCount = 'comment_count';

    /**
     * @var string Number of shares of the video.
     */
    case ShareCount = 'share_count';

    /**
     * @var string Number of views of the video.
     */
    case ViewCount = 'view_count';
}