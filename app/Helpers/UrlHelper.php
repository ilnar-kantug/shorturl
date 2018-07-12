<?php
namespace App\Helpers;

use App\Url;
use Carbon\Carbon;

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
        $short = str_random(Url::CHAR_IN_SHORT);
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

    public static function getFullLongUrl($url)
    {
        return config('app.url').$url;
    }

    public static function createUrls($urls)
    {
        if (!empty($urls)) {
            foreach ($urls as $url) {
                $url->short = self::getFullShortUrl($url->short);
                $url->long = self::getFullLongUrl($url->long);
                if (empty($url->till)) {
                    $url->till = 'Бесконечная';
                } else {
                    if (Carbon::now()->gt($url->till)) {
                        $url->till = 'Истекла';
                    }
                }
            }
        }
        return $urls;
    }
}
