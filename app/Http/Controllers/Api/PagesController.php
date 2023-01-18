<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Pages::all();
        return $pages;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Pages();
        $page->title = $request->title;
        $page->image = $request->image;
        $page->contents = $request->contents;
        $page->order = $request->order;
        $page->slug = Str::slug($request->title);

        $page->save();
        return response()->json(['message'=>'Sayfa kayıt işlemi başarılı...']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Pages::find($id);
        if ($page == null){
            return response()->json(['message'=>'Aradığınız sayfa bulunamadı...'],404);
        }
        return $page;
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
        $page = Pages::findOrFail($id);

        $page->title = $request->title;
        $page->image = $request->image;
        $page->contents = $request->contents;
        $page->order = $request->order;
        $page->slug = Str::slug($request->title);

        $page->save();
        return $page;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Pages::destroy($id);
        return response()->json(['message'=>'Sayfa silme işlemi başarılı...']);
    }
}
