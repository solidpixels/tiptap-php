<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;
use Tiptap\Utils\InlineStyle;

class Color extends Mark
{
    public static $name = 'color';

    public function addOptions()
    {
        return [
            'prefix' => 'color--',
            'HTMLAttributes' => [
            ],
        ];
    }

    public function parseHTML()
    {
        return [
          [
              'tag' => 'span',
              'getAttrs' => function ($node) {
                if ($color = $node->getAttribute('class')) {
                  return preg_match('/' . $this->options['prefix'] . '([^ ]*?)$/', $color) ?: false;
                }
                return false;
              },
          ],
          // [
          //     'style' => 'color',
          //     'getAttrs' => function ($value) {
          //         return true;
          //     },
          // ],
        ];
    }

    public function addAttributes()
    {
        return [
            'color' => [
                'parseHTML' => function ($DOMNode, &$HTMLAttributes) {
                    if ($color = $DOMNode->getAttribute('class')) {
                      if (preg_match('/' . $this->options['prefix'] . '([^ ]*?)$/', $color, $matches)) {
                        $HTMLAttributes['class']->removeClass($this->options['prefix'] . $matches[1]);
                        return $matches[1];
                      }
                    }

                    // $style = InlineStyle::getAttribute($DOMNode, 'color') ?: null;
                    // if ($style) {
                    //   $DOMNode->removeAttribute('style');
                    //   return $style;
                    // }
                    return null;
                },
                'renderHTML' => function ($attributes) {
                    if (!isset($attributes->color)) {
                        return null;
                    }

                    return [
                        'class' => $this->options['prefix'] . $attributes->color,
                    ];
                },
            ],
        ];
    }

    public function renderHTML($mark, $HTMLAttributes = [])
    {
        return [
            'span',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes),
            0,
        ];
    }
}
