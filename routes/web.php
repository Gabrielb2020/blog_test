<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\PostList;
use App\Livewire\Register;
use App\Livewire\UserManagement;
use App\Livewire\Login;

Route::get('/', PostList::class)->name('home');
Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
Route::get('/users', UserManagement::class)->name('users');
