<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

//Models
use App\Models\Category;
use App\Models\Article;
use App\Models\Pages;

class Homepage extends Controller
{
    public function __construct() {
        view()->share('pages',Pages::orderBy('order','ASC')->get());
        view()->share('categories',Category::inRandomOrder()->get());
    }
    public function index() {
        $data['articles'] = Article::orderBy('created_at','DESC')->paginate(1);
        $data['articles']->withPAth(url('yazilar/sayfa'));
        return view('frontend.homepage',$data);
    }

    public function single($category,$slug){
        $category = Category::whereSlug($category)->first() ?? abort(403,'Böylebir kategori bulunamadı...');
        $article =  Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403,'Böylebir yazı bulunamadı...');
        $article->increment('hit');
        $data['article'] = $article;
        return view('frontend.single',$data);
    }

    public function category($slug) {
        $category = Category::whereSlug($slug)->first() ?? abort(403,'Böylebir kategori bulunamadı...');
        $data['articles'] =Article::whereCategoryId($category->id)->orderBy('created_at','DESC')->paginate(1);
        $data['category'] = $category;
        return view('frontend.category',$data);
    }

    public function page($slug) {
        $page = Pages::whereSlug($slug)->first() ?? abort(403,'Böylebir sayfa bulunamadı...');
        $data['page'] = $page;
        return view('frontend.page',$data);
    }


}
