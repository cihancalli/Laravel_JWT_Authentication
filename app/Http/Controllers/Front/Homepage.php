<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

//Models
use App\Models\Category;
use App\Models\Article;

class Homepage extends Controller
{
    public function index() {
        $data['articles'] = Article::orderBy('created_at','DESC')->paginate(1);
        $data['articles']->withPAth(url('yazilar/sayfa'));
        $data['categories'] = Category::inRandomOrder()->get();
        return view('frontend.homepage',$data);
    }

    public function single($category,$slug){
        $category = Category::whereSlug($category)->first() ?? abort(403,'Böylebir Kategori bulunamadı');
        $article =  Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403,'Böylebir yazı bulunamadı');
        $article->increment('hit');
        $data['article'] = $article;
        $data['categories'] = Category::inRandomOrder()->get();
        return view('frontend.single',$data);
    }

    public function category($slug) {
        $category = Category::whereSlug($slug)->first() ?? abort(403,'Böylebir Kategori bulunamadı');
        $data['articles'] =Article::whereCategoryId($category->id)->orderBy('created_at','DESC')->paginate(1);
        $data['category'] = $category;
        $data['categories'] = Category::inRandomOrder()->get();
        return view('frontend.category',$data);
    }
}
