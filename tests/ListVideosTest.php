<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use swuppio\ttWrapper\contract\DisplayApiContract;
use swuppio\ttWrapper\dto\ListVideosDto;
use swuppio\ttWrapper\dto\VideoDto;
use swuppio\ttWrapper\HttpBuilder;
use swuppio\ttWrapper\TikTokWrapper;
use swuppio\ttWrapper\contract\VideoContract;

class ListVideosTest extends TestCase
{
    public function testGetListVideosReturnsExpectedData()
    {
        $authToken = 'testToken123';
        $httpBuilderMock = $this->createMock(HttpBuilder::class);

        $listVideosData = [
            'data' => [
                'videos' => [
                    [
                        'id' => '7251141220062350593',
                        'create_time' => 1620000000,
                        'cover_image_url' => 'https://link.com/cover.jpg',
                        'share_url' => 'https://link.com/share',
                        'video_description' => 'Description',
                        'duration' => 60,
                        'height' => 720,
                        'width' => 1280,
                        'title' => 'Title',
                        'embed_html' => '<html lang="en">Embed</html>',
                        'embed_link' => 'https://link.com/embed',
                        'like_count' => 100,
                        'comment_count' => 10,
                        'share_count' => 5,
                        'view_count' => 1000,
                    ],
                ],
                'cursor' => 1620000000,
                'has_more' => true,
            ],
        ];

        // Настройка поведения мока
        $httpBuilderMock->method('setBearer')->willReturnSelf();
        $httpBuilderMock->method('setHeaders')->willReturnSelf();
        $httpBuilderMock->method('setQuery')->willReturnSelf();
        $httpBuilderMock->method('setJson')->willReturnSelf();
        $httpBuilderMock->method('post')
            ->with(DisplayApiContract::ListVideos->value)
            ->willReturn($listVideosData);

        $wrp = new TikTokWrapper();
        $displayApi = $wrp->getDisplayApi($authToken, $httpBuilderMock);

        $listVideosDto = $displayApi
            ->getListVideos()
            ->setFields(
                VideoContract::Id->value,
                VideoContract::CreateTime->value,
                VideoContract::CoverImageUrl->value,
                VideoContract::ShareUrl->value,
                VideoContract::VideoDescription->value,
                VideoContract::Duration->value,
                VideoContract::Height->value,
                VideoContract::Width->value,
                VideoContract::Title->value,
                VideoContract::EmbedHtml->value,
                VideoContract::EmbedLink->value,
                VideoContract::LikeCount->value,
                VideoContract::CommentCount->value,
                VideoContract::ShareCount->value,
                VideoContract::ViewCount->value
            )
            ->setMaxCount(1)
            ->get();

        $this->assertInstanceOf(ListVideosDto::class, $listVideosDto);

        $this->assertCount(1, $listVideosDto->videos);
        $this->assertEquals($listVideosData['data']['cursor'], $listVideosDto->cursor);
        $this->assertEquals($listVideosData['data']['has_more'], $listVideosDto->hasMore);

        $videoDto = $listVideosDto->videos[0];
        $this->assertInstanceOf(VideoDto::class, $videoDto);

        $videoData = $listVideosData['data']['videos'][0];

        $this->assertEquals($videoData['id'], $videoDto->id);
        $this->assertEquals($videoData['create_time'], $videoDto->createTime);
        $this->assertEquals($videoData['cover_image_url'], $videoDto->coverImageUrl);
        $this->assertEquals($videoData['share_url'], $videoDto->shareUrl);
        $this->assertEquals($videoData['video_description'], $videoDto->videoDescription);
        $this->assertEquals($videoData['duration'], $videoDto->duration);
        $this->assertEquals($videoData['height'], $videoDto->height);
        $this->assertEquals($videoData['width'], $videoDto->width);
        $this->assertEquals($videoData['title'], $videoDto->title);
        $this->assertEquals($videoData['embed_html'], $videoDto->embedHtml);
        $this->assertEquals($videoData['embed_link'], $videoDto->embedLink);
        $this->assertEquals($videoData['like_count'], $videoDto->likeCount);
        $this->assertEquals($videoData['comment_count'], $videoDto->commentCount);
        $this->assertEquals($videoData['share_count'], $videoDto->shareCount);
        $this->assertEquals($videoData['view_count'], $videoDto->viewCount);
    }
}