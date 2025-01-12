<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Firebase\JWT\JWT;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(\App\Http\Controllers\Api\ItemController::class)->group(function () {
    Route::get('/items','index')->middleware(['jwt']);
    Route::get('/item/{id}','show')->middleware(['jwt']);
    Route::post('/item','store')->middleware(['jwt']);
    Route::put('/item/{id}','update')->middleware(['jwt']);
    Route::delete('/item/{id}','destroy')->middleware(['jwt']);
});

Route::controller(\App\Http\Controllers\Api\ContactController::class)->group(function () {
    Route::get('/contacts','index')->middleware(['jwt']);
    Route::get('/contact/{id}','show')->middleware(['jwt']);
    Route::post('/contact','store')->middleware(['jwt']);
    Route::put('/contact/{id}','update')->middleware(['jwt']);
    Route::delete('/contact/{id}','destroy')->middleware(['jwt']);
});

Route::controller(\App\Http\Controllers\Api\PagesController::class)->group(function () {
    Route::get('/pages','index')->middleware(['jwt']);
    Route::get('/page/{id}','show')->middleware(['jwt']);
    Route::post('/page','store')->middleware(['jwt']);
    Route::put('/page/{id}','update')->middleware(['jwt']);
    Route::delete('/page/{id}','destroy')->middleware(['jwt']);
});

Route::controller(\App\Http\Controllers\Api\ArticleController::class)->group(function () {
    Route::get('/articles','index')->middleware(['jwt']);
    Route::get('/article/{id}','show')->middleware(['jwt']);
    Route::post('/article','store')->middleware(['jwt']);
    Route::put('/article/{id}','update')->middleware(['jwt']);
    Route::delete('/article/{id}','destroy')->middleware(['jwt']);
});

Route::controller(\App\Http\Controllers\Api\CategoryController::class)->group(function () {
    Route::get('/categories','index')->middleware(['jwt']);
    Route::get('/category/{id}','show')->middleware(['jwt']);
    Route::post('/category','store')->middleware(['jwt']);
    Route::put('/category/{id}','update')->middleware(['jwt']);
    Route::delete('/category/{id}','destroy')->middleware(['jwt']);
});

Route::controller(\App\Http\Controllers\Api\UserController::class)->group(function () {
    Route::get('/users','index')->middleware(['jwt']);
    Route::get('/user/{id}','show')->middleware(['jwt']);
    Route::post('/user','store')->middleware(['jwt']);
    Route::put('/user/{id}','update')->middleware(['jwt']);
    Route::delete('/user/{id}','destroy')->middleware(['jwt']);
});

Route::post('/login', function (Request $request){
    $user = User::where('name',$request->name)->first();

    if ($user == null){
        return response()->json(['status'=>0, 'msg'=>'Kullanıcı adı bulunamadı...'],403);
    } else if ($request->name == $user['name'] && $request->password == $user['password']) {
        $secretKey = getenv('TOKEN_SECRET_KEY');
        $payload = array(
            "iat" => time(),
            "exp" => time()+ 60 * 60 * 1,
            "uid" => $user->id,
            "username" => $user->name,
            "email" => $user->email
        );
        $token = JWT::encode($payload, $secretKey, 'HS256');
        return response()->json(['token'=> $token]);
    } else{
        return response()->json(['status'=>0, 'msg'=>'Yanlış şifre girdiniz...'],403);
    }

});


Route::post('/task',function () {
    return response()->json(['Taslaklar']);
})->middleware(['jwt']);
