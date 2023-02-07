<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    Route::resource('/jobs', JobController::class);
    Route::get('/jobs/{job}', [JobController::class, 'delete'])->name('jobs.delete');

    Route::prefix('admin')->name('admin.')->middleware('auth:sanctum')->group(function () {
        Route::get('pending-users', [UserController::class, 'getPendingUsers'])->name('pending-users');
    });
});
