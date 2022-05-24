<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class Table extends Node
{
    public static $name = 'table';

    public static $ignoredAttributes = ['class', 'hspace', 'vspace'];

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [
              'class' => 'table table-bordered'
            ],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'table',
            ],
        ];
    }

    public function addAttributes()
    {
        return [
            '_' => [
                'parseHTML' => function ($DOMNode, &$HTMLAttributes) {
                  if (isset($HTMLAttributes['class'])) {
                    $HTMLAttributes['class']->removeClass('table');
                    $HTMLAttributes['class']->removeClass('table-bordered');
                  }
                  return null;
                },
                'renderHTML' => function ($attributes) {
                    return null;
                },
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        return [
            'table',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes),
            ['tbody', 0],
        ];
    }
}
