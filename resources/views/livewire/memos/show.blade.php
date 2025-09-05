<?php

use function Livewire\Volt\{state};
use App\Models\Memo;

// route model binding
state(['memo' => fn(Memo $memo) => $memo]);

$edit = function () {
    return redirect()->route('memos.edit', $this->memo);
};

$destroy = function () {
    $this->memo->delete();
    return redirect()->route('memos.index');
};

$getPriorityText = function ($priority) {
    return match ($this->memo->priority) {
        1 => '低',
        2 => '中',
        3 => '高',
        default => '不明',
    };
};
?>

<div>
    <a href="{{ route('memos.index') }}">戻る</a>
    <h1>{{ $memo->title }}</h1>
    <p>{!! nl2br(e($memo->body)) !!}</p>
    <p>優先度: {{ $this->getPriorityText($memo->priority) }}</p>

    <button wire:click="edit">編集</button>
    <button wire:click="destroy" wire:confirm="本当に削除しますか？">削除</button>
</div>
