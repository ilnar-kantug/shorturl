<?php
namespace App\Helpers;

class InfoHelper
{
    public static function getUniqueBrowsers($urlInfo)
    {
        return array_count_values(array_column($urlInfo, 'browser'));
    }

    public static function getUniqueDevices($urlInfo)
    {
        return array_count_values(array_column($urlInfo, 'device'));
    }

    public static function getUniquePlatforms($urlInfo)
    {
        return array_count_values(array_column($urlInfo, 'platform'));
    }

    public static function getUniqueLocations($urlInfo)
    {
        return array_count_values(array_column($urlInfo, 'location'));
    }
}
