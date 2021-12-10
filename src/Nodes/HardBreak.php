<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class HardBreak extends Node
{
    public static $name = 'hardBreak';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'br',
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return 'br';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'hardBreak',
        ];
    }
}
