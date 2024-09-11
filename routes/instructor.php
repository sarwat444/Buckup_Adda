<?php

use App\Http\Controllers\Web\Instructor\{CourseSectionController,
    ProfileController,
    LessonController,
    DashboardController,
    CourseController,
    SectionController
};
use Illuminate\Support\Facades\Route;

/** instructors dashboard routes */
Route::group(['prefix' => 'instructors/dashboard', 'middleware' => ['auth', 'instructor'], 'as' => 'dashboard.instructors.'], function () {

    /** instructors routes dashboard */
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    /** instructors routes courses */
    Route::resource('courses', CourseController::class);
    Route::get('courses/{course}/video', [CourseController::class, 'courseVideo'])->name('courses.video');
    Route::post('courses/{course}/video/upload', [CourseController::class, 'courseVideoUpload'])->name('courses.video.upload');
    Route::delete('courses/{course}/video/delete', [CourseController::class, 'courseVideoDelete'])->name('courses.video.delete');
    Route::get('courses/{course}/sections', [CourseSectionController::class, 'courseSections'])->name('courses.sections');


    /** instructors routes sections */
    Route::post('sections/{section}/update-lessons-order', [SectionController::class, 'updateLessonsOrder'])->name('sections.update.order');
    Route::resource('sections', SectionController::class);


    /** lessons routes */
    Route::get('lessons-datatables', [LessonController::class, 'lessonsDatatables'])->name('lessons.datatables');
    Route::post('store-document-lesson', [LessonController::class, 'documentStore'])->name('lessons.store.document');
    Route::put('update-document-lesson/{lesson}', [LessonController::class, 'documentUpdate'])->name('lessons.update.document');
    Route::put('update-video-lesson/{lesson}', [LessonController::class, 'videoUpdate'])->name('lessons.update.video');
    Route::resource('lessons', LessonController::class);


    Route::post('lessons/{lesson}/video/uploaded', [LessonController::class, 'assignVideoLessonToFolder'])->name('lessons.video.uploaded');
    Route::post('store-video-lesson', [LessonController::class, 'videoStore'])->name('lessons.store.video');
    Route::get('lessons/{lesson}/video/status', [LessonController::class, 'checkLessonVideoStatus'])->name('lessons.video.check');
    Route::get('lessons/{lesson}/comments-datatables', [LessonController::class, 'lessonCommentsDatatable'])->name('lessons.comments.datatables');
    Route::get('lessons/{lesson}/comments', [LessonController::class, 'comments'])->name('lessons.comments');
    Route::get('lessons/{lesson}/likes', [LessonController::class, 'likes'])->name('lessons.likes');
    Route::get('lessons/{lesson}/likes-datatables', [LessonController::class, 'lessonLikesDatatable'])->name('lessons.likes.datatables');
    Route::get('lessons/{lesson}/views', [LessonController::class, 'views'])->name('lessons.views');
    Route::get('lessons/{lesson}/views-datatables', [LessonController::class, 'lessonViewsDatatable'])->name('lessons.views.datatables');

    Route::get('profile/me', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/me/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/me/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/me/send-new-email-verification', [ProfileController::class, 'sendNewEmailVerificationNotification'])->name('profile.update.email');

});

Route::get('profile/me/verify-email/{id}/{hash}', [ProfileController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');

