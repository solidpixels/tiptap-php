<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class TableCell extends Node
{
    public static $name = 'tableCell';

    public static $ignoredAttributes = ['nowrap', 'align', 'colspan', 'rowspan'];

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
                'tag' => 'td',
            ],
        ];
    }

    public function addAttributes()
    {
        return [
          '_' => [
              'parseHTML' => function ($DOMNode, &$HTMLAttributes) {
                if (isset($HTMLAttributes['class'])) {
                  $HTMLAttributes['class']->removeClass('text-large');
                }
                return null;
              },
              'renderHTML' => function ($attributes) {
                  return null;
              },
          ],
            'rowspan' => [
                'parseHTML' => fn ($DOMNode) => intval($DOMNode->getAttribute('rowspan')) ?: null,
            ],
            'colspan' => [
                'parseHTML' => fn ($DOMNode) => intval($DOMNode->getAttribute('colspan')) ?: null,
            ],
            'colwidth' => [
                'parseHTML' => function ($DOMNode) {
                    $colwidth = $DOMNode->getAttribute('data-colwidth');

                    if (! $colwidth) {
                        return null;
                    }

                    $widths = array_map(function ($w) {
                        return intval($w);
                    }, explode(',', $colwidth));

                    return $widths;
                },
                'renderHTML' => function ($attributes) {
                    if (! isset($attributes->colwidth)) {
                        return null;
                    }

                    return [
                        'data-colwidth' => join(',', $attributes->colwidth),
                    ];
                },
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        return [
            'td',
            HTML::mergeAttributes(
                $this->options['HTMLAttributes'],
                $HTMLAttributes,
            ),
            0,
        ];
    }
}
