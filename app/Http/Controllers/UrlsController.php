<?php

namespace App\Http\Controllers;

use App\Helpers\UrlHelper;
use App\Http\Requests\UrlFormRequest;
use App\Services\UrlService;
use App\Url;
use Illuminate\Http\Request;

class UrlsController extends Controller
{
    private $service;

    public function __construct(UrlService $service)
    {
        $this->middleware('auth')->except('short');
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urls = $this->service->getAllUrls();
        return view('all-urls', ['urls' => $urls]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-url');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UrlFormRequest $request)
    {
        try {
            $shortUrl = $this->service->createShortUrl();
        } catch (\Exception $exception) {
            return back()->with('exception', 'Что-то пошло не так, попробуйте позже');
        }
        return back()->with('success', 'Ваш УРЛ '.UrlHelper::getFullShortUrl($shortUrl));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = $this->service->prepareUrlInfo($id);
        return view('url-info', ['url' => $url]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function short($short)
    {
        try {
            $realUrl = $this->service->getLongByShort($short);
        } catch (\DomainException $exception) {
            return redirect('/')->with('exception', $exception->getMessage());
        }
        catch (\Exception $exception) {
            return redirect('/')->with('exception', 'Что-то пошло не так, попробуйте позже');
        }
        return redirect($realUrl);
    }
}
