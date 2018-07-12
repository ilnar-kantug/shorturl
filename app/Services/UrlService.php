<?php

namespace App\Services;

use App\Helpers\InfoHelper;
use App\Helpers\UrlHelper;
use App\Info;
use App\Url;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Location;

class UrlService
{
    public function createShortUrl()
    {
        $shortUrl = UrlHelper::createUniqUrl();
        $expiringDate = $this->getExpiringDate();
        $realUrl = UrlHelper::trimLongUrl(request('short-url'));

        Url::create([
            'user_id' => Auth::user()->id,
            'long' => $realUrl,
            'short' => $shortUrl,
            'till' => $expiringDate,
        ]);

        return $shortUrl;
    }

    private function getExpiringDate()
    {
        $expiringDate = null;
        if (request('till')) {
            $expiringDate = Carbon::now()->addMinutes(request('till'));
        }
        return $expiringDate;
    }

    public function getLongByShort($short)
    {
        $this->checkShort($short);
        $url = Url::where('short', $short)->firstOrFail();
        $this->checkExpiringDate($url);

        $this->saveUserAgent($url->id);

        return UrlHelper::getFullLongUrl($url->long);
    }

    private function checkShort($short)
    {
        if (strlen($short) != Url::CHAR_IN_SHORT) {
            throw new \DomainException('Невалидный вид ссылки');
        }
    }

    private function checkExpiringDate($url)
    {
        if (!empty($url->till)) {
            $now = Carbon::now();
            if ($now->gt($url->till)) {
                throw new \DomainException('Срок жизни ссылки истек');
            }
        }
    }

    public function getAllUrls()
    {
        $urls = Url::where('user_id', Auth::user()->id)->paginate(10);
        return UrlHelper::createUrls($urls);
    }

    private function saveUserAgent($urlId)
    {
        $agent = new Agent();
        $location = $this->getLocation();
        Info::create([
            'url_id' => $urlId,
            'browser' => $agent->browser(),
            'device' => $agent->device(),
            'platform' => $agent->platform(),
            'ip' => request()->ip(),
            'location' => $location,
        ]);
    }

    public function prepareUrlInfo($id)
    {
        $url = Url::with('infos')->find($id)->toArray();
        $urlInfo = $url['infos'];

        $url['stats']['browsers'] = InfoHelper::getUniqueBrowsers($urlInfo);
        $url['stats']['device'] = InfoHelper::getUniqueDevices($urlInfo);
        $url['stats']['platform'] = InfoHelper::getUniquePlatforms($urlInfo);
        $url['stats']['location'] = InfoHelper::getUniqueLocations($urlInfo);

        return $url;
    }

    private function getLocation()
    {
        try {
            $json_data = file_get_contents("http://apinotes.com/ipaddress/ip.php?ip=".request()->ip()."");
            $ip_data = json_decode($json_data, true);
            if ($ip_data['status'] == 'success') {
                return $ip_data['country_name'] === null ? '-' : $ip_data['country_name'];
            }
            return '-';
        } catch (\Exception $exception) {
            throw new \Exception('');
        }
    }
}
