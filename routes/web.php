<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::resource('tasks', TaskController::class);
Route::put('/tasks/{id}/complete', [TaskController::class, 'markCompleted'])->name('tasks.complete');
