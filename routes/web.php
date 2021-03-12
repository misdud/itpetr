<?php

//use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	//get main shema
    //$urlMainShema=config('constants.options.shema_webip22_petr_main');

	return view('welcome', ['showTopMenu'=>true,'isShowFooter'=>false, 'isShowSidebarClass'=>true]);
})->name('welcome');

/*----------for-----mnemoSchems-----------------*/
Route::get('/main_schema', [App\Http\Controllers\Schema\MainControllerSchema::class, 'mainSchema'])->name('main_schema');
Route::get('/main_schema_params', [App\Http\Controllers\Schema\MainControllerSchema::class, 'mainSchemaParams'])->name('main_schema_param');
Route::get('/main_raport_sof', [App\Http\Controllers\Schema\MainControllerSchema::class, 'mainRaportSof'])->name('main_raport_sof');
Route::get('/main_raport_ru', [App\Http\Controllers\Schema\MainControllerSchema::class, 'mainRaportRu'])->name('main_raport_ru');
/*----------end-----mnemoSchems-----------------*/


/*----------for-----pages-----------------*/
Route::get('/main_contacts', [App\Http\Controllers\Page\MainContactController::class, 'index'])->name('main_contacts');

Route::get('/managers', [App\Http\Controllers\Page\MainManagerController::class, 'index'])->name('managers');
/*----------end-----pages-----------------*/


Route::get('/404', function(){
    return view('error404');
});

Route::get('/test', function(Request $request){
	$req=request()->route()->getName();
	echo $req;
	echo "111";
});

/*----------for-----leftSidebar-----------------*/
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');










//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Auth::routes();

//Route::get('/dashboard', 'App\Http\Controllers\HomeController@index')->name('dashboard');

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::patch('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::patch('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});


Route::fallback(function(){
    return view('error404');
});