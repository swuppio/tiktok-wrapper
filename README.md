# TikTok Wrapper

This project is a wrapper designed to facilitate interactions with TikTok's API, focusing specifically on the Authentication and Display API segments. These components were the primary focus due to their relevance to my personal project requirements. However, the wrapper is built with extensibility in mind.

Should there be a need for additional functionality beyond what is currently implemented, I am open to expanding the capabilities of this wrapper. If you find yourself in need of more features, please feel free to open an issue detailing your requirements. This will help in enhancing the wrapper to cater to a broader range of needs within the TikTok API functionalities.  

## Getting Started
### Prerequisites

To use this wrapper, you need to have PHP 8.1 or higher installed on your machine

### Installing

The installation is done via Composer. To install the component, run the following command in your project directory:

```bash
composer require swuppio/tiktok-wrapper
```

### Examples

In these examples, you'll see how to use the TikTok Wrapper to perform common tasks, such as fetching a user's username and refreshing an expired authentication token.

#### Fetching a User's Username

```php
$wrp = new TikTokWrapper();

$authDto = $wrp
    ->getAuthApi('CLIENT_KEY', 'CLIENT_SECRET')
    ->fetchAccessToken('CODE', 'http://site.com/redirect_uri');

$displayApi = $wrp->getDisplayApi($authDto->accessToken);

$userInfoDto = $displayApi
    ->getUserInfo()
    ->setFields(
        UserInfoContract::Username->value,
        // ...
    )
    ->get();

echo $userInfoDto->username;
```

#### Refreshing an Expired Authentication Token

```php
$wrp = new TikTokWrapper();

$authDto = $wrp
    ->getAuthApi('CLIENT_KEY', 'CLIENT_SECRET')
    ->refreshAccessToken('REFRESH_TOKEN');

echo $authDto->accessToken;
```

#### Ask for the video(s) information by IDs

```php
# code...

$displayApi = $wrp->getDisplayApi('ACCESS_TOKEN');

$queryVideosArr = $displayApi
    ->getQueryVideos()
    ->setFields(
        VideoContract::EmbedHtml->value,
        // ...
    )
    ->setVideoIds([
        '7251141220062350593',
        // ...
    ])
    ->get();

foreach ($queryVideosArr->videos as $video) {
    echo $video->embedHtml;
}
```

For more detailed information on all the capabilities of the TikTok Wrapper and additional examples, please refer to the [full documentation](https://swupp.io/components/tiktok-wrapper)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
