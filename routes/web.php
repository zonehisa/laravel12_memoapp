<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Volt::route('/memos', 'memos.index')->name('memos.index');
Volt::route('/memos/{memo}', 'memos.show')->name('memos.show');
