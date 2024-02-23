<?php

declare(strict_types=1);

namespace swuppio\ttWrapper\contract;

enum DisplayApiContract: string
{
    case UserInfo = 'v2/user/info/';
    case QueryVideos = 'v2/video/query/';
    case ListVideos = 'v2/video/list/';
}
