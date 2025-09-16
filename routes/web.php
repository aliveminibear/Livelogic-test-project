<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/login', function () {
    return Inertia::render('Auth/Login');
});

Route::get('/register', function () {
    return Inertia::render('Auth/Register');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/todos', function () {
    return Inertia::render('TodoApp');
})->name('todos');

Route::get('/polls/create', function () {
    return Inertia::render('Polls/Create');
});
Route::get('/my-polls', function () {
    return Inertia::render('Polls/MyPolls');
});
Route::get('/polls/{id}', function ($id) {
    return Inertia::render('Polls/Vote', ['id' => $id]);
});
Route::get('/polls/{id}/results', function ($id) {
    return Inertia::render('Polls/Results', ['id' => $id]);
});
