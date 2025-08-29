<?php

test('memos index', function () {
    $response = $this->get('/memos');

    $response->assertStatus(200);
    $response->assertSee('タイトル一覧');
    $response->assertSee('新規登録');
});
