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

        Url::create([
            'user_id' => Auth::user()->id,
            'long' => request('short-url'),
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
}
