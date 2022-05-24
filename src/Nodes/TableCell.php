<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class TableCell extends Node
{
    public static $name = 'tableCell';

    public static $ignoredAttributes = ['nowrap', 'align', 'colspan', 'rowspan'];

    public static $allowedWrappers = ['p', 'h1', 'h2', 'h3', 'h4', 'h5'];

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
                'parseHTML' => function ($DOMNode, &$HTMLAttributes) {
                    $style = $HTMLAttributes['style'] ?? null;
                    if (!$style) return null;

                    $colwidth = intval($style->getStyle('width')) ?: null;
                    if (! $colwidth) {
                      return null;
                    }
                    $style->removeStyle('width');
                    return [$colwidth];
                },
                'renderHTML' => function ($attributes) {
                    if (! isset($attributes->colwidth)) {
                        return null;
                    }

                    return [
                        'style' => 'width:'. join(',', $attributes->colwidth).'px',
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
    public static function wrapper($DOMNode, &$HTMLAttributes = [])
    {
        if (
            $DOMNode->childNodes->length === 1
            && in_array($DOMNode->childNodes[0]->nodeName, self::$allowedWrappers)
        ) {
            return null;
        }

        $data = [
            'type' => 'paragraph',
        ];

        // If listItem has textAlign, set it to wrapper
        if (isset($HTMLAttributes['class'])) {
          $textAligns = ['left', 'center', 'right'];
          foreach ($textAligns as $name) {
            if ($HTMLAttributes['class']->hasClass($name)) {
              $data['attrs'] = [
                'textAlign' => $name,
              ];
              $HTMLAttributes['class']->removeClass($name);
            }
          }
        }

        return $data;
    }
}
