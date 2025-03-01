<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\PostList;
use App\Livewire\Register;

Route::get('/', PostList::class)->name('home');
Route::get('/register', Register::class)->name('register');
