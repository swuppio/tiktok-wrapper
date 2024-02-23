<?php

declare(strict_types=1);

namespace swuppio\ttWrapper\contract;

enum ScopeContract: string
{
    case UserInfo = 'user.info.basic';
    case VideoList = 'video.list';
}
