<?php

use function Livewire\Volt\{state, rules};
use App\Models\Memo;

state(['title','body']);

rules([
    'title' => 'required|string|max:50',
    'body' => 'required|string|max:2000',
]);

$store = function () {
    $this->validate();

    Memo::create([
        'title' => $this->title,
        'body' => $this->body,
    ]);

    return redirect()->route('memos.index');
};
?>

<div>
    <a href="{{ route('memos.index') }}">一覧に戻る</a>
    <h1>新規登録</h1>
    
    <form wire:submit="store">
        <p>
            <label for="title">タイトル</label>
            @error('title')
                <span class="error">{{ $message }}</span>
            @enderror
            <br>
            <input type="text" wire:model="title" id="title" />
        </p>
        <p>
            <label for="body">本文</label>
            @error('body')
                <span class="error">{{ $message }}</span>
            @enderror
            <br>
            <textarea wire:model="body" id="body"></textarea>
        </p>
        <button type="submit">登録</button>
    </form>
</div>
