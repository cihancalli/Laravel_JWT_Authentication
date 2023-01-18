<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return $articles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Article();
        $article->category_id  = $request->category_id;
        $article->title = $request->title;
        $article->image = $request->image;
        $article->contents = $request->contents;
        $article->slug = Str::slug($request->title);

        $article->save();
        return response()->json(['message'=>'Yazı kayıt işlemi başarılı...']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        if ($article == null){
            return response()->json(['message'=>'Aradığınız yazı bulunamadı...'],404);
        }
        return $article;
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
        $article = Article::findOrFail($id);
        $article->category_id  = $request->category_id;
        $article->title = $request->title;
        $article->image = $request->image;
        $article->contents = $request->contents;
        $article->slug = Str::slug($request->title);

        $article->save();
        return $article;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::destroy($id);
        return response()->json(['message'=>'Yazı silme işlemi başarılı...']);
    }
}
