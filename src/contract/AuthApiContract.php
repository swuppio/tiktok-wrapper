<?php

declare(strict_types=1);

namespace swuppio\ttWrapper\contract;

enum AuthApiContract: string
{
    case AuthPageUri = 'https://www.tiktok.com/v2/auth/authorize/';
    case AuthUri = 'v2/oauth/token/';
}
