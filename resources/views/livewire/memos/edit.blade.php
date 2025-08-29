<?php

use function Livewire\Volt\{state, mount, rules};
use App\Models\Memo;

state(['memo','title','body']);

rules([
    'title' => 'required|string|max:50',
    'body' => 'required|string|max:2000',
]);

mount(function (Memo $memo) {
    $this->memo = $memo;
    $this->title = $memo->title;
    $this->body = $memo->body;
});

$update = function () {
    $this->validate();

    $this->memo->update([
        'title' => $this->title,
        'body' => $this->body,
    ]);

    return redirect()->route('memos.show', $this->memo);
};
?>

<div>
    <a href="{{ route('memos.show', $memo) }}">戻る</a>
    <h1>更新</h1>

    <form wire:submit="update">
        <p>
            <label for="title">タイトル</label>
            <input type="text" wire:model="title" id="title" />
            @error('title')
                <span class="error">{{ $message }}</span>
            @enderror
            <br>
        </p>
        <p>
            <label for="body">本文</label>
            <textarea wire:model="body" id="body"></textarea>
            @error('body')
                <span class="error">{{ $message }}</span>
            @enderror
            <br>
        </p>
        <button type="submit">更新</button>
    </form>
</div>
