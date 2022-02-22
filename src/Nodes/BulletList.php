<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class BulletList extends Node
{
    public static $name = 'bulletList';
    
    public static $ignoredAttributes = ['wfd-id'];

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'ul',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        return ['ul', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
