<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use swuppio\ttWrapper\contract\DisplayApiContract;
use swuppio\ttWrapper\contract\UserInfoContract;
use swuppio\ttWrapper\dto\UserInfoDto;
use swuppio\ttWrapper\HttpBuilder;
use swuppio\ttWrapper\TikTokWrapper;

class UserInfoTest extends TestCase
{
    public function testGetUserInfoReturnsExpectedData()
    {
        $authToken = 'testToken123';
        $httpBuilderMock = $this->createMock(HttpBuilder::class);

        $userInfoData = [
            'data' => [
                'user' => [
                    'username' => 'user',
                    'display_name' => 'Joe',
                    'bio_description' => '',
                    'open_id' => '03ac22b0-2222-1111-3333-c382e6e3b301',
                    'union_id' => '03ac22b0-2222-1111-3333-c382e6123123',
                    'avatar_url' => 'https://link.com/avatar_url',
                    'avatar_large_url' => 'https://link.com/avatar_large_url',
                    'avatar_url_100' => 'https://link.com/avatar_url_100',
                    'profile_deep_link' => 'https://link.com/profile_deep_link',
                    'likes_count' => 3,
                    'video_count' => 30,
                    'following_count' => 2,
                    'follower_count' => 1,
                    'is_verified' => true,
                ],
            ],
            'error' => [
                'code' => 'ok',
                'message' => '',
                'log_id' => '123',
            ],
        ];

        $httpBuilderMock->method('setBearer')->willReturnSelf();
        $httpBuilderMock->method('setQuery')->willReturnSelf();
        $httpBuilderMock->method('get')
            ->with(DisplayApiContract::UserInfo->value)
            ->willReturn($userInfoData);

        $wrp = new TikTokWrapper();
        $displayApi = $wrp->getDisplayApi($authToken, $httpBuilderMock);

        $userInfoDto = $displayApi
            ->getUserInfo()
            ->setFields(
                UserInfoContract::OpenId->value,
                UserInfoContract::UnionId->value,
                UserInfoContract::Username->value,
                UserInfoContract::ProfileDeepLink->value,
                UserInfoContract::AvatarUrl->value,
                UserInfoContract::AvatarUrl100->value,
                UserInfoContract::AvatarLargeUrl->value,
                UserInfoContract::DisplayName->value,
                UserInfoContract::BioDescription->value,
                UserInfoContract::LikesCount->value,
                UserInfoContract::VideoCount->value,
                UserInfoContract::FollowerCount->value,
                UserInfoContract::FollowingCount->value,
                UserInfoContract::IsVerified->value,
            )
            ->get();

        $this->assertInstanceOf(UserInfoDto::class, $userInfoDto);

        $this->assertEquals($userInfoData['data']['user']['open_id'], $userInfoDto->openId);
        $this->assertEquals($userInfoData['data']['user']['union_id'], $userInfoDto->unionId);
        $this->assertEquals($userInfoData['data']['user']['avatar_url'], $userInfoDto->avatarUrl);
        $this->assertEquals($userInfoData['data']['user']['avatar_url_100'], $userInfoDto->avatarUrl100);
        $this->assertEquals($userInfoData['data']['user']['avatar_large_url'], $userInfoDto->avatarLargeUrl);
        $this->assertEquals($userInfoData['data']['user']['display_name'], $userInfoDto->displayName);
        $this->assertEquals($userInfoData['data']['user']['bio_description'], $userInfoDto->bioDescription);
        $this->assertEquals($userInfoData['data']['user']['profile_deep_link'], $userInfoDto->profileDeepLink);
        $this->assertEquals($userInfoData['data']['user']['is_verified'], $userInfoDto->isVerified);
        $this->assertEquals($userInfoData['data']['user']['follower_count'], $userInfoDto->followerCount);
        $this->assertEquals($userInfoData['data']['user']['following_count'], $userInfoDto->followingCount);
        $this->assertEquals($userInfoData['data']['user']['likes_count'], $userInfoDto->likesCount);
        $this->assertEquals($userInfoData['data']['user']['video_count'], $userInfoDto->videoCount);
    }
}