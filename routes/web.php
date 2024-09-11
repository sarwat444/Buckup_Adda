<?php
use App\Http\Controllers\Web\Auth\User\{ForgetPasswordController, LoginController, NewPasswordController};
use App\Http\Controllers\Web\SetLanguageController;
use App\Http\Controllers\Web\Site\{
    HomeController,
    UserCourseController ,
    ObjectiveController ,
    GoalController ,
    ProgramController ,
    MangementController ,
    MokasherController ,
    UsersController
};

use Illuminate\Support\Facades\Route;

/** site routes */



Route::get('/', [HomeController::class, 'Home'])->name('Home');

Route::get('/login', [HomeController::class, 'login'])->name('login')->middleware('CheckCredentials');

Route::post('/login', [HomeController::class, 'authenticate'])->name('authenticate');
Route::post('/login', [HomeController::class, 'authenticate'])->name('authenticate');

Route::group(['as' => 'gehat.', 'middleware' => ['auth','checkIsManger']], function () {

    Route::get('/gehat', [HomeController::class, 'index'])->name('index');

    Route::post('update_mokasher_parts' ,  [MokasherController::class , 'update_mokasher_parts'])->name('update_mokasher_parts') ;

    /** Objectives  routes */

    Route::resource('objectives', ObjectiveController::class);

    /** Goals  routes */

    Route::resource('goals', GoalController::class);

    /** Programs  routes */

    Route::resource('programs', ProgramController::class);

    /** Mokshrat  routes */

    Route::resource('moksherat', MokasherController::class);

    Route::resource('users', UsersController::class);

    Route::get('mokaseerinput/{id}' , [MokasherController::class , 'mokaseerinput'])->name('mokaseerinput') ;

    Route::post('redirect_mokasher/{id}' , [MokasherController::class , 'redirect_mokasher'])->name('redirect_mokasher') ;

    Route::get('mokasherData/{id}' , [MokasherController::class , 'mokasherData'])->name('mokasherData') ;

    Route::post('/gehat_logout' , [HomeController::class ,  'logout'])->name('Gehtlogout');

    Route::match(['get', 'post'],'get_users_reports' , [UsersController::class , 'get_users_reports'])->name('get_users_reports') ;

    Route::get('print_users_part/{sub_geha}/{part}', [UsersController::class , 'print_users_part'])->name('print_users_part');
    Route::get('print_users_years/{sub_geha}/{year_id}', [UsersController::class , 'print_users_years'])->name('print_users_years');



    Route::match(['get', 'post'], 'get_users_reports_year', [UsersController::class, 'get_users_reports_year'])->name('get_users_reports_year');

});

Route::group(['as' => 'sub_geha.'  ,'middleware' => ['auth' ,'CheckSubGehaManger']], function () {
    Route::post('/logout' , [HomeController::class ,  'logout'])->name('logout') ;
    Route::get('/sub_geha', [HomeController::class, 'subgeha'])->name('index');
    Route::get('sub_geha_moksherat', [MokasherController::class , 'sub_geha_moksherat'])->name('sub_geha_moksherat');
    Route::get('sub_geha_mokaseerinput/{id}' , [MokasherController::class , 'sub_geha_mokaseerinput'])->name('sub_geha_mokaseerinput') ;
    Route::post('store2_sub_geha_mokasher_input/{id}' , [MokasherController::class , 'store2_sub_geha_mokasher_input'])->name('store2_sub_geha_mokasher_input') ;
    Route::post('store_sub_geha_mokasher_input/{id}' ,   [MokasherController::class , 'store_sub_geha_mokasher_input'])->name('store_sub_geha_mokasher_input') ;
    Route::delete('/delete-file/{id}',[MokasherController::class , 'delete_file'])->name('delete.file');
});
Route::get('language/{lang}',SetLanguageController::class)->name('language')->whereIn('lang', ['de', 'en']);
