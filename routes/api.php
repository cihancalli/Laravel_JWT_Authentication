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

Route::controller(\App\Http\Controllers\Api\UserController::class)->group(function () {
    Route::get('/users','index');
    Route::get('/user/{id}','show');
    Route::post('/user','store');
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
            "uid" => 13,
            "username" => 'cihancalli',
            "email" => 'cihan.callii@gmail.com'
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

/*
 * if ($request->name == 'cihan' && $request->password == '123456123456'){
        $secretKey = getenv('TOKEN_SECRET_KEY');

        $payload = array(
            "iat" => time(),
            "exp" => time()+ 60 * 60 * 1,
            "uid" => 13,
            "username" => 'cihancalli',
            "email" => 'cihan.callii@gmail.com'
        );
        $token = JWT::encode($payload, $secretKey, 'HS256');
        return response()->json(['token'=> $token]);
    }
 */
