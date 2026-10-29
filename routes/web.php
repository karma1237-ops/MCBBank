<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CashierController;

/*
|--------------------------------------------------------------------------
| Routes de l'application MCB Bank
|--------------------------------------------------------------------------
| Dans les vues, les liens sont écrits avec url('/chemin'),
| par exemple url('/admin/home').
| middleware('role:...') : seul l'utilisateur connecté avec ce rôle peut ouvrir ces pages.
*/

// ---------- Connexion ----------
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// ---------- Espace ADMIN (manager) ----------
Route::middleware('role:manager')->group(function () {
    Route::get('/admin/home', [AdminController::class, 'home']);
    Route::get('/admin/show/{id}', [AdminController::class, 'show']);
    Route::delete('/admin/deleteaccount/{id}', [AdminController::class, 'deleteaccount']);
    Route::get('/admin/addnew', [AdminController::class, 'addnew']);
    Route::post('/admin/saveaccount', [AdminController::class, 'saveaccount']);
    Route::get('/admin/cashiers', [AdminController::class, 'cashiers']);
    Route::post('/admin/savecashier', [AdminController::class, 'savecashier']);
    Route::put('/admin/updatecashier/{id}', [AdminController::class, 'updatecashier']);
    Route::delete('/admin/deletecashier/{id}', [AdminController::class, 'deletecashier']);
    Route::get('/admin/feedbacks', [AdminController::class, 'feedbacks']);
    Route::delete('/admin/deletefeedback/{id}', [AdminController::class, 'deletefeedback']);
    Route::get('/admin/notice/{id}', [AdminController::class, 'notice']);
    Route::post('/admin/savenotice', [AdminController::class, 'savenotice']);
});

// ---------- Espace CLIENT ----------
Route::middleware('role:client')->group(function () {
    Route::get('/client/home', [ClientController::class, 'home']);
    Route::get('/client/account', [ClientController::class, 'account']);
    Route::get('/client/transfer', [ClientController::class, 'transfer']);
    Route::post('/client/transferinfo', [ClientController::class, 'transferinfo']);
    Route::post('/client/savetransfer', [ClientController::class, 'savetransfer']);
    Route::get('/client/statements', [ClientController::class, 'statements']);
    Route::get('/client/feedback', [ClientController::class, 'feedback']);
    Route::post('/client/savefeedback', [ClientController::class, 'savefeedback']);
    Route::get('/client/notice', [ClientController::class, 'notice']);
});

// ---------- Espace CAISSIER ----------
Route::middleware('role:cashier')->group(function () {
    Route::get('/cashier/home', [CashierController::class, 'home']);
    Route::post('/cashier/search', [CashierController::class, 'search']);
    Route::post('/cashier/operation', [CashierController::class, 'operation']);
});
