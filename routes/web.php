<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index'])
    ->name('todos.index');

Route::post('/todo', [TodoController::class, 'store'])
    ->name('todos.store');

Route::post('/session/end', [TodoController::class, 'endSession'])
    ->name('todos.session.end');

Route::get('/done-todos', [TodoController::class, 'done'])
    ->name('todos.done');

Route::post('/todo/{id}/toggle', [TodoController::class, 'toggle'])
    ->name('todos.toggle');


require __DIR__.'/auth.php';
