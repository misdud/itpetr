<?php

//use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Catalog\Manager\DepartmentController;
use App\Http\Controllers\Catalog\Manager\SubDepartmentController;
use App\Http\Controllers\Catalog\Manager\PositionController;
use App\Http\Controllers\Catalog\Manager\RoleController;
use App\Http\Controllers\Catalog\Manager\UserController;
use App\Http\Controllers\Catalog\Manager\ProjectController;
use App\Http\Controllers\Catalog\Manager\TiaPortalController;
use App\Http\Controllers\Catalog\Manager\SvodController;
use App\Http\Controllers\Catalog\Manager\NewController;





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

/*
Route::get('/password', function(){
	$pass = Hash::make('1');
	echo $pass;
});
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
/*----------for---menedger --- list---------------*/
Route::get('/managers_rudoupravlenia', [App\Http\Controllers\Manager\MainManagerListController::class, 'showRudoupravlenie'])->name('managers_rudoupravl');
Route::get('/managers_rudnik', [App\Http\Controllers\Manager\MainManagerListController::class, 'showRudnik'])->name('managers_rudnik');
Route::get('/managers_sof', [App\Http\Controllers\Manager\MainManagerListController::class, 'showSof'])->name('managers_sof');
Route::get('/managers_tes', [App\Http\Controllers\Manager\MainManagerListController::class, 'showTes'])->name('managers_tes');
Route::get('/managers_vspomogatel', [App\Http\Controllers\Manager\MainManagerListController::class, 'showVspomogat'])->name('managers_vspomogatel');
Route::get('/manager_search', [App\Http\Controllers\Manager\MainManagerListController::class, 'showManagerSearch'])->name('manager_search');

//------for---busSheduler
Route::get('/busschedule1', [App\Http\Controllers\Autobus\BusScheduleController::class, 'busschedule1'])->name('busschedule_1');
Route::get('/busschedule2', [App\Http\Controllers\Autobus\BusScheduleController::class, 'busschedule2'])->name('busschedule_2');
Route::get('/busschedule3', [App\Http\Controllers\Autobus\BusScheduleController::class, 'busschedule3'])->name('busschedule_3');
Route::get('/busschedule4', [App\Http\Controllers\Autobus\BusScheduleController::class, 'busschedule4'])->name('busschedule_4');

//---------for--document-----------------
Route::get('/doc_collective_agreement21php', [App\Http\Controllers\Document\DocumentsController::class, 'showCollectivDogovor'])->name('show_col_dog');

//---------for--contact ------------------
Route::get('/list_contact', [App\Http\Controllers\Сontact\ContactController::class, 'showListContact'])->name('show_list_contact');
Route::get('/search_contact', [App\Http\Controllers\Сontact\ContactController::class, 'searchContact'])->name('search_contact');
Route::get('/all_contact', [App\Http\Controllers\Сontact\ContactController::class, 'showAllContactPDF'])->name('show_all_contact_pdf');

//---------for--News-------------------*/
Route::get('/all_news', [App\Http\Controllers\News\NewsController::class, 'index'])->name('show_list_news');
Route::get('/newsshowone/{id}', [App\Http\Controllers\News\NewsController::class, 'showOne'])->where('id', '[0-9]+')->name('show_news_one');

//---------for--DR---------------------*/
Route::get('/dr_today', [App\Http\Controllers\Birthday\MainBirthdayController::class, 'drToday'])->name('dr_today');
Route::get('/dr_tomorrow', [App\Http\Controllers\Birthday\MainBirthdayController::class, 'drTomorrow'])->name('dr_tomorrow');
Route::get('/dr_listpdf', [App\Http\Controllers\Birthday\MainBirthdayController::class, 'drListPDF'])->name('dr_listPDF');
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

/*---------for-----admins----------*/
/*--------for-----catalog---управление --- справочниками------*/
Auth::routes();
Route::group(['middleware' => 'auth'], function () {

	Route::get('/main_catalogs', [\App\Http\Controllers\Catalog\Manager\MainManagerController::class, 'index'])->name('main_catalogs');
	Route::get('/wincc_tia_catalogs', [\App\Http\Controllers\Catalog\Manager\MainManagerController::class, 'indexWinCCTia'])->name('wincc_tia_catalogs');
	Route::resource('/departments', DepartmentController::class)->only([ 'create', 'store','edit','update']);
	Route::get('/sub_departments/sort/', [SubDepartmentController::class, 'selectDepart'])->name('sub_sortdepartments');
	Route::resource('/sub_departments', SubDepartmentController::class)->only([ 'index','create', 'store','edit','update']);
	Route::resource('/positions', PositionController::class)->only([ 'index','create', 'store','edit','update']);
	Route::resource('/roles', RoleController::class)->only([ 'index','create', 'store','edit','update']);
	/*       for resorce projects        */
	Route::get('/projectwincsearch', [ProjectController::class, 'projectwinccsearch'])->name('projectwincc_search');
	Route::post('/projectwinlinktia', [ProjectController::class, 'projectwinlinktia'])->name('projectwincc_linktia');
	Route::delete('/projectwindeletlinktia/{tiaid}', [ProjectController::class, 'projectwindeletlinktia'])->name('projectwincc_deletlinktia');
	Route::resource('/projectwinccs', ProjectController::class)->only([ 'index', 'show', 'create', 'store','edit','update', 'destroy']);
	Route::get('/projecttping/{id}', [TiaPortalController::class, 'mypingtia'])->name('ping_tia');
	Route::get('/projecttiasearch', [TiaPortalController::class, 'projecttiasearch'])->name('projecttia_search');
	Route::resource('/projecttias', TiaPortalController::class)->only([ 'index', 'show', 'create', 'store','edit','update', 'destroy']);
	/*       for resorce users         */
	Route::get('/userdeprt', [UserController::class, 'userDeprt'])->name('user_deprt');
	Route::get('/usereditdep/{depatr}/{user}', [UserController::class, 'userEditDep'])->name('user_editdep');
	Route::get('/useresetup', [UserController::class, 'userEditSet'])->name('user_editsetup');
	Route::post('/userrespsw', [UserController::class, 'userresetpaswd'])->name('user_resetpaswd');
	Route::post('/userrole/{user}', [UserController::class, 'userresetrole'])->name('user_setrole');
	Route::delete('/userdeletrole/{user}', [UserController::class, 'userdeletrole'])->name('user_deletrole');
	Route::get('/usersearch', [UserController::class, 'usersearch'])->name('user_search');
	Route::resource('/users', UserController::class);
    /*       for resorce svodks        */
    Route::get('/postsearch', [SvodController::class, 'postsearch'])->name('post_search');
    Route::resource('/svodks', SvodController::class);
	/*       for resorce news        */
	Route::get('/newssearch', [NewController::class, 'newssearch'])->name('news_search');
	Route::resource('/news', NewController::class);

    // почистить и удалить так как где-то используются
	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');// на эту после регистрации
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::patch('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::patch('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']); 

	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
    // end почистить

});
//Route::post('/sortsub_departments', [\App\Http\Controllers\Catalog\Manager\SortSubDepartmentController::class, 'selectDepart'])->name('sortsub_departments');
/*---------end-----admins----------*/





//Route::get('/dashboard', 'App\Http\Controllers\HomeController@index')->name('dashboard');

/*----23042021
Auth::routes();
Route::group(['middleware' => 'auth'], function () {

	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
*/