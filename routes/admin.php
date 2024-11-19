<?php

use App\Http\Controllers\Web\Auth\Admin\{ForgetPasswordController, LoginController, NewPasswordController};
use App\Http\Controllers\Web\Admin\{
    CourseController,
    CourseSectionController,
    LessonController,
    SectionController,
    CategoryController,
    DashboardController,
    VimeoFolderController,
    InstructorRequestController ,
    objectivesController ,
    GoalController ,
    ProgramController ,
    MokasherController ,
    UsersController ,
    MangementController ,
    KhetaController ,
    RatingMembersController ,
    MailController ,
    RolesController ,
    permissionController
};


use App\Http\Controllers\Web\Admin\Setting\{CourseSettingController};
use Illuminate\Support\Facades\Route;
CONST PUBLIC_PATH  = '' ;

/** admin auth routes */
Route::controller(LoginController::class)->prefix('admins')->group(function () {
    Route::get('login', 'create')->name('admins.login')->middleware('guest:admin');
    Route::post('login', 'store')->middleware('throttle:5,1');
    Route::post('logout', 'destroy')->name('admins.logout')->middleware('auth:admin');
});


/** admin reset password routes */
Route::controller(ForgetPasswordController::class)->prefix('admins')->middleware('guest:admin')->group(function () {
    Route::get('forget-password', 'create')->name('admins.password.request');
    Route::post('forget-password', 'store')->name('admins.password.email')->middleware('throttle:5,1');;
});

/** admin new password routes */
Route::controller(NewPasswordController::class)->prefix('admins')->middleware('guest:admin')->group(function () {
    Route::get('reset-password/{token}', 'create')->name('admins.password.reset');
    Route::post('reset-password', 'store')->name('admins.password.update');
});


/** admin dashboard routes */
Route::group(['prefix' => 'admins/dashboard', 'middleware' => 'auth:admin', 'as' => 'dashboard.'], function () {

    Route::get('/', [KhetaController::class , 'index'])->name('index');
    Route::get('/yearDashboard/{year_id}' , [DashboardController::class, 'yearDashboard'])->name('yearDashboard');



    Route::get('/objectivesDashboard/{kheta_id}/{year_id?}' , [DashboardController::class, 'kheta_dashboard'])->name('objectivesDashboard');
    Route::get('/goal_statastics/{kheta_id}/{objective_id}/{year_id?}' , [DashboardController::class, 'goal_statastics'])->name('goal_statastics');
    Route::get('/program_statastics/{kheta_id}/{goal_id}/{year_id?}' , [DashboardController::class, 'program_statastics'])->name('program_statastics');
    Route::get('/mokashrat_statastics/{kheta_id}/{program_id}/{year_id?}/{part?}' , [DashboardController::class, 'mokashrat_statastics'])->name('mokashrat_statastics');

   /**Send Mail */
 Route::get('send-mail' , [MailController::class , 'index'])->name('send_mail') ;

    /** Filter With Year */
    Route::get('/mokasherat_year/{year_id}' , [DashboardController::class, 'mokasherat_year'])->name('mokasherat_year');

    /** Kehat Routes */
    Route::resource('kheta', KhetaController::class);

    /** Rating Members */
    Route::resource('ratingMembers', RatingMembersController::class);

    route::get('CreateratingMembers/{id}' ,[RatingMembersController::class , 'CreateratingMembers'])->name('CreateratingMembers') ;

    /** categories routes */
    Route::resource('categories', CategoryController::class);

        /** Objectives  routes */
    Route::resource('objectives', objectivesController::class);

    /** Goals  routes */
    Route::resource('goals', GoalController::class);

    /** Programs  routes */
    Route::resource('programs', ProgramController::class);

    /** Mokshrat  routes */
    Route::resource('moksherat', MokasherController::class);

    /** Mangements */

    Route::resource('mangements',MangementController::class);
    Route::get('createmangement/{id}' ,  [MangementController::class ,  '']);

    /** Mokshrat  routes */

    Route::resource('users', UsersController::class);
    Route::post('change_execution_year' , [UsersController::class ,'change_execution_year'])->name('change_execution_year');

    /** Roles Routes  */
    Route::resource('roles', RolesController::class) ;

    Route::get('roles/{roleId}/give-permissions', [RolesController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RolesController::class, 'givePermissionToRole']);
  /** Permission Routes */
  Route::resource('Permissions', permissionController::class);
    /** Admins Routes */
    Route::get('admins', [UsersController::class, 'admins'])->name('users.admins');
     Route::get('editadmin/{id}', [UsersController::class, 'editadmin'])->name('admins.edit');
      Route::PUT('updateadmin/{id}', [UsersController::class, 'updateadmin'])->name('admins.updateadmin');
     Route::get('createadmin', [UsersController::class, 'createadmin'])->name('admins.create');
      Route::post('destory_admin', [UsersController::class, 'destory_admin'])->name('admins.destroy');
      Route::post('storeadmin', [UsersController::class, 'storeadmin'])->name('admins.storeAdmin');




    /** Mokshrat  Input  */
    Route::get('get_mokaseerinput/{id}', [MokasherController::class , 'mokaseerinput'])->name('moksherat.mokaseerinput');
    Route::post('store_mokaseerinput', [MokasherController::class , 'store_mokaseerinput'])->name('moksherat.store_mokaseerinput');

    /** sections routes */
    Route::resource('sections', SectionController::class);
    Route::get('sections-datatables', [SectionController::class, 'sectionsDatatables'])->name('sections.datatables');
    Route::post('sections/{section}/update-lessons-order', [SectionController::class, 'updateLessonsOrder'])->name('sections.update.order');


    /** Reports Routes */
    Route::get('mokasherat_gehat_report/{kheta_id}/{year_id?}/{part?}' ,[DashboardController::class ,'mokasherat_gehat_report'])->name('mokasherat_gehat_report') ;
    Route::get('print_mokasherat_gehat_report/{kheta_id}/{year_id?}/{part?}' ,[DashboardController::class ,'print_mokasherat_gehat_report'])->name('print_mokasherat_gehat_report') ;
    Route::post('mokasherat_gehat_report' ,[DashboardController::class ,'mokasherat_gehat_report']);


   /** Gehat Targets And Parts */

   Route::get('gehat_targets_report/{kheta_id}/{year_id?}/{part?}' ,[DashboardController::class ,'gehat_targets_report'])->name('gehat_targets_report') ;
   Route::get('print_gehat_targets_report/{kheta_id}/{year_id?}/{part?}' ,[DashboardController::class ,'print_gehat_targets_report'])->name('print_gehat_targets_report') ;
   Route::post('gehat_targets_report' ,[DashboardController::class ,'gehat_targets_report']);



    Route::get('mokasherat_files_report/{kheta_id}/{year_id?}/{part?}' ,[DashboardController::class ,'mokasherat_files_report'])->name('mokasherat_files_report');


   Route::get('mokasherat_wezara/{kheta_id}/{year_id?}/{part?}' ,[DashboardController::class ,'mokasherat_wezara'])->name('mokasherat_wezara');
    Route::get('print_mokasherat_wezara/{kheta_id}/{year_id}' ,[DashboardController::class ,'print_mokasherat_wezara'])->name('print_mokasherat_wezara');




    Route::get('print_gehat_mokasherat/{kheta_id}/{year_id}' ,[DashboardController::class ,'print_gehat_mokasherat'])->name('print_gehat_mokasherat');
    Route::post('print_users_report' ,[DashboardController::class ,'print_users_report'])->name('print_users_report');


    Route::post('mokasherat_files_report' ,[DashboardController::class ,'mokasherat_files_report']);



    Route::get('/Histogram_kheta_objectives_dashboard/{kheta_id}/{year_id?}' , [DashboardController::class, 'Histogram_kheta_objectives_dashboard'])->name('Histogram_kheta_objectives_dashboard');
    Route::get('/Histogram_goal_statastics/{kheta_id}/{objective_id}' , [DashboardController::class, 'Histogram_goal_statastics'])->name('Histogram_goal_statastics');
    Route::get('/Histogram_program_statastics/{kheta_id}/{goal_id}/{year_id?}' , [DashboardController::class, 'Histogram_program_statastics'])->name('Histogram_program_statastics');
    Route::get('/Histogram_mokashrat_statastics/{kheta_id}/{program_id}/{year_id?}/{part?}' , [DashboardController::class, 'Histogram_mokashrat_statastics'])->name('Histogram_mokashrat_statastics');

    Route::get('print_objectives_histogram/{kheta_id}' ,[DashboardController::class, 'print_objectives_histogram'])->name('print_objectives_histogram') ;

   /** Active Users Report  */

    Route::get('/getLastSeenUsers/{kheta_id}' , [DashboardController::class, 'getLastSeenUsers'])->name('active_users');

    /** تقرير  الربع سنوى  والتقرير السنوى للجهات */

    Route::match(['get' , 'post'] ,'quarter_year/{kheta_id}' , [MokasherController::class , 'quarter_year'])->name('quarter_year') ;

    /** admin settings routes */
    Route::group(['prefix' => 'settings', 'as' => 'settings.courses.homepage.'], function () {
        Route::get('/courses', [CourseSettingController::class, 'index'])->name('index');
        Route::put('/courses/{course}/course-top', [CourseSettingController::class, 'updateTopCourse'])->name('top');
    });
    Route::get('/createuser/{id}' ,  [UsersController::class ,  'createuser'])->name('createuser') ;

});
