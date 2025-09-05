<?php

use function Livewire\Volt\{state};
use App\Models\Memo;

state(['memos' => fn () => Memo::all()]);

$create = function () {
    return redirect()->route('memos.create');
};

$getPriorityText = function ($priority) {
    return match ($priority) {
        1 => '低',
        2 => '中',
        3 => '高',
        default => '不明',
    };
};
?>

<div>
    <h1>タイトル一覧</h1>
    <ul>
        @foreach ($memos as $memo)
            <li>
                <a href="{{ route('memos.show', $memo->id) }}">{{ $memo->title }}</a>
                <p>優先度: {{ $this->getPriorityText($memo->priority) }}</p>
            </li>
        @endforeach
    </ul>
    <button wire:click="create">新規登録</button>
</div>
