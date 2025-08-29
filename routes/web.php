<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Volt::route('/memos', 'memos.index')->name('memos.index');
Volt::route('/memos/create', 'memos.create')->name('memos.create');
Volt::route('/memos/{memo}', 'memos.show')->name('memos.show');
Volt::route('/memos/{memo}/edit', 'memos.edit')->name('memos.edit');
