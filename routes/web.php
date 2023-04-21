<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ColaboratorController;
use App\Http\Controllers\DomiController;
use App\Http\Controllers\PqrController;
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

Route::get('/', fn() => view('welcome'));
Route::get('trabaja-con-nosotros', fn() => view('create-domi'))->name('create-domi');
Route::get('hacer-pqr', fn() => view('create-pqr'))->name('create-pqr');

Route::post('create-application', [ApplicationController::class, 'create'])->name('create-application');
Route::post('hacer-pqr', [PqrController::class, 'create'])->name('create-pqr-post');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::middleware(['can:isAdmin,App\Models\User'])->group(function() {

        Route::get('colaboradores', [ColaboratorController::class, 'render'])->name('view-colaboradores');
        Route::put('put-colaborator', [ColaboratorController::class, 'put'])->name('put-colaborator');

    });

    Route::middleware(['can:isColaborator,App\Models\User'])->group(function() {
    
        Route::get('domiciliarios', [DomiController::class, 'render'])->name('view-domiciliarios');
        Route::get('pqrs', [PqrController::class, 'render'])->name('view-pqrs');
        Route::get('show-curriculum/{application}', [ApplicationController::class, 'showCurriculum'])->name('show-curriculum');
        Route::get('show-embed/{pqr}', [PqrController::class, 'showEmbed'])->name('show-embed');
        Route::get('process-pqr/{pqr}', [PqrController::class, 'processPqr'])->name('process-pqr');
        Route::get('accept-application/{application}', [ApplicationController::class, 'acceptApplication'])->name('accept-application');
        Route::get('reject-application/{application}', [ApplicationController::class, 'rejectApplication'])->name('reject-application');
        Route::put('put-domi', [DomiController::class, 'put'])->name('put-domi');

    });

    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});
