<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminSearch;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ExportExcelController;
use App\Http\Controllers\JobOfferingsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\KontaktController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ...your existing routes...

Route::get('interim-juristen', [PageController::class, 'juristen']);
Route::get('legal-juristen', [PageController::class, 'legalInterim']);
Route::get('outsourcing', [PageController::class, 'outsourcing']);
Route::get('perm-juristen', [PageController::class, 'permJuristen']);

Route::get('impressum', [PageController::class, 'impressum']);
Route::get('datenschutz', [PageController::class, 'datenschutz']);

Route::get('kontakt', [KontaktController::class, 'getContact']);
Route::post('kontakt', [KontaktController::class, 'postContact']);

Route::get('suche', [SearchController::class, 'index']);
Route::get('suche/{search}', [SearchController::class, 'search']);

Route::middleware('auth')->group(function () {
    Route::get('account/details', [AccountController::class, 'getDetails']);
    Route::post('account/details', [AccountController::class, 'postDetails']);

    Route::get('account/auslands-projekte', [AccountController::class, 'getAuslandsProjekte']);
    Route::post('account/auslands-projekte', [AccountController::class, 'postAuslandsProjekte']);

    Route::get('account/mandate', [AccountController::class, 'getMandate']);
    Route::post('account/mandate', [AccountController::class, 'postMandate']);

    Route::get('account/karriere', [AccountController::class, 'getKarriere']);
    Route::post('account/karriere', [AccountController::class, 'postKarriere']);

    Route::get('account/faehigkeiten', [AccountController::class, 'getFaehigkeiten']);
    Route::post('account/faehigkeiten', [AccountController::class, 'postFaehigkeiten']);

    Route::get('account/verantwortung', [AccountController::class, 'getVerantwortung']);
    Route::post('account/verantwortung', [AccountController::class, 'postVerantwortung']);

    Route::get('account/schwerpunkte', [AccountController::class, 'getSchwerpunkte']);
    Route::post('account/schwerpunkte', [AccountController::class, 'postSchwerpunkte']);

    Route::get('account/dokumente', [AccountController::class, 'getDokumente']);
    Route::post('account/dokumente', [AccountController::class, 'postDokumente']);
    Route::get('account/dokumente/delete/{id}', [AccountController::class, 'deleteDokumente']);

    Route::prefix('json')->group(function () {
        Route::get('ausland', [JsonController::class, 'ausland']);
        Route::get('mandat', [JsonController::class, 'mandat']);
        Route::get('karriere', [JsonController::class, 'karriere']);
        Route::get('skills', [JsonController::class, 'skills']);
        Route::get('verantwortung', [JsonController::class, 'verantwortung']);
        Route::get('kompetenz', [JsonController::class, 'kompetenz']);
        Route::get('userKompetenz', [JsonController::class, 'userKompetenz']);
    });

    Route::middleware('admin')->group(function () {
        Route::get('export/xlsx', [ExportExcelController::class, 'export'])->name('export-xlsx');
        Route::get('download/{id}', [DownloadController::class, 'download']);

        Route::get('admin-search', [AdminSearch::class, 'index']);
        Route::post('admin-search', [AdminSearch::class, 'search']);
        Route::get('admin/user/{id}', [AdminSearch::class, 'display']);
        Route::get('admin/users-list', [AdminSearch::class, 'UsersList'])->name('admin-users-list');
        Route::post('admin/export', [AdminSearch::class, 'exportData'])->name('export-data');

        Route::get('admin-search/flat-kompetenz', [AdminSearch::class, 'kompetenz']);
        Route::get('admin/stellenangebote', [JobOfferingsController::class, 'admin'])->name('edit-job-offerings');
        Route::get('admin/stellenangebote/delete/{id}', [JobOfferingsController::class, 'destroy'])->name('delete-job-offering');
        Route::get('admin/stellenangebote/edit/{id?}', [JobOfferingsController::class, 'create'])->name('add-job-offering');
        Route::put('admin/stellenangebote/store/{id?}', [JobOfferingsController::class, 'store'])->name('store-job-offering');
    });
}); //End Auth Middleware


Route::get('stellenangebote', [JobOfferingsController::class, 'index'])->name('job-offerings');
Route::get('stellenangebote/{id}', [JobOfferingsController::class, 'show'])->name('show-job-offerings');
//Authenication
//Email Validation routes...
Route::get('auth/validateEmail/{key}', [AuthController::class, 'validateEmail']);

Route::get('auth/login', [AuthController::class, 'showLoginForm']);
Route::post('auth/login', [AuthController::class, 'login']);


// Route::get('auth/login', [AuthController::class, 'getLogin']);
// Route::post('auth/login', [AuthController::class, 'postLogin']);
Route::get('auth/logout', [AuthController::class, 'logout'])->middleware('auth');

// Route::get('auth/register', [AuthController::class, 'getRegister']);
// Route::post('auth/register', [AuthController::class, 'postRegister']);

Route::get('auth/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('auth/register', [AuthController::class, 'register']);


// Password reset link request routes...
Route::get('password/email', [PasswordController::class, 'getEmail']);
Route::post('password/email', [PasswordController::class, 'postEmail']);

// Password reset routes...
Route::get('password/reset/{token}', [PasswordController::class, 'getReset']);
Route::post('password/reset', [PasswordController::class, 'postReset']);