<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\PostList;

Route::get('/', PostList::class)->name('home');

