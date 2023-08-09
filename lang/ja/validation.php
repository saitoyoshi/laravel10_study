<?php

return [
    'exists' => '正しい :attribute を選択してください',
    'required' => ':attribute を入力してください',
    'numeric' => ':attribute は数値で入力してください',
    'unique' => ':attribute はすでに登録されています',

    'min' => [
        'numeric' => ':attribute は :min 以上を入力してください',
        'string' => ':attribute は :min 文字以上を入力してください',
    ],
    'max' => [
        'string' => ':attribute は :max 文字以下で入力してください',
        'numeric' => ':attribute は :max 以下で入力してください',
    ],
    'attributes' => [
        'category_id' => 'カテゴリ',
        'title' => 'タイトル',
        'price' => '価格',
        'message' => 'メッセージ',
        'body' => 'メッセージ',
        'author_ids' => '著者',
        'author_ids.*' => '著者',
    ],
];
