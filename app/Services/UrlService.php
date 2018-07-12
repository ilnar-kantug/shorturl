<?php

namespace App\Services;

use App\Helpers\UrlHelper;
use App\Url;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
}
