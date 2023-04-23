<?php

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\AnnouncementController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
    return view('welcome');
});

Route::get('/email/verify', function () {
    $user = Auth::user();

    if ($user->hasVerifiedEmail()) {
        return redirect()->route('home');
    }

    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified',]);
Route::middleware(['auth', 'verified', 'approved'])->group(function () {
    Route::resource('/announcements', AnnouncementController::class);
    Route::get('/delete/announcement/{announcement}', [AnnouncementController::class, 'delete'])->name('announcements.delete');

    Route::resource('/jobs', JobController::class);
    Route::get('/jobs/{job}/apply', [JobController::class, 'goToJobApply'])->name('jobs.apply');
    Route::get('/delete/job/{job}', [JobController::class, 'delete'])->name('jobs.delete');

    Route::resource('/apply', ApplyController::class);

    Route::resource('/socialmedia', SocialMediaController::class);

    Route::resource('/userprofile', UserController::class);
    Route::get('userprofile.view', [UserController::class, 'userIndex'])->name('userprofile.userIndex');
    Route::get('/users', [UserController::class, 'userIndex'])->name('userIndex');
    Route::get('/user/profile/{id}', [UserController::class, 'show'])->name('user.profile');


    Route::prefix('admin')->name('admin.')->middleware('auth:sanctum')->group(function () {
        Route::get('pending-users', [UserController::class, 'getPendingUsers'])->name('pending-users');
        Route::get('approve-user/{user}', [UserController::class, 'approveUser'])->name('approve-user');
        Route::get('decline-user/{user}', [UserController::class, 'declineUser'])->name('decline-user');
    });
});
