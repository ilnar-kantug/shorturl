<?php

namespace App\Http\Controllers;

use App\Helpers\UrlHelper;
use App\Services\UrlService;
use Illuminate\Http\Request;

class UrlsController extends Controller
{
    private $service;

    public function __construct(UrlService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'short-url' => 'required|string|min:5|max:255',
            'till' => 'nullable|integer'
        ]);

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
        //
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
}
