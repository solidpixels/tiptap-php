<?php

use Tiptap\Editor;

test('emojis are transformed correctly()', function () {
    $html = "<p>π₯</p>";

    $result = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => "π₯",
                    ],
                ],
            ],
        ],
    ]);
});

test('extended emojis are transformed correctly()', function () {
    $html = "<p>π©βπ©βπ¦</p>";

    $result = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => "π©βπ©βπ¦",
                    ],
                ],
            ],
        ],
    ]);
});

test('umlauts are transformed correctly()', function () {
    $html = "<p>Γ€ΓΆΓΌΓΓΓΓ</p>";

    $result = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => "Γ€ΓΆΓΌΓΓΓΓ",
                    ],
                ],
            ],
        ],
    ]);
});

test('html entities are transformed correctly()', function () {
    $html = "<p>&lt;</p>";

    $result = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => "<",
                    ],
                ],
            ],
        ],
    ]);
});
