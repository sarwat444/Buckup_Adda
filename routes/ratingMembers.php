<?php
use App\Http\Controllers\Web\Site\{
    RatingMembersController,
};

use Illuminate\Support\Facades\Route;

Route::get('/ratingLogin' , [RatingMembersController::class , 'login'])->name('ratingLogin');
Route::post('/ratingLogin', [RatingMembersController::class ,'ratingLogin'])->name('ratingLogin') ;
/** admin dashboard routes */

Route::group(['middleware' => 'auth:ratingMember', 'as' => 'rating.'], function () {
    Route::get('rating_gehat', [RatingMembersController::class, 'rating_gehat'])->name('rating_gehat');
    Route::get('rating_mokshart/{id}' , [RatingMembersController::class, 'rating_mokshart'])->name('rating_mokshart') ;
    Route::get('ratinginput/{id}' , [RatingMembersController::class, 'ratinginput'])->name('ratinginput') ;
    Route::post('storeRating' , [RatingMembersController::class, 'storeRating'])->name('storeRating') ;
});
