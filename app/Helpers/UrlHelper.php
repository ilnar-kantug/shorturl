<?php
namespace App\Helpers;

use App\Url;

class UrlHelper
{
    public static function createUniqUrl()
    {
        $shortUrls = self::getExistingUrls();
        $short = self::createUniq($shortUrls);
        return $short;
    }

    public static function getExistingUrls()
    {
        return Url::select('short')->get()->pluck('short')->toArray();
    }

    public static function createUniq($shortUrls)
    {
        $short = str_random(5);
        if (in_array($short, $shortUrls)) {
            self::createUniq($shortUrls);
        }
        return $short;
    }

    public static function getFullShortUrl($shortUrl)
    {
        return config('app.url').'/z/'.$shortUrl;
    }

    public static function trimLongUrl($url)
    {
        return str_replace(config('app.url'), '', trim($url, '/'));
    }
}
