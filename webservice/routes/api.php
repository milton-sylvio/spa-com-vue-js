<?php
// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
use App\User;
use App\Content;
use App\Comment;

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
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::middleware('auth:api')->put('/profile', 'UserController@profile');

Route::middleware('auth:api')->post('/content/add', 'ContentController@add');
Route::middleware('auth:api')->get('/content/list', 'ContentController@list');
Route::middleware('auth:api')->put('/content/like/{id}', 'ContentController@like');
Route::middleware('auth:api')->put('/content/comment/{id}', 'ContentController@comment');

Route::middleware('auth:api')->get('/content/page/{id}', 'ContentController@page');

Route::middleware('auth:api')->post('/user/friend', 'UserController@friend');

Route::get('/testes', function() {
  // Add Comentários
  /* $user = User::find(1);
  $content = Content::find(12);
  $user->comments()->create([
    'content_id' => $content->id,
    'text' => 'Occaecat sunt do excepteur Lorem elit pariatur amet deserunt consectetur aute deserunt est fugiat cillum.',
    'date' => date('Y-m-d H:i:s')
  ]); */


  /* 
  $user = User::find(1);
  $user2 = User::find(2);

  $contents = Content::all();

  foreach($contents as $key => $value) {
    $value->delete();
  }

  $user->contents()->create([
    'title' => 'Título do Conteúdo 3',
    'text' => 'Texto do conteúdo 32',
    'image' => 'url da imagem 3',
    'link' => 'Link do conteúdo 3',
    'date' => date('Y-m-d')
  ]);

  return $user->contents;*/

  // Add Amigos
  /* 
  $user->friends()->attach($user2->id);
  $user->friends()->detach($user2->id);
  $user->friends()->toggle($user2->id);
  return $user->friends; 
  */

  // Add Curtidas
  /* $content = Content::find(1);
  $user->likes()->toggle($content->id);

  // return $content->likes()->count();
  return $content->likes(); */

  // Add Comentários
  /* $content = Content::find(1);
  $user->comments()->create([
    'content_id' => $content->id,
    'text' => 'Occaecat sunt do excepteur Lorem elit pariatur amet deserunt consectetur aute deserunt est fugiat cillum.',
    'date' => date('Y-m-d')
  ]);
  $user2->comments()->create([
    'content_id' => $content->id,
    'text' => 'Do pariatur nisi ut excepteur.',
    'date' => date('Y-m-d')
  ]);

  return $content->comments; */
});