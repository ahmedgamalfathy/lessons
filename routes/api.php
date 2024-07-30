<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteRegistrar;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Tag;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\RelationshipController;
use App\Http\Controllers\API\LoginController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function () {
    //Route lesson
    Route::Resource('lesson',LessonController::class);
    Route::resource('user', UserController::class);
    Route::resource('tag', TagController::class);
    /*Route::any('lessons', function () {
        $message= "please make sure to update your code to use the newer version of our API.
        you should use lessons instead of lesson";
        return response()->json($message, 404);
    });*/

// Relationship between table
    Route::get('users/{id}/lessons',[ RelationshipController::class,'userlessons']);
    Route::get('lessons/{id}/tags',[ RelationshipController::class,'lessontags']);
    Route::get('tags/{id}/lessons',[ RelationshipController::class,'taglessons']);
    Route::get('/login',[LoginController::class ,'login'])->name('login');
/*
لو انت عاوز تجبر المستخدم ان يكون اي دي  رقم و الاسم يكون نص ؟؟
في طريقتين
1)  ->where(['id'=>'[0-9]+','name'=>'[a-z]+']);
2)App\providers\routeserviceprovider => function boot(){ Route::pattern('id','[0-9]+' }
 */
//route username.example.com
    /*    Route::domain('{account}.mypp.com')->group(function(){
                Route::get('users/{id}', function ($account,$id) {   
                });
        });*/
// لو في عمود تاني غير اي دي يكون كذلك        
     /*   Route::get('lessons/{lesson:slug}',function($lesson){
            return $lesson;
        });*/
//لاخطاء 404
      /*   Route::fallback(function(){
            //
        }); */

});

