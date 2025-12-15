<?php

use Illuminate\Support\Facades\Route;




use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteQuizController;
use App\Http\Controllers\FlashcardController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('index');
})->name('home');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// Mostrar login / registro
Route::get('/login', [AuthController::class, 'show'])
    ->name('login');

// Procesar login
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

// Procesar registro
Route::post('/register', [AuthController::class, 'register'])
    ->name('register');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/notes', [NoteQuizController::class, 'index'])
    ->name('notes');

Route::post('/notes/store', [NoteQuizController::class, 'storeNote'])
    ->name('notes.store');

Route::post('/quiz/store', [NoteQuizController::class, 'storeQuiz'])
    ->name('quiz.store');

Route::get('/quiz/{id}', [NoteQuizController::class, 'getQuiz'])
    ->name('quiz.get');

Route::get('/flashcards', [FlashcardController::class, 'index'])
    ->name('flashcards');

Route::post('/flashcards/store', [FlashcardController::class, 'store'])
    ->name('flashcards.store');

Route::get('/flashcards/{id}', [FlashcardController::class, 'show'])
    ->name('flashcards.show');

    Route::get('/profile', function () {
    return view('perfil');
})->name('profile');

use App\Http\Controllers\NoHandsController;

Route::post('/no-hands/toggle', [NoHandsController::class, 'toggle'])
    ->name('nohands.toggle');
